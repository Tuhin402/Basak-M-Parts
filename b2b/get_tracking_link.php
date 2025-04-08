<?php
include 'session_config.php'; 
require_once "../Admin/config.php";
include 'token.php';                 

header("Content-Type: application/json");

$inputJSON = file_get_contents("php://input");
$data = json_decode($inputJSON, true);

if (!$data || empty($data['order_id']) || empty($data['shiprocket_order_id'])) {
    // error_log("Invalid input received: " . $inputJSON);
    echo json_encode(["success" => false, "message" => "Invalid input."]);
    exit;
}

$orderId = $data['order_id'];
$shiprocketOrderId = $data['shiprocket_order_id'];

$apiToken = getShiprocketToken();

$apiUrl = "https://apiv2.shiprocket.in/v1/external/courier/track?order_id=" . urlencode($shiprocketOrderId);

// error_log("Requesting tracking URL from Shiprocket API: $apiUrl with order_id: $orderId and shiprocket_order_id: $shiprocketOrderId");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $apiToken",
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// error_log("Shiprocket API response HTTP Code: $httpCode");
// if (!empty($error)) {
//     error_log("cURL error: " . $error);
// }
// error_log("Shiprocket API raw response: " . $response);

if ($httpCode !== 200) {
    // error_log("Error: Unable to retrieve tracking information. HTTP Code: $httpCode. Response: " . $response);
    echo json_encode([
        "success" => false,
        "message" => "Unable to retrieve tracking information. (HTTP Code: $httpCode)"
    ]);
    exit;
}

$trackingData = json_decode($response, true);
// error_log("Decoded tracking data: " . print_r($trackingData, true));

$firstElement = array_values($trackingData)[0];
$trackingDataInner = isset($firstElement['tracking_data']) ? $firstElement['tracking_data'] : null;

if ($trackingDataInner && !empty($trackingDataInner['track_url'])) {
    $trackUrl = $trackingDataInner['track_url'];
    // error_log("Successfully retrieved tracking URL: " . $trackUrl);
    echo json_encode(["success" => true, "track_url" => $trackUrl]);
} else {
    $errorMessage = isset($trackingDataInner['error']) ? $trackingDataInner['error'] : "Tracking URL not found in API response.";
    // error_log("Tracking URL not found in API response. Error: " . $errorMessage . " Data: " . print_r($trackingData, true));
    echo json_encode(["success" => false, "message" => $errorMessage]);
}
?>