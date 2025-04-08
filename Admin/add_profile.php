<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = mysqli_real_escape_string($obj->getConnection(), $_POST["name"]);
    $type = mysqli_real_escape_string($obj->getConnection(), $_POST["type"]);
    $phone = mysqli_real_escape_string($obj->getConnection(), $_POST["phone"]);
    $address = mysqli_real_escape_string($obj->getConnection(), $_POST["address"]);
    $email = mysqli_real_escape_string($obj->getConnection(), $_POST["email"]);
    $password = mysqli_real_escape_string($obj->getConnection(), $_POST["password"]);

    $encodedPassword = base64_encode($password);

    if (!$name || !$type || !$email || !$password) {
        echo json_encode(["status" => "error", "message" => "Please fill all required fields!"]);
        exit();
    }

    $chekQuery = "SELECT * FROM profile WHERE email = '$email'";
    $emailExists = $obj->num($chekQuery);
    if ($emailExists > 0) {
        echo json_encode(["status" => "error", "message" => "Email already registered!"]);
    } else {
        $query = "INSERT INTO profile (name, email, phone, address, type, password) VALUES ('$name', '$email', '$phone', '$address', '$type', '$encodedPassword')";
        $result = $obj->query($query);

        if ($result) {
            echo json_encode(["status" => "success", "message" => "User Account Created successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to create user. Try again."]);
        }
    }

} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>