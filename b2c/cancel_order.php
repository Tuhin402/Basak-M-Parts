<?php
require_once '../Admin/config.php'; 
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cancel_order') {
    $shiprocket_order_id      = trim($_POST['shiprocket_order_id']);
    $order_id      = trim($_POST['order_id']);
    $user_email    = trim($_POST['user_email']);
    $bank_account  = trim($_POST['bank_account']);
    $ifsc          = trim($_POST['ifsc']);
    $bank_name     = trim($_POST['bank_name']);
    $branch_address = trim($_POST['branch_address']);
    $banking_name  = trim($_POST['banking_name']);
    $reason        = mysqli_real_escape_string($obj->getConnection(), trim($_POST['reason']));

    $statusSql = "SELECT status FROM orders WHERE order_id = '$order_id'";
    $statusResult = $obj->fetch($statusSql);
    $status = $statusResult[0]['status'];
    
    $insert_sql = "INSERT INTO order_cancel (order_id, shiprocket_order_id, type, acc_no, ifsc, bank_name, branch_add, banking_name, user_email, des, payment_status, order_status) 
                   VALUES ('$order_id', '$shiprocket_order_id', 'b2c', '$bank_account', '$ifsc', '$bank_name', '$branch_address', '$banking_name', '$user_email', '$reason', '$status', 'Request Cancellation')";

    if ($obj->query($insert_sql)) {
        $update_sql = "UPDATE orders SET order_status = 'Request Cancellation' WHERE order_id = '$order_id'";
        
        if ($obj->query($update_sql)) {
            echo json_encode([
                'success' => true,
                'message' => 'Order cancellation request submitted successfully.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to update order status.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to submit cancellation request.'
        ]);
    }
    exit;
}

echo json_encode([
    'success' => false,
    'message' => 'Invalid request.'
]);
exit;
?>