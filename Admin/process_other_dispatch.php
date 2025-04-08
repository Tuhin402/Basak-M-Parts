<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once "config.php"; 
include 'token.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $shiprocket_id = $_POST['shiprocket_order_id'];
    $confinement_id = $_POST['confinementId'];
    $tracking_link = $_POST['trackingLink'];

    $shiprocket_response_raw = null;
    $shiprocket_token = getShiprocketToken();
    $shiprocket_cancel_url = "https://apiv2.shiprocket.in/v1/external/orders/cancel";
    
    $shiprocket_order_id = (int)$shiprocket_id; 
    
    $cancel_payload = [
        "ids" => [ $shiprocket_order_id ],
        "cancel_reason" => "Admin approved cancellation"
    ];
    $post_data = json_encode($cancel_payload);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $shiprocket_cancel_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . $shiprocket_token
    ]);
    
    $shiprocket_response_raw = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_errno($ch)) {
        $error_message = "cURL error: " . curl_error($ch);
        // error_log($error_message);
        curl_close($ch);
        echo json_encode(["success" => false, "message" => "Shiprocket cancellation failed: " . $error_message]);
        exit;
    } else {
        // error_log("Shiprocket cancellation response: HTTP Code: $http_code; Response: $shiprocket_response_raw");
        curl_close($ch);
        
        if ($http_code != 200 && $http_code != 204) {
            echo json_encode(["success" => false, "message" => "Shiprocket cancellation failed", "shiprocket_response" => $shiprocket_response_raw]);
            exit;
        }
    }

    $sql = "INSERT INTO other_dispatch (order_id, shiprocket_order_id, confinement_id, tracking_link) 
            VALUES ('$order_id', '$shiprocket_order_id', '$confinement_id', '$tracking_link')";
    
    if ($obj->query($sql)) {
        $update_sql = "UPDATE orders SET ship_status = 'Out for Delivery' WHERE order_id = '$order_id' AND shiprocket_order_id = '$shiprocket_order_id'";
        $obj->query($update_sql); 
        
        echo json_encode(["success" => true, "message" => "Dispatch details saved successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to save dispatch details."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>