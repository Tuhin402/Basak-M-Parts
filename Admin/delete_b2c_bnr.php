<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $bnrId = intval($_POST["id"]);

    $banner = $obj->fetch("SELECT b2c_image FROM banner WHERE id = $bnrId");

    if (!empty($banner)) {
        $imagePath = "uploads/banner/" . $banner[0]['b2c_image'];
        $delete = $obj->query("DELETE FROM banner WHERE id = $bnrId");

        if ($delete) {
            if (!empty($banner[0]['b2c_image']) && file_exists($imagePath)) {
                unlink($imagePath);
            }
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
?>