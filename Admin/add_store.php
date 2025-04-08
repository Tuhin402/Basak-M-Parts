<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $connection = $obj -> getConnection();

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $address = trim($_POST["address"] ?? '');
    $address = mysqli_real_escape_string($connection, $address);

    $image = $_FILES["image"] ?? null;

    if (empty($name) || empty($phone) || empty($email) || empty($address) || !$image || $image["error"] !== 0) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $uploadDir = "uploads/store/";
    $fileName = time() . "_" . basename($image["name"]);
    $targetPath = $uploadDir . $fileName;

    if (!move_uploaded_file($image["tmp_name"], $targetPath)) {
        echo json_encode(["status" => "error", "message" => "Image upload failed"]);
        exit;
    }

    $sql = "INSERT INTO stores (name, phone, email, address, date, time, image) VALUES ('$name', '$phone', '$email', '$address', '$date', '$time', '$fileName')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Store added successfully !" : "A problem occured !!"]);
}
?>