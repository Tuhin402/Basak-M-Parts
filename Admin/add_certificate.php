<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $image = $_FILES["image"] ?? null;

    if (!$image || $image["error"] !== 0) {
        echo json_encode(["status" => "error", "message" => "There is only one field, fill it!"]);
        exit;
    }

    $uploadDir = "uploads/certificate/";
    $fileName = time() . "_" . basename($image["name"]);
    $targetPath = $uploadDir . $fileName;

    if (!move_uploaded_file($image["tmp_name"], $targetPath)) {
        echo json_encode(["status" => "error", "message" => "Image upload failed"]);
        exit;
    }

    $sql = "INSERT INTO certificates (image) VALUES ('$fileName')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Certificate added successfully !" : "A problem occured !!"]);
}
?>