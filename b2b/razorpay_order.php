<?php
include 'session_config.php';
require_once "../Admin/config.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $razorpayMode = "live"; 
    $razorpayKey = ($razorpayMode == "live") ? "rzp_live_35SLNsYr1wP5RY" : "rzp_test_TlxM6W37t3zETC";
    $razorpaySecret = ($razorpayMode == "live") ? "8v3rgzHhoXxjBhh39igOH2D9" : "kWxmCHmtBYxdaLRLEjsT1hQ0";
    
    // $razorpayKey = ($razorpayMode == "live") ? "rzp_live_OPo2VPVfWeQZGM" : "rzp_test_TlxM6W37t3zETC";
    // $razorpaySecret = ($razorpayMode == "live") ? "hplHlfTICXaUXMKbCwvrV7HG" : "kWxmCHmtBYxdaLRLEjsT1hQ0";

    $inputJSON = file_get_contents("php://input"); 
    $orderData = json_decode($inputJSON, true); 

    if (!$orderData) {
        echo json_encode(["success" => false, "message" => "Invalid JSON input"]);
        exit;
    }

    $order_id = "ORD-" . strtoupper(substr(md5(time()), 0, 10));
    $razorpay_url = "https://api.razorpay.com/v1/orders";
    
    $fields = json_encode([
        "amount" => (int)(floatval($orderData['total_price']) * 100),
        "currency" => "INR",
        "receipt" => $order_id,
        "payment_capture" => 1
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $razorpay_url);
    curl_setopt($ch, CURLOPT_USERPWD, $razorpayKey . ":" . $razorpaySecret);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    $razorpayResponse = json_decode($response, true);

    if (isset($razorpayResponse['id'])) {
        $orderData['order_id'] = $order_id;
        $orderData['razorpay_order_id'] = $razorpayResponse['id'];
    
        echo json_encode(["success" => true, "orderData" => $orderData]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to create Razorpay order"]);
        // error_log("Response: $response");
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>