<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $deal_id = $_POST["deal_id"];
    $title = $_POST["title"];
    $link = $_POST["link"];
    $imageName = null;

    $query = "SELECT image FROM popular_picks_b2b WHERE id = '$deal_id'";
    $result = $obj->query($query);
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row["image"];

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = "uploads/popular/" . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            if (!empty($oldImage) && file_exists("uploads/popular/" . $oldImage)) {
                unlink("uploads/popular/" . $oldImage); 
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    $sql = "UPDATE popular_picks_b2b SET title = '$title', link = '$link'";
    if ($imageName) {
        $sql .= ", image = '$imageName'";
    }
    $sql .= " WHERE id = '$deal_id'";

    if ($obj->query($sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database update failed."]);
    }
}
?>