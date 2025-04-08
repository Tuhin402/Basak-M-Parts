<?php
include 'session_config.php';
include "../Admin/config.php";

if (isset($_POST['productId']) && isset($_POST['newQty']) && isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
    $productId = $_POST['productId'];
    $newQty = intval($_POST['newQty']);

    $productQuery = "SELECT b2c_price, b2c_special_discount FROM products WHERE id = '$productId'";
    $product = $obj->fetch($productQuery);

    if (!empty($product)) {
        $productPrice = $product[0]['b2c_price'];
        $b2c_special_discount = $product[0]['b2c_special_discount'];
        $discountPrice = $productPrice - ($productPrice * ($b2c_special_discount/100));
        $newTotalPrice = $discountPrice * $newQty;

        $updateCartQuery = "UPDATE cart SET qty = '$newQty', total_price = '$newTotalPrice' WHERE b2c_id = '$userId' AND pro_id = '$productId'";
        $obj->query($updateCartQuery);

        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>