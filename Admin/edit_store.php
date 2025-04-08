<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $connection = $obj -> getConnection();
    $store_id = $_POST["store_id"];

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $address = trim($_POST["address"] ?? '');
    $address = mysqli_real_escape_string($connection, $address);
    $imageName = null;

    $query = "SELECT image FROM stores WHERE id = '$store_id'";
    $result = $obj->query($query);
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row["image"];

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = "uploads/store/" . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            if (!empty($oldImage) && file_exists("uploads/store/" . $oldImage)) {
                unlink("uploads/store/" . $oldImage); 
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    $sql = "UPDATE stores SET name = '$name', phone = '$phone', email = '$email', address = '$address', date = '$date', time = '$time'";
    if ($imageName) {
        $sql .= ", image = '$imageName'";
    }
    $sql .= " WHERE id = '$store_id'";

    if ($obj->query($sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database update failed."]);
    }
}
?>