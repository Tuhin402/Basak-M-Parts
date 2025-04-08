<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bnr_id = $_POST["bnr_id"];
    $imageName = null;

    $query = "SELECT b2c_image FROM banner WHERE id = '$bnr_id'";
    $result = $obj->query($query);
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row["b2c_image"];

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = "uploads/banner/" . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            if (!empty($oldImage) && file_exists("uploads/banner/" . $oldImage)) {
                unlink("uploads/banner/" . $oldImage); 
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    if ($imageName) {
        $sql = "UPDATE banner SET b2c_image = '$imageName' WHERE id = '$bnr_id'";

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