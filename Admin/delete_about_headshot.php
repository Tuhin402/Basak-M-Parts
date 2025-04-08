<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $abtId = intval($_POST["id"]);

    $about = $obj->fetch("SELECT * FROM about_headshot WHERE id = $abtId");

    if (!empty($about)) {
        $delete = $obj->query("DELETE FROM about_headshot WHERE id = $abtId");

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