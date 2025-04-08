<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $companyName = trim($_POST["companyName"] ?? '');
    $image = $_FILES["companyImage"] ?? null;

    if (empty($companyName) || !$image || $image["error"] !== 0) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $uploadDir = "uploads/company/";
    $fileName = time() . "_" . basename($image["name"]);
    $targetPath = $uploadDir . $fileName;

    if (!move_uploaded_file($image["tmp_name"], $targetPath)) {
        echo json_encode(["status" => "error", "message" => "Image upload failed"]);
        exit;
    }

    $result = $obj->fetch("SELECT MAX(sort_order) AS max_order FROM company");
    $row = $result[0]['max_order'];
    $nextOrder = ($row && $row) ? $row + 1 : 1;

    $sql = "INSERT INTO company (sort_order, name, image) VALUES ('$nextOrder', '$companyName', '$fileName')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Company added successfully !" : "A problem occured !!"]);
}
?>