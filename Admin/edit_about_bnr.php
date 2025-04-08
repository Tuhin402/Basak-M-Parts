<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $abt_id = $_POST["abt_id"];
    $title = $_POST["title"];
    $imageName = null;

    $query = "SELECT image FROM about_bnr WHERE id = '$abt_id'";
    $result = $obj->query($query);
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row["image"];

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = "uploads/about/" . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            if (!empty($oldImage) && file_exists("uploads/about/" . $oldImage)) {
                unlink("uploads/about/" . $oldImage); 
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    $sql = "UPDATE about_bnr SET title = '$title'";
    if ($imageName) {
        $sql .= ", image = '$imageName'";
    }
    $sql .= " WHERE id = '$abt_id'";

    if ($obj->query($sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database update failed."]);
    }
}
?>