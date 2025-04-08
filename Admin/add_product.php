<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_name = mysqli_real_escape_string($obj->getConnection(), $_POST["product_name"]);
    $description = mysqli_real_escape_string($obj->getConnection(), $_POST["des"]);
    $sku = mysqli_real_escape_string($obj->getConnection(), $_POST["sku_no"]);
    $part = mysqli_real_escape_string($obj->getConnection(), $_POST["part_no"]);
    $mrp = mysqli_real_escape_string($obj->getConnection(), $_POST["mrp"]);
    $gst = mysqli_real_escape_string($obj->getConnection(), $_POST["gst"]);
    $b2b_price = mysqli_real_escape_string($obj->getConnection(), $_POST["b2b_price"]);
    $b2c_price = mysqli_real_escape_string($obj->getConnection(), $_POST["b2c_price"]);
    $ship = isset($_POST["ship"]) && $_POST["ship"] !== "" ? mysqli_real_escape_string($obj->getConnection(), $_POST["ship"]) : 0;
    $b2b_discount = isset($_POST["b2b_discount"]) && $_POST["b2b_discount"] !== "" ? mysqli_real_escape_string($obj->getConnection(), $_POST["b2b_discount"]) : 0;
    $b2c_discount = isset($_POST["b2c_discount"]) && $_POST["b2c_discount"] !== "" ? mysqli_real_escape_string($obj->getConnection(), $_POST["b2c_discount"]) : 0;
    $cat_id = mysqli_real_escape_string($obj->getConnection(), $_POST["product_category"]);
    $company_id = mysqli_real_escape_string($obj->getConnection(), $_POST["product_company"]);
    $stock = mysqli_real_escape_string($obj->getConnection(), $_POST["stock"]);
    $best_seller = isset($_POST["best_seller"]) && $_POST["best_seller"] !== "" ? mysqli_real_escape_string($obj->getConnection(), $_POST["best_seller"]) : 0;
    $b2c_special_discount = isset($_POST["b2c_special_discount"]) && $_POST["b2c_special_discount"] !== "" ? mysqli_real_escape_string($obj->getConnection(), $_POST["b2c_special_discount"]) : 0;

    $upload_dir = "uploads/products/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    function uploadImage($file, $upload_dir) {
        if (!empty($file["name"])) {
            $file_name = time() . "_" . basename($file["name"]);
            $target_file = $upload_dir . $file_name;
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return $file_name;
            }
        }
        return null;
    }

    $image1 = uploadImage($_FILES["image1"], $upload_dir);
    $image2 = uploadImage($_FILES["image2"], $upload_dir);
    $image3 = uploadImage($_FILES["image3"], $upload_dir);
    $image4 = uploadImage($_FILES["image4"], $upload_dir);

    if (!$product_name || !$description || !$sku || !$part || !$b2b_price || !$b2c_price || !$cat_id || !$company_id || !$stock || !$image1) {
        echo json_encode(["status" => "error", "message" => "Please fill all required fields!"]);
        exit();
    }

    $result = $obj->fetch("SELECT MAX(sort_order) AS max_order FROM products");
    $row = $result[0]['max_order'];
    $nextOrder = ($row && $row) ? $row + 1 : 1;

    $query = "INSERT INTO products (sort_order, name, description, sku, part, mrp, gst, b2b_price, b2c_price, shipping_price, b2b_discount, b2c_discount, b2c_special_discount, cat_id, company_id, stock, best_seller, image_1, image_2, image_3, image_4) 
              VALUES ('$nextOrder', '$product_name', '$description', '$sku', '$part', '$mrp', '$gst', '$b2b_price', '$b2c_price', '$ship', '$b2b_discount', '$b2c_discount', '$b2c_special_discount', '$cat_id', '$company_id', '$stock', '$best_seller', '$image1', '$image2', '$image3', '$image4')";
    $result = $obj->query($query);

    if ($result) {
        $categoryCompanyQuery = "INSERT INTO category_company (cat_id, company_id) VALUES ('$cat_id', '$company_id')";
        $obj->query($categoryCompanyQuery);

        echo json_encode(["status" => "success", "message" => "Product added successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add product. Try again."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>