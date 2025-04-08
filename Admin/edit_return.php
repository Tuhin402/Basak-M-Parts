<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $policy_id = $_POST["policy_id"];
    $title = $_POST["title"];

    $des = trim($_POST["des"] ?? '');
    $connection = $obj -> getConnection();
    $des = mysqli_real_escape_string($connection, $des);

    if (!empty($title) || !empty($des)) {
        $sql = "UPDATE return_policy SET title = '$title', des = '$des' WHERE id = '$policy_id'";

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