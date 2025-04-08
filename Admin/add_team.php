<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? '');

    $role = trim($_POST["role"] ?? '');
    $connection = $obj -> getConnection();
    $role = mysqli_real_escape_string($connection, $role);
    
    $link = trim($_POST["link"] ?? '');
    $image = $_FILES["image"] ?? null;

    if (empty($name) || !$image || $image["error"] !== 0) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $uploadDir = "uploads/team/";
    $fileName = time() . "_" . basename($image["name"]);
    $targetPath = $uploadDir . $fileName;

    if (!move_uploaded_file($image["tmp_name"], $targetPath)) {
        echo json_encode(["status" => "error", "message" => "Image upload failed"]);
        exit;
    }

    $sql = "INSERT INTO team (name, role, social, image) VALUES ('$name', '$role', '$link', '$fileName')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Member added successfully !" : "A problem occured !!"]);
}
?>