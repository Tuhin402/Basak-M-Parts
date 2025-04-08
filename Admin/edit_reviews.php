<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $review_id = $_POST["review_id"];
    $title = $_POST["title"];

    $des = trim($_POST["des"] ?? '');
    $connection = $obj -> getConnection();
    $des = mysqli_real_escape_string($connection, $des);

    $name = $_POST["name"];
    $rating = $_POST["rating"];

    if (!empty($title) || !empty($des) || !empty($name) || !empty($rating)) {
        $sql = "UPDATE reviews SET title = '$title', des = '$des', name = '$name', rating = '$rating' WHERE id = '$review_id'";

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