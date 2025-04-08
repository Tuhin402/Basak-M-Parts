<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $detailId = intval($_POST["id"]);

    $contact = $obj->fetch("SELECT * FROM contact WHERE id = $detailId");

    if (!empty($contact)) {
        $delete = $obj->query("DELETE FROM contact WHERE id = $detailId");

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