<?php
include 'session_config.php';
include "../Admin/config.php"; 

if (isset($_POST['productId']) && isset($_POST['newQty']) && isset($_SESSION["b2b_user_id"])) {
    $userId = $_SESSION["b2b_user_id"];
    $productId = $_POST['productId'];
    $newQty = intval($_POST['newQty']);

    $productQuery = "SELECT b2b_price FROM products WHERE id = '$productId'";
    $product = $obj->fetch($productQuery);

    if (!empty($product)) {
        $productPrice = $product[0]['b2b_price'];
        $newTotalPrice = $productPrice * $newQty;

        $updateCartQuery = "UPDATE cart SET qty = '$newQty', total_price = '$newTotalPrice' WHERE b2b_id = '$userId' AND pro_id = '$productId'";
        $obj->query($updateCartQuery);

        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>