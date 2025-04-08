<?php
session_start();
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "All fields are required!"]);
        exit;
    }

    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $emailExists = $obj->num($sql);
    if ($emailExists > 0) {
        echo json_encode(["status" => "error", "message" => "Email already registered!"]);
    } else {
        $query = "INSERT INTO admin (name, email, password) VALUES ('$name', '$email', '$password')";
        $user = $obj->query($query);

        if ($user) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to create account. Try again."]);
        }
    }

} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>