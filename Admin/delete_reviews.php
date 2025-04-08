<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $reviewId = intval($_POST["id"]);

    $review = $obj->fetch("SELECT * FROM reviews WHERE id = $reviewId");

    if (!empty($review)) {
        $delete = $obj->query("DELETE FROM reviews WHERE id = $reviewId");

        if ($delete) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
?>