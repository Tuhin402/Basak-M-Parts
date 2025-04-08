<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $storeId = intval($_POST["id"]);

    $store = $obj->fetch("SELECT image FROM stores WHERE id = $storeId");

    if (!empty($store)) {
        $imagePath = "uploads/store/" . $store[0]['image'];
        $delete = $obj->query("DELETE FROM stores WHERE id = $storeId");

        if ($delete) {
            if (!empty($store[0]['image']) && file_exists($imagePath)) {
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