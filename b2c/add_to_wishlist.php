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

$check_query = "SELECT * FROM wishlist WHERE b2c_id = '$user_id' AND pro_id = '$product_id'";
$existing_wishlist = $obj->fetch($check_query);

if ($existing_wishlist) {
    echo json_encode(["status" => "error", "message" => "Product already in wishlist."]);
    exit;
}

$sql = "INSERT INTO wishlist (b2c_id, pro_id) VALUES ('$user_id', '$product_id')";
$obj->query($sql);

echo json_encode(["status" => "success"]);
exit;
?>