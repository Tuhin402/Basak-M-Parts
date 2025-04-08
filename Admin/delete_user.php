<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $userId = intval($_POST["id"]);

    if (!empty($userId)) {
        $delete = $obj->query("DELETE FROM profile WHERE id = $userId");

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