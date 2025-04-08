<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = $_POST['product_id'];

    $existingProduct = $obj->fetch("SELECT * FROM products WHERE id = '$product_id'");
    if (!$existingProduct) {
        echo json_encode(["status" => "error", "message" => "Product not found."]);
        exit;
    }
    
    $updates = [];

    $fields = [
        "product_name" => "name",
        "product_category" => "cat_id",
        "product_company" => "company_id",
        "des" => "description",
        "sku_no" => "sku",
        "part_no" => "part",
        "mrp" => "mrp",
        "gst" => "gst",
        "stock" => "stock",
        "best_seller" => "best_seller",
        "b2b_price" => "b2b_price",
        "b2c_price" => "b2c_price",
        "ship" => "shipping_price",
        "b2b_discount" => "b2b_discount",
        "b2c_discount" => "b2c_discount",
        "b2c_special_discount" => "b2c_special_discount",
    ];

    $categoryChanged = false;
    $companyChanged = false;
    
    foreach ($fields as $postField => $dbField) {
        if (isset($_POST[$postField]) && $_POST[$postField] !== $existingProduct[0][$dbField]) {
            $updates[] = "$dbField = '" . $obj->getConnection()->real_escape_string($_POST[$postField]) . "'";
            if ($postField === "product_category") {
                $categoryChanged = true;
            }
            if ($postField === "product_company") {
                $companyChanged = true;
            }
        }
    }

    $imageFields = ["image1", "image2", "image3", "image4"];
    foreach ($imageFields as $key => $imageField) {
        if (!empty($_FILES[$imageField]["name"])) {
            $fileName = time() . "_" . basename($_FILES[$imageField]["name"]);
            $targetPath = "uploads/products/" . $fileName;

            if (move_uploaded_file($_FILES[$imageField]["tmp_name"], $targetPath)) {
                $updates[] = "image_" . ($key + 1) . " = '$fileName'";
            }
        }
    }

    if (!empty($updates)) {
        $updateQuery = "UPDATE products SET " . implode(", ", $updates) . " WHERE id = '$product_id'";
        if ($obj->query($updateQuery)) {
            if ($categoryChanged || $companyChanged) {
                $newCategory = $_POST['product_category'];
                $newCompany = $_POST['product_company'];
                
                $obj->query("UPDATE category_company SET cat_id = '$newCategory', company_id = '$newCompany' WHERE cat_id = '{$existingProduct[0]['cat_id']}' AND company_id = '{$existingProduct[0]['company_id']}'");
            }
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database update failed."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No changes detected."]);
    }
}
?>