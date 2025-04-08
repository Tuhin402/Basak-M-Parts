<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST["user_id"];
    $name = mysqli_real_escape_string($obj->getConnection(), $_POST["name"]);
    $type = mysqli_real_escape_string($obj->getConnection(), $_POST["type"]);
    $phone = mysqli_real_escape_string($obj->getConnection(), $_POST["phone"]);
    $address = mysqli_real_escape_string($obj->getConnection(), $_POST["address"]);
    $email = mysqli_real_escape_string($obj->getConnection(), $_POST["email"]);
    $password = mysqli_real_escape_string($obj->getConnection(), $_POST["password"]);

    $encodedPassword = base64_encode($password);

    if (!empty($user_id)) {
        $sql = "UPDATE profile SET name = '$name', type = '$type', phone = '$phone', address = '$address', email = '$email', password = '$encodedPassword' WHERE id = '$user_id'";
        $result = $obj->query($sql);

        if ($result) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database update failed."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No changes made."]);
    }
}
?>