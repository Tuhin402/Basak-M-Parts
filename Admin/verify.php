<?php
include 'session_config.php';
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "All fields are required!"]);
        exit;
    }

    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $user = $obj->fetch($sql);

    if (!empty($user)) {
        $_SESSION["user_id"] = $user[0]["id"];
        $_SESSION["user_name"] = $user[0]["name"];
        $_SESSION["user_email"] = $user[0]["email"];
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid Email or Password!"]);
    }
}
?>