<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = $_POST['product_id'];
    $new_stock = (int) $_POST['new_stock'];

    $product_category = $_POST['product_category']; 
    $product_company = $_POST['product_company']; 

    $mrp = $_POST['mrp'];
    $gst = $_POST['gst'];  
    $des = $_POST['des']; 
    $b2b_discount = $_POST['b2b_discount']; 
    $b2c_discount = $_POST['b2c_discount']; 
    $b2b_price = $_POST['b2b_price']; 
    $b2c_price = $_POST['b2c_price']; 

    $b2b_new_price = $b2b_price - ($b2b_price * $b2b_discount)/100;
    $b2c_new_price = $b2c_price - ($b2c_price * $b2c_discount)/100;

    $existingProduct = $obj->fetch("SELECT * FROM products WHERE id = '$product_id'");
    
    if (!$existingProduct) {
        echo json_encode(["status" => "error", "message" => "Product not found."]);
        exit;
    }

    $previous_stock = isset($existingProduct[0]['stock']) ? (int) $existingProduct[0]['stock'] : 0;
    $previous_mrp = $existingProduct[0]['mrp'];
    
    if ($mrp != $previous_mrp) {
        $insertFields = ["name", "description", "sku", "part", "mrp", "gst", "stock", "b2b_price", "b2c_price", "b2b_discount", "b2c_discount", "cat_id", "company_id"];
        $insertValues = [
            "'" . $obj->getConnection()->real_escape_string($existingProduct[0]['name']) . "'",
            "'$des'",
            "'" . $obj->getConnection()->real_escape_string($existingProduct[0]['sku']) . "'",
            "'" . $obj->getConnection()->real_escape_string($existingProduct[0]['part']) . "'",
            "'$mrp'",
            "'$gst'",
            "'$new_stock'",
            "'$b2b_new_price'",
            "'$b2c_new_price'",
            "'$b2b_discount'",
            "'$b2c_discount'",
            "'$product_category'",
            "'$product_company'",
        ];

        $imageFields = ["image1", "image2", "image3", "image4"];
        for ($i = 0; $i < 4; $i++) {
            if (!empty($_FILES[$imageFields[$i]]["name"])) {
                $fileName = time() . "_" . basename($_FILES[$imageFields[$i]]["name"]);
                $targetPath = "uploads/products/" . $fileName;
                
                if (move_uploaded_file($_FILES[$imageFields[$i]]["tmp_name"], $targetPath)) {
                    $insertFields[] = "image_" . ($i + 1);
                    $insertValues[] = "'$fileName'";
                }
            } else {
                $insertFields[] = "image_" . ($i + 1);
                $insertValues[] = "'" . $existingProduct[0]["image_" . ($i + 1)] . "'";
            }
        }

        $insertQuery = "INSERT INTO products (" . implode(", ", $insertFields) . ") VALUES (" . implode(", ", $insertValues) . ")";
        
        if ($obj->query($insertQuery)) {
            echo json_encode(["status" => "success", "message" => "New product added with updated MRP."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to insert new product."]);
        }
    } else {
        $updated_stock = $previous_stock + $new_stock;
        $updates = ["stock = '$updated_stock'"];

        $fields = [
            "product_category" => "cat_id",
            "product_company" => "company_id",
            "des" => "description",
            "sku_no" => "sku",
            "gst" => "gst",
            "part_no" => "part",
            "b2b_price" => "b2b_price",
            "b2c_price" => "b2c_price",
            "b2b_discount" => "b2b_discount",
            "b2c_discount" => "b2c_discount",
        ];

        foreach ($fields as $postField => $dbField) {
            if (isset($_POST[$postField]) && $_POST[$postField] !== $existingProduct[0][$dbField]) {
                $updates[] = "$dbField = '" . $obj->getConnection()->real_escape_string($_POST[$postField]) . "'";
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
                echo json_encode(["status" => "success", "message" => "Stock updated successfully."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Database update failed."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "No changes detected."]);
        }
    }
}
?>