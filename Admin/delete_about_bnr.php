<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $abtId = intval($_POST["id"]);

    $aboutBanner = $obj->fetch("SELECT image FROM about_bnr WHERE id = $abtId");

    if (!empty($aboutBanner)) {
        $imagePath = "uploads/about/" . $aboutBanner[0]['image'];
        $delete = $obj->query("DELETE FROM about_bnr WHERE id = $abtId");

        if ($delete) {
            if (!empty($aboutBanner[0]['image']) && file_exists($imagePath)) {
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