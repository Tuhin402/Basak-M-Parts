<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $categoryName = trim($_POST["categoryName"] ?? '');
    $image = $_FILES["categoryImage"] ?? null;

    if (empty($categoryName) || !$image || $image["error"] !== 0) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $uploadDir = "uploads/category/";
    $fileName = time() . "_" . basename($image["name"]);
    $targetPath = $uploadDir . $fileName;

    if (!move_uploaded_file($image["tmp_name"], $targetPath)) {
        echo json_encode(["status" => "error", "message" => "Image upload failed"]);
        exit;
    }

    $result = $obj->fetch("SELECT MAX(sort_order) AS max_order FROM product_category");
    $row = $result[0]['max_order'];
    $nextOrder = ($row && $row) ? $row + 1 : 1;

    $sql = "INSERT INTO product_category (sort_order, category, image) VALUES ('$nextOrder', '$categoryName', '$fileName')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Category added successfully !" : "A problem occured !!"]);
}
?>