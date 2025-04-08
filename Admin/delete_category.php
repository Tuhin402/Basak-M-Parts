<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $categoryId = intval($_POST["id"]);

    $category = $obj->fetch("SELECT image FROM product_category WHERE id = $categoryId");

    if (!empty($category)) {
        $imagePath = "uploads/category/" . $category[0]['image'];
        $delete = $obj->query("DELETE FROM product_category WHERE id = $categoryId");

        if ($delete) {
            if (!empty($category[0]['image']) && file_exists($imagePath)) {
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