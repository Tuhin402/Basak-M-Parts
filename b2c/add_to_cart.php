<?php
include 'session_config.php';
require_once "../Admin/config.php";

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["status" => "not_logged_in"]);
    exit;
}

$user_id = $_SESSION["user_id"];
$product_id = $_POST["product_id"] ?? null;
$price = $_POST["price"] ?? null;

if (!$product_id || !$price) {
    echo json_encode(["status" => "error", "message" => "Invalid product details."]);
    exit;
}

$shipSql = "SELECT shipping_price, b2c_special_discount FROM products WHERE id = '$product_id'";
$shipAmount = $obj->fetch($shipSql);
$ship = $shipAmount[0]['shipping_price'];
$b2c_special_discount = $shipAmount[0]['b2c_special_discount'];
$newPrice = $price - ($price * ($b2c_special_discount / 100)); 

$check_query = "SELECT * FROM cart WHERE b2c_id = '$user_id' AND pro_id = '$product_id'";
$existing_cart = $obj->fetch($check_query);

if ($existing_cart) {
    echo json_encode(["status" => "error", "message" => "Product already in cart."]);
    exit;
}

$sql = "INSERT INTO cart (b2c_id, pro_id, qty, total_price, shipping_price) VALUES ('$user_id', '$product_id', 1, '$newPrice', '$ship')";
$obj->query($sql);

echo json_encode(["status" => "success"]);
exit;
?>