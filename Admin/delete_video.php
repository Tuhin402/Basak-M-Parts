<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $vdoId = intval($_POST["id"]);

    $video = $obj->fetch("SELECT image FROM videos WHERE id = $vdoId");

    if (!empty($video)) {
        $imagePath = "uploads/videos/" . $video[0]['image'];
        $delete = $obj->query("DELETE FROM videos WHERE id = $vdoId");

        if ($delete) {
            if (!empty($video[0]['image']) && file_exists($imagePath)) {
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