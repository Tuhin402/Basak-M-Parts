<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $abt_id = $_POST["abt_id"];
    $title = $_POST["title"];

    $des = trim($_POST["des"] ?? '');
    $connection = $obj -> getConnection();
    $des = mysqli_real_escape_string($connection, $des);

    if (!empty($title) || !empty($des)) {
        $sql = "UPDATE about_headshot SET title = '$title', des = '$des' WHERE id = '$abt_id'";

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