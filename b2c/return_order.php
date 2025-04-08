<?php
require_once '../Admin/config.php'; 
header('Content-Type: application/json');

$uploadDir = '../Admin/uploads/return/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'return_order') {
    $shiprocket_order_id = trim($_POST['shiprocket_order_id']);
    $order_id = trim($_POST['order_id']);
    $user_email = trim($_POST['user_email']);
    $bank_account = trim($_POST['bank_account']);
    $ifsc = trim($_POST['ifsc']);
    $bank_name = trim($_POST['bank_name']);
    $branch_address = trim($_POST['branch_address']);
    $banking_name = trim($_POST['banking_name']);
    $reason = mysqli_real_escape_string($obj->getConnection(), trim($_POST['reason']));

    $statusSql = "SELECT status FROM orders WHERE order_id = '$order_id'";
    $statusResult = $obj->fetch($statusSql);
    $status = $statusResult[0]['status'] ?? 'Pending';

    if (empty($_FILES)) {
        echo json_encode(['success' => false, 'message' => 'No files received. Check AJAX request.']);
        exit;
    }

    $imagePaths = [];
    for ($i = 1; $i <= 4; $i++) {
        $imageKey = "image_$i";
        
        if (!isset($_FILES[$imageKey]) || $_FILES[$imageKey]['error'] !== UPLOAD_ERR_OK) {
            error_log("Error in uploading $imageKey: " . $_FILES[$imageKey]['error']);
            $imagePaths[$i] = null;
            continue;
        }

        $fileExtension = pathinfo($_FILES[$imageKey]['name'], PATHINFO_EXTENSION);
        $fileName = time() . "_$order_id" . "_$i." . $fileExtension;
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES[$imageKey]['tmp_name'], $filePath)) {
            $imagePaths[$i] = $filePath;
        } else {
            error_log("Failed to move uploaded file for $imageKey.");
            echo json_encode(['success' => false, 'message' => "Failed to upload image $i"]);
            exit;
        }
    }

    $insert_sql = "INSERT INTO order_refund (order_id, shiprocket_order_id, type, acc_no, ifsc, bank_name, branch_add, banking_name, user_email, des, payment_status, refund_status, image_1, image_2, image_3, image_4) 
        VALUES ('$order_id', '$shiprocket_order_id', 'b2c', '$bank_account', '$ifsc', '$bank_name', '$branch_address', '$banking_name', '$user_email', '$reason', '$status', 'Request Return', 
        '{$imagePaths[1]}', '{$imagePaths[2]}', '{$imagePaths[3]}', '{$imagePaths[4]}')";

    if ($obj->query($insert_sql)) {
        $update_sql = "UPDATE orders SET refund_status = 'Request Return' WHERE order_id = '$order_id'";
        
        if ($obj->query($update_sql)) {
            echo json_encode([
                'success' => true,
                'message' => 'Order return request submitted successfully.'
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
            'message' => 'Failed to submit return request.'
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