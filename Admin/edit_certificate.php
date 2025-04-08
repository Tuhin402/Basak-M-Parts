<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cer_id = $_POST["certificate_id"];
    $imageName = null;

    $query = "SELECT image FROM certificates WHERE id = '$cer_id'";
    $result = $obj->query($query);
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row["image"];

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = "uploads/certificate/" . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            if (!empty($oldImage) && file_exists("uploads/certificate/" . $oldImage)) {
                unlink("uploads/certificate/" . $oldImage); 
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    if ($imageName) {
        $sql = "UPDATE certificates SET image = '$imageName' WHERE id = '$cer_id'";

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