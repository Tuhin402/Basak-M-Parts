<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $connection = $obj -> getConnection();

    $detail_id = $_POST["detail_id"];

    $phone = $_POST["phone"];
    $helpline = $_POST["helpline"];
    $email = $_POST["email"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $address = trim($_POST["address"] ?? '');
    $address = mysqli_real_escape_string($connection, $address);

    $map = trim($_POST["map"] ?? '');
    $map = mysqli_real_escape_string($connection, $map);

    if (!empty($phone) || !empty($helpline) || !empty($email) || !empty($address) || !empty($map) || !empty($date) || !empty($time)) {
        $sql = "UPDATE contact SET phone = '$phone', helpline = '$helpline', email = '$email', address = '$address', open_date = '$date', open_time = '$time', map = '$map' WHERE id = '$detail_id'";

        if ($obj->query($sql)) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database update failed."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No changes made."]);
    }
}
?>