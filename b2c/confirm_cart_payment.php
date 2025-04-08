<?php
include 'session_config.php';
require_once "../Admin/config.php";
include 'token.php';  

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $razorpayMode = "live"; 
    $razorpayKey = ($razorpayMode == "live") ? "rzp_live_35SLNsYr1wP5RY" : "rzp_test_TlxM6W37t3zETC";
    $razorpaySecret = ($razorpayMode == "live") ? "8v3rgzHhoXxjBhh39igOH2D9" : "kWxmCHmtBYxdaLRLEjsT1hQ0";

    $inputJSON = file_get_contents("php://input");
    $paymentData = json_decode($inputJSON, true);

    if (
        !$paymentData ||
        !isset($paymentData['razorpay_order_id']) ||
        !isset($paymentData['razorpay_payment_id']) ||
        !isset($paymentData['razorpay_signature']) ||
        !isset($paymentData['order_id']) ||
        !isset($paymentData['products']) ||
        !is_array($paymentData['products'])
    ) {
        echo json_encode(["success" => false, "message" => "Invalid payment data"]);
        exit;
    }

    $razorpay_order_id = $paymentData['razorpay_order_id'];
    $razorpay_payment_id = $paymentData['razorpay_payment_id'];
    $razorpay_signature = $paymentData['razorpay_signature'];

    $generated_signature = hash_hmac('sha256', $razorpay_order_id . "|" . $razorpay_payment_id, $razorpaySecret);
    if ($generated_signature !== $razorpay_signature) {
        echo json_encode(["success" => false, "message" => "Payment verification failed"]);
        exit;
    }
    
    $razorpay_payment_url = "https://api.razorpay.com/v1/payments/" . $razorpay_payment_id;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $razorpay_payment_url);
    curl_setopt($ch, CURLOPT_USERPWD, $razorpayKey . ":" . $razorpaySecret);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    $payment_response = curl_exec($ch);
    curl_close($ch);
    $payment_result = json_decode($payment_response, true);
    
    if (!isset($payment_result['status']) || $payment_result['status'] !== "captured") {
        echo json_encode(["success" => false, "message" => "Payment not captured"]);
        exit;
    }
    
    $order_id = $paymentData['order_id'];
    
    $order_date = date("Y-m-d H:i:s");
    $shiprocket_token = getShiprocketToken();
    $order_items = [];
    foreach ($paymentData['products'] as $product) {
        $order_items[] = [
            "name"          => $product['product_name'],
            "sku"           => $product['sku'],
            "units"         => (int)$product['quantity'],
            "selling_price" => (float)$product['price'],
            "discount"      => 0,
            "tax"           => 0,
            "hsn"           => $product['hsn']
        ];
    }
    
    $shiprocket_payload = [
        "order_id"              => $order_id,
        "order_date"            => $order_date,
        "pickup_location"       => "work",
        "billing_customer_name" => $paymentData['name'],
        "billing_last_name"     => "",
        "billing_address"       => $paymentData['address'],
        "billing_address_2"     => $paymentData['landmark'],
        "billing_city"          => $paymentData['city'],
        "billing_pincode"       => $paymentData['pin'],
        "billing_state"         => $paymentData['state'],
        "billing_country"       => "India",
        "billing_email"         => $paymentData['email'],
        "billing_phone"         => $paymentData['mobile'],
        "shipping_is_billing"   => true,
        "order_items"           => $order_items,
        "payment_method"        => "Prepaid",
        "shipping_charges"      => 0,
        "giftwrap_charges"      => 0,
        "transaction_charges"   => 0,
        "total_discount"        => 0,
        "sub_total"             => (float)$paymentData['total_amount'],
        "length"                => 10,
        "breadth"               => 15,
        "height"                => 20,
        "weight"                => 2
    ];
    
    $post_data = json_encode($shiprocket_payload);
    $shiprocket_api_url = "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $shiprocket_api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . $shiprocket_token
    ]);
    $shiprocket_response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        error_log("Shiprocket cURL error: " . $error_msg);
        echo json_encode(["success" => false, "message" => "Error communicating with shipping service"]);
        curl_close($ch);
        exit;
    }
    curl_close($ch);
    $shiprocket_result = json_decode($shiprocket_response, true);
    
    if (!isset($shiprocket_result['order_id'])) {
        error_log("Shiprocket API error: " . $shiprocket_response);
        $error_detail = isset($shiprocket_result['message']) ? $shiprocket_result['message'] : 'Unknown error from Shiprocket';
        echo json_encode(["success" => false, "message" => "Shipping service error: " . $error_detail]);
        exit;
    }
    
    $shiprocket_order_id = $shiprocket_result['order_id'];
    
    foreach ($paymentData['products'] as $product) {
        $sql = "INSERT INTO orders (order_id, shiprocket_order_id, user_name, user_email, user_mobile, address, landmark, pin, product_id, product_name, quantity, price, total_price, hsn, sku, razorpay_order_id, status, ship_status) 
                VALUES ('$order_id', '$shiprocket_order_id', '{$paymentData['name']}', '{$paymentData['email']}', '{$paymentData['mobile']}', '{$paymentData['address']}', '{$paymentData['landmark']}', '{$paymentData['pin']}', '{$product['product_id']}', '{$product['product_name']}', '{$product['quantity']}', '{$product['price']}', '{$product['total_price']}', '{$product['hsn']}', '{$product['sku']}', '$razorpay_payment_id', 'paid', 'Pending')";
        if (!$obj->query($sql)) {
            error_log("Database insertion error for order_id $order_id: " . mysqli_error($obj->getConnection()));
            echo json_encode(['success' => false, 'message' => 'Database error while placing order']);
            exit;
        }
        
        $updateStockSql = "UPDATE products SET stock = stock - {$product['quantity']} WHERE id = '{$product['product_id']}' AND b2c_price = '{$product['price']}'";
        if (!$obj->query($updateStockSql)) {
            error_log("Stock update error for product_id {$product['product_id']}: " . mysqli_error($obj->getConnection()));
        }
    }
    
    $responseData = [
        "order_id"             => $order_id,
        "razorpay_order_id"    => $razorpay_order_id, 
        "total_amount"         => $paymentData['total_amount'],
        "name"                 => $paymentData['name'],
        "email"                => $paymentData['email'],
        "mobile"               => $paymentData['mobile'],
        "address"              => $paymentData['address'],
        "landmark"             => $paymentData['landmark'],
        "pin"                  => $paymentData['pin'],
        "city"                 => $paymentData['city'],
        "state"                => $paymentData['state'],
        "products"             => $paymentData['products']
    ];
    
    echo json_encode(["success" => true, "message" => "Payment captured and order confirmed", "orderData" => $responseData]);
    
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>