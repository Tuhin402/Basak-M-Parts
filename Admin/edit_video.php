<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vdo_id = $_POST["vdo_id"];
    $link = $_POST["link"];
    $imageName = null;

    $query = "SELECT image FROM videos WHERE id = '$vdo_id'";
    $result = $obj->query($query);
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row["image"];

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = "uploads/videos/" . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            if (!empty($oldImage) && file_exists("uploads/videos/" . $oldImage)) {
                unlink("uploads/videos/" . $oldImage); 
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    $sql = "UPDATE videos SET link = '$link'";
    if ($imageName) {
        $sql .= ", image = '$imageName'";
    }
    $sql .= " WHERE id = '$vdo_id'";

    if ($obj->query($sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database update failed."]);
    }
}
?>