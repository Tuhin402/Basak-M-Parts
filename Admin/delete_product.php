<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $productId = intval($_POST["id"]);

    $product = $obj->fetch("SELECT image_1, image_2, image_3, image_4 FROM products WHERE id = $productId");

    if (!empty($product)) {
        $images = [$product[0]['image_1'], $product[0]['image_2'], $product[0]['image_3'], $product[0]['image_4']];
        $delete = $obj->query("DELETE FROM products WHERE id = $productId");

        if ($delete) {
            foreach ($images as $image) {
                $imagePath = "uploads/products/" . $image;
                if (!empty($image) && file_exists($imagePath)) {
                    unlink($imagePath);
                }
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