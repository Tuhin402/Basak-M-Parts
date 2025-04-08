<?php
require "../Admin/config.php";

if (isset($_GET['part_no']) && !empty($_GET['part_no'])) {
    $connection = $obj->getConnection(); 
    $part_no = mysqli_real_escape_string($connection, $_GET['part_no']);

    $sql = "SELECT id FROM products WHERE part = '$part_no' LIMIT 1";
    $result = $obj->fetch($sql);

    if (!empty($result)) {
        $product_id = $result[0]['id'];
        $encoded_id = base64_encode($product_id);
        header("Location: product-detail.php?product_id=" . $encoded_id);
        exit();
    } else {
        header("Location: 404.php");
        exit();
    }
} else {
    header("Location: products-all.php?error=empty_search");
    exit();
}
?>