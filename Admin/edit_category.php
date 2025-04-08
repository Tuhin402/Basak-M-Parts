<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $categoryId = $_POST["category_id"];
    $categoryName = $_POST["category_name"];
    $imageName = null;

    $query = "SELECT image FROM product_category WHERE id = '$categoryId'";
    $result = $obj->query($query);
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row["image"];

    if (!empty($_FILES["category_image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["category_image"]["name"]);
        $targetPath = "uploads/category/" . $imageName;

        if (move_uploaded_file($_FILES["category_image"]["tmp_name"], $targetPath)) {
            if (!empty($oldImage) && file_exists("uploads/category/" . $oldImage)) {
                unlink("uploads/category/" . $oldImage); 
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    $sql = "UPDATE product_category SET category = '$categoryName'";
    if ($imageName) {
        $sql .= ", image = '$imageName'";
    }
    $sql .= " WHERE id = '$categoryId'";

    if ($obj->query($sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database update failed."]);
    }
}
?>