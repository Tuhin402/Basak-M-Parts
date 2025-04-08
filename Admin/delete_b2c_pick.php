<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $dealId = intval($_POST["id"]);

    $deal = $obj->fetch("SELECT image FROM popular_picks_b2c WHERE id = $dealId");

    if (!empty($deal)) {
        $imagePath = "uploads/popular/" . $deal[0]['image'];
        $delete = $obj->query("DELETE FROM popular_picks_b2c WHERE id = $dealId");

        if ($delete) {
            if (!empty($deal[0]['image']) && file_exists($imagePath)) {
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