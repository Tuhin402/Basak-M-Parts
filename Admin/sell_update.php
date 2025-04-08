<?php
include "config.php"; 

if (!isset($_POST['product_id'], $_POST['type'], $_POST['price'], $_POST['qty'], $_POST['totalPrice']) ||
    empty($_POST['product_id']) || empty($_POST['type']) || empty($_POST['price']) || empty($_POST['qty']) || empty($_POST['totalPrice'])) {
    echo json_encode(["status" => "error", "message" => "All fields are required!"]);
    exit;
}

$product_id = $_POST['product_id'];
$type = $_POST['type'];
$price = $_POST['price'];
$qty = $_POST['qty'];
$totalPrice = $_POST['totalPrice'];
$date = $_POST['date'];

$productQuery = $obj->query("SELECT name, part, stock FROM products WHERE id = '$product_id'");
if (mysqli_num_rows($productQuery) > 0) {
    $product = mysqli_fetch_assoc($productQuery);
    $name = $product['name'];
    $part = $product['part'];
    $currentStock = $product['stock'];

    if ($qty > $currentStock) {
        echo json_encode(["status" => "error", "message" => "Insufficient stock available!"]);
        exit;
    }

    $insertQuery = "INSERT INTO offline_sell (name, part, pro_id, type, price, qty, totalprice, date) 
                    VALUES ('$name', '$part', '$product_id', '$type', '$price', '$qty', '$totalPrice', '$date')";
    $obj->query($insertQuery);

    $newStock = $currentStock - $qty;
    $obj->query("UPDATE products SET stock = '$newStock' WHERE id = '$product_id'");

    echo json_encode(["status" => "success", "message" => "Sale completed! Product successfully sold and stock adjusted."]);
} else {
    echo json_encode(["status" => "error", "message" => "Product not found!"]);
}
?>