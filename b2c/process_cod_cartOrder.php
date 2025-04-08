<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

include 'session_config.php';
require_once "../Admin/config.php";
include 'token.php';  

$inputJSON = file_get_contents("php://input");
$orderData = json_decode($inputJSON, true);

if (!$orderData) {
    echo json_encode(["success" => false, "message" => "Invalid JSON input"]);
    exit;
}

$order_id = "ORD-" . strtoupper(substr(md5(time()), 0, 10));
$order_date = date("Y-m-d H:i:s");

$shiprocket_token = getShiprocketToken();

$order_items = [];
foreach ($orderData['products'] as $product) {
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

$payload = [
    "order_id"              => $order_id,
    "order_date"            => $order_date,
    "pickup_location"       => "work",
    "billing_customer_name" => $orderData['name'],
    "billing_last_name"     => "",
    "billing_address"       => $orderData['address'],
    "billing_address_2"     => $orderData['landmark'],
    "billing_city"          => $orderData['city'],
    "billing_pincode"       => $orderData['pin'],
    "billing_state"         => $orderData['state'],
    "billing_country"       => "India",
    "billing_email"         => $orderData['email'],
    "billing_phone"         => $orderData['mobile'],
    "shipping_is_billing"   => true,
    "order_items"           => $order_items,
    "payment_method"        => "COD",
    "shipping_charges"      => 0,
    "giftwrap_charges"      => 0,
    "transaction_charges"   => 0,
    "total_discount"        => 0,
    "sub_total"             => (float)$orderData['total_amount'],
    "length"                => 10,
    "breadth"               => 15,
    "height"                => 20,
    "weight"                => 2
];

$post_data = json_encode($payload);

$api_url = "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $shiprocket_token
]);

$api_response = curl_exec($ch);
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    error_log("cURL error during Shiprocket API call: " . $error_msg);
    echo json_encode(['success' => false, 'message' => 'Error communicating with shipping service']);
    curl_close($ch);
    exit;
}
curl_close($ch);

$api_result = json_decode($api_response, true);
if (!isset($api_result['order_id'])) {
    error_log("Shiprocket API error response: " . $api_response);
    $error_detail = isset($api_result['message']) ? $api_result['message'] : 'Unknown error from Shiprocket API';
    echo json_encode(['success' => false, 'message' => 'Shipping service error: ' . $error_detail]);
    exit;
}

$shiprocket_order_id = $api_result['order_id'];

foreach ($orderData['products'] as $product) {
    $sql = "INSERT INTO orders (order_id, shiprocket_order_id, user_name, user_email, user_mobile, address, landmark, pin, product_id, product_name, quantity, price, total_price, hsn, sku, status, ship_status) 
            VALUES ('$order_id', '$shiprocket_order_id', '{$orderData['name']}', '{$orderData['email']}', '{$orderData['mobile']}', '{$orderData['address']}', '{$orderData['landmark']}', '{$orderData['pin']}', '{$product['product_id']}', '{$product['product_name']}', '{$product['quantity']}', '{$product['price']}', '{$product['total_price']}', '{$product['hsn']}', '{$product['sku']}', 'cod', 'Pending')";
    if (!$obj->query($sql)) {
        error_log("Database insertion error for order_id $order_id, product_id {$product['product_id']}: " . mysqli_error($obj->getConnection()));
        echo json_encode(['success' => false, 'message' => 'Database error while placing order']);
        exit;
    }

    $updateStockSql = "UPDATE products SET stock = stock - {$product['quantity']} WHERE id = '{$product['product_id']}' AND b2c_price = '{$product['price']}'";
    if (!$obj->query($updateStockSql)) {
        error_log("Stock update error for product_id {$product['product_id']}: " . mysqli_error($obj->getConnection()));
    }
}

$responseData = [
    "order_id"      => $order_id,
    "total_amount"  => $orderData['total_amount'],
    "name"          => $orderData['name'],
    "email"         => $orderData['email'],
    "mobile"        => $orderData['mobile'],
    "address"       => $orderData['address'],
    "landmark"      => $orderData['landmark'],
    "pin"           => $orderData['pin'],
    "products"      => $orderData['products']
];

echo json_encode(['success' => true, 'orderData' => $responseData]);
exit;
?>