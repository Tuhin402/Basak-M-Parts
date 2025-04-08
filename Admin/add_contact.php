<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $connection = $obj -> getConnection();

    $phone = $_POST["phone"];
    $helpline = $_POST["helpline"];
    $email = $_POST["email"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $address = trim($_POST["address"] ?? '');
    $address = mysqli_real_escape_string($connection, $address);

    $map = trim($_POST["map"] ?? '');
    $map = mysqli_real_escape_string($connection, $map);

    if (empty($phone) || empty($address) || empty($map) || empty($helpline) || empty($email) || empty($date) || empty($time)) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    $sql = "INSERT INTO contact (phone, helpline, email, address, open_date, open_time, map) VALUES ('$phone', '$helpline', '$email', '$address', '$date', '$time', '$map')";
    $result = $obj->query($sql);

    echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Details added successfully !" : "A problem occured !!"]);
}
?>