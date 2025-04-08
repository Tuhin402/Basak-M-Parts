<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? '');
    $link = trim($_POST["link"] ?? '');
    $image = $_FILES["image"] ?? null;

    if (empty($title) || !$image || $image["error"] !== 0) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $uploadDir = "uploads/popular/";
    $fileName = time() . "_" . basename($image["name"]);
    $targetPath = $uploadDir . $fileName;

    if (!move_uploaded_file($image["tmp_name"], $targetPath)) {
        echo json_encode(["status" => "error", "message" => "Image upload failed"]);
        exit;
    }

    $sql = "INSERT INTO popular_picks_b2c (title, link, image) VALUES ('$title', '$link', '$fileName')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Deal added successfully !" : "A problem occured !!"]);
}
?>