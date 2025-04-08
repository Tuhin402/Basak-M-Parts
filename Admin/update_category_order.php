<?php
require 'config.php';
$connection = $obj->getConnection();

$data = json_decode(file_get_contents("php://input"), true);
if (isset($data['order']) && is_array($data['order'])) {
    $order = $data['order'];
    $stmt = $connection->prepare("UPDATE product_category SET sort_order = ? WHERE id = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed']);
        exit;
    }
    foreach ($order as $position => $id) {
        $sort_order = $position + 1; 
        $stmt->bind_param("ii", $sort_order, $id);
        $stmt->execute();
    }
    $stmt->close();
    echo json_encode(['status' => 'success', 'message' => 'Order updated']);
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    exit;
}
?>