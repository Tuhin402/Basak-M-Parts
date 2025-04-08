<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 1);

include 'session_config.php';
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
    exit;
}

$cancel_id    = isset($_POST['cancel_id']) ? $_POST['cancel_id'] : '';
$order_id     = isset($_POST['order_id']) ? $_POST['order_id'] : '';
$shiprocket_id     = isset($_POST['shiprocket_order_id']) ? $_POST['shiprocket_order_id'] : '';
$action       = isset($_POST['action']) ? $_POST['action'] : '';
$admin_notice = isset($_POST['admin_notice']) ? trim($_POST['admin_notice']) : '';
$admin_proof  = '-';

if (isset($_FILES['support_document']) && $_FILES['support_document']['error'] == 0) {
    $allowedExts = ['pdf', 'jpg', 'jpeg', 'doc', 'docx'];
    $fileName = $_FILES['support_document']['name'];
    $tempPath = $_FILES['support_document']['tmp_name'];
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (in_array($ext, $allowedExts)) {
        $newFileName = uniqid('proof_') . '.' . $ext;
        $uploadDir = "uploads/proof/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if (move_uploaded_file($tempPath, $uploadDir . $newFileName)) {
            $admin_proof = $newFileName;
        }
    }
}

if (empty($admin_notice)) {
    $admin_notice = '-';
}

if ($action === 'approve') {
    $newStatus = "Return Approved";
} elseif ($action === 'reject') {
    $newStatus = "Return Rejected";
} else {
    echo json_encode(["success" => false, "message" => "Invalid action"]);
    exit;
}

$sql_cancel = "UPDATE order_refund SET admin_notice = ?, admin_proof = ?, refund_status = ? WHERE id = ? AND order_id = ?";
$stmt = $obj->getConnection()->prepare($sql_cancel);
if ($stmt) {
    $stmt->bind_param("sssss", $admin_notice, $admin_proof, $newStatus, $cancel_id, $order_id);
    $stmt->execute();
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Database error: " . $obj->getConnection()->error]);
    exit;
}

$sql_orders = "UPDATE orders SET refund_status = ? WHERE order_id = ?";
$stmt2 = $obj->getConnection()->prepare($sql_orders);
if ($stmt2) {
    $stmt2->bind_param("ss", $newStatus, $order_id);
    $stmt2->execute();
    $stmt2->close();
} else {
    echo json_encode(["success" => false, "message" => "Database error: " . $obj->getConnection()->error]);
    exit;
}

// ------------------------
// SEND EMAIL TO CUSTOMER
// ------------------------

$sql_email = "SELECT banking_name, user_email FROM order_refund WHERE id = ?";
$stmtEmail = $obj->getConnection()->prepare($sql_email);
if ($stmtEmail) {
    $stmtEmail->bind_param("s", $cancel_id);
    $stmtEmail->execute();
    $result = $stmtEmail->get_result();
    if ($row = $result->fetch_assoc()) {
        $customerName = $row['banking_name'];
        $customerEmail = $row['user_email'];
    } else {
        $customerName = "Customer";
        $customerEmail = "";
    }
    $stmtEmail->close();
}

if (!empty($customerEmail)) {
    $subject = "Order Return Update";
    
    $messageBody = "
    <html>
    <head>
      <title>Order Return Update</title>
    </head>
    <body>
      <p>Dear {$customerName},</p>
      <p>Your order return has been processed successfully. Please find the details below:</p>
      <p>{$admin_notice}</p>
      <p>Thank you for your patience and understanding.</p>
      <p>Best regards,<br>Basak M Parts</p>
    </body>
    </html>
    ";
    
    $eol = "\r\n";
    $headers = "From: Basak M Parts <no-reply@yourdomain.com>" . $eol;
    $headers .= "Reply-To: no-reply@yourdomain.com" . $eol;
    $headers .= "X-Mailer: PHP/" . phpversion() . $eol;
    
    $attachmentFilePath = "uploads/proof/" . $admin_proof;
    if ($admin_proof != '-' && file_exists($attachmentFilePath)) {
        $separator = md5(time());
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;
        
        $body = "--" . $separator . $eol;
        $body .= "Content-Type: text/html; charset=\"UTF-8\"" . $eol;
        $body .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;
        $body .= $messageBody . $eol;
        
        $attachment = chunk_split(base64_encode(file_get_contents($attachmentFilePath)));
        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: application/octet-stream; name=\"" . basename($attachmentFilePath) . "\"" . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-Disposition: attachment; filename=\"" . basename($attachmentFilePath) . "\"" . $eol . $eol;
        $body .= $attachment . $eol;
        $body .= "--" . $separator . "--";
    } else {
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: text/html; charset=\"UTF-8\"" . $eol;
        $body = $messageBody;
    }
    
    mail($customerEmail, $subject, $body, $headers);
}

$message = ($action === 'approve') ? "Return Approved successfully" : "Return Rejected successfully";
echo json_encode(["success" => true, "message" => $message]);
exit;

?>