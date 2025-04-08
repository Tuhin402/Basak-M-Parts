<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $member_id = $_POST["member_id"];
    $name = $_POST["name"];

    $role = trim($_POST["role"] ?? '');
    $connection = $obj -> getConnection();
    $role = mysqli_real_escape_string($connection, $role);

    $link = $_POST["link"];
    $imageName = null;

    $query = "SELECT image FROM team WHERE id = '$member_id'";
    $result = $obj->query($query);
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row["image"];

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = "uploads/team/" . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            if (!empty($oldImage) && file_exists("uploads/team/" . $oldImage)) {
                unlink("uploads/team/" . $oldImage); 
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    $sql = "UPDATE team SET name = '$name', role = '$role', social = '$link'";
    if ($imageName) {
        $sql .= ", image = '$imageName'";
    }
    $sql .= " WHERE id = '$member_id'";

    if ($obj->query($sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database update failed."]);
    }
}
?>