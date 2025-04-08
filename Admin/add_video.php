<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $link = trim($_POST["link"] ?? '');
    $image = $_FILES["image"] ?? null;

    if (empty($link) || !$image || $image["error"] !== 0) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $uploadDir = "uploads/videos/";
    $fileName = time() . "_" . basename($image["name"]);
    $targetPath = $uploadDir . $fileName;

    if (!move_uploaded_file($image["tmp_name"], $targetPath)) {
        echo json_encode(["status" => "error", "message" => "Image upload failed"]);
        exit;
    }

    $sql = "INSERT INTO videos (link, image) VALUES ('$link', '$fileName')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Tutorial added successfully !" : "A problem occured !!"]);
}
?>