<?php
include 'session_config.php';
require_once "config.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputJSON = file_get_contents("php://input");
    $data = json_decode($inputJSON, true);
    
    if (!$data) {
        echo json_encode(["success" => false, "message" => "Invalid input"]);
        exit;
    }
    
    $order_id = $data['order_id'];
    $shiprocket_order_id = $data['shiprocket_order_id'];
    $new_status = $data['new_status'];
    $currentTime = time(); 
    $formattedTime = date('Y-m-d H:i:s', $currentTime); 
    
    $allowed_statuses = ['In Transit', 'Completed'];
    if (!in_array($new_status, $allowed_statuses)) {
        echo json_encode(["success" => false, "message" => "Invalid status"]);
        exit;
    }
    
    $sql = "UPDATE orders SET ship_status = '$new_status', date = '$formattedTime' WHERE order_id = '$order_id' AND shiprocket_order_id = '$shiprocket_order_id'";
    $result = $obj->query($sql);
    
    if ($result) {
        echo json_encode(["success" => true, "message" => "Ship status updated to " . $new_status]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update ship status"]);
    }
    
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>