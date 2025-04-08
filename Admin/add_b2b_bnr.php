<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $image = $_FILES["image"] ?? null;

    if (!$image || $image["error"] !== 0) {
        echo json_encode(["status" => "error", "message" => "There is only one field, fill it!"]);
        exit;
    }

    $uploadDir = "uploads/banner/";
    $fileName = time() . "_" . basename($image["name"]);
    $targetPath = $uploadDir . $fileName;

    if (!move_uploaded_file($image["tmp_name"], $targetPath)) {
        echo json_encode(["status" => "error", "message" => "Image upload failed"]);
        exit;
    }

    $sql = "INSERT INTO banner_two (b2b_image) VALUES ('$fileName')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Banner added successfully !" : "A problem occured !!"]);
}
?>