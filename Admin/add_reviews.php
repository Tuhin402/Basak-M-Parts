<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? '');

    $des = trim($_POST["des"] ?? '');
    $connection = $obj -> getConnection();
    $des = mysqli_real_escape_string($connection, $des);

    $name = trim($_POST["name"] ?? '');
    $rating = trim($_POST["rating"] ?? '');

    if (empty($title) || empty($des) || empty($name) || empty($rating)) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $sql = "INSERT INTO reviews (title, des, name, rating) VALUES ('$title', '$des', '$name', '$rating')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Review added successfully !" : "A problem occured !!"]);
}
?>