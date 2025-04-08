<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? '');

    $des = trim($_POST["des"] ?? '');
    $connection = $obj -> getConnection();
    $des = mysqli_real_escape_string($connection, $des);

    if (empty($title) || empty($des)) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $sql = "INSERT INTO about_headshot (title, des) VALUES ('$title', '$des')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "About added successfully !" : "A problem occured !!"]);
}
?>