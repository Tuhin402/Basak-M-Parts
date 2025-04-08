<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

require_once "config.php"; 
include 'token.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
    exit;
}

$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;
$shiprocket_order_id = isset($_POST['shiprocket_order_id']) ? $_POST['shiprocket_order_id'] : null;

if (!$order_id || !$shiprocket_order_id) {
    echo json_encode(["success" => false, "message" => "Missing order identifiers"]);
    exit;
}

$shiprocket_token = getShiprocketToken();
$api_url = "https://apiv2.shiprocket.in/v1/external/orders/fulfill";

$productQuery = "SELECT o.product_id, o.quantity FROM orders o JOIN products p ON o.product_id = p.id WHERE o.order_id = '$order_id'";
$productDetails = $obj->fetch($productQuery);

$data = [];
foreach ($productDetails as $product) {
    $data[] = [
        "order_id"          => (int)$shiprocket_order_id, 
        "order_product_id"  => (int)$product['product_id'],  
        "quantity"          => (string)$product['quantity'], 
        "action"            => "fulfill"
    ];
}

$payload = [
    "data" => $data
];

// $payload = [
//     "data" => [
//         [
//             "order_id" => (int)$shiprocket_order_id, 
//             "order_product_id" => 0, 
//             "quantity" => (string)$qty,       
//             "action" => "fulfill"
//         ]
//     ]
// ];

$post_data = json_encode($payload);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $shiprocket_token
]);

$api_response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    error_log("cURL error during Shiprocket dispatch API call: " . $error_msg);
    curl_close($ch);
    echo json_encode(["success" => false, "message" => "Error communicating with shipping service: " . $error_msg]);
    exit;
}
curl_close($ch);

error_log("Shiprocket dispatch response: HTTP Code: $http_code; Response: $api_response");  //debug

$api_result = json_decode($api_response, true);

if ($http_code != 200 && $http_code != 204) {
    $error_detail = isset($api_result['message']) ? $api_result['message'] : 'Unknown error';
    echo json_encode(["success" => false, "message" => "Shiprocket dispatch failed: " . $error_detail, "response" => $api_response]);
    exit;
}

$update_sql = "UPDATE orders SET ship_status = 'Out for Delivery' WHERE order_id = '$order_id' AND shiprocket_order_id = '$shiprocket_order_id'";
$obj->query($update_sql);

echo json_encode(["success" => true, "message" => "Order dispatched successfully via Shiprocket."]);
exit;
?>