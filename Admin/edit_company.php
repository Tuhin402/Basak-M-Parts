<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $companyId = $_POST["company_id"];
    $companyName = $_POST["company_name"];
    $imageName = null;

    $query = "SELECT image FROM company WHERE id = '$companyId'";
    $result = $obj->query($query);
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row["image"];

    if (!empty($_FILES["company_image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["company_image"]["name"]);
        $targetPath = "uploads/company/" . $imageName;

        if (move_uploaded_file($_FILES["company_image"]["tmp_name"], $targetPath)) {
            if (!empty($oldImage) && file_exists("uploads/company/" . $oldImage)) {
                unlink("uploads/company/" . $oldImage); 
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    $sql = "UPDATE company SET name = '$companyName'";
    if ($imageName) {
        $sql .= ", image = '$imageName'";
    }
    $sql .= " WHERE id = '$companyId'";

    if ($obj->query($sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database update failed."]);
    }
}
?>