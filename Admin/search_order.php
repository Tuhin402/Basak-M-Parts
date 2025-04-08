<?php
require 'config.php';
$connection = $obj->getConnection();
if (!isset($_GET['content']) || empty(trim($_GET['content']))) {
    header("Location: dashboard.php?error=empty_search");
    die();
}
$content = trim($_GET['content']);
$searchTerm = mysqli_real_escape_string($connection, $content);
$orderQuery = "SELECT order_id FROM orders WHERE order_id = ? LIMIT 1";
if ($stmt = $connection->prepare($orderQuery)) {
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $orderResult = $stmt->get_result();
    if ($row = $orderResult->fetch_assoc()) {
        $order_id = $row['order_id'];
        header("Location: order_details.php?order_id=" . base64_encode($order_id));
        die();
    }
    $stmt->close();
}
$partQuery = "SELECT id FROM products WHERE part = ? LIMIT 1";
if ($stmt = $connection->prepare($partQuery)) {
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $partResult = $stmt->get_result();
    if ($row = $partResult->fetch_assoc()) {
        $product_id = $row['id'];
        header("Location: product_details.php?product_id=" . base64_encode($product_id));
        die();
    }
    $stmt->close();
}
$productQuery = "SELECT id, name FROM products WHERE name LIKE ? ORDER BY CHAR_LENGTH(name) ASC LIMIT 1";
if ($stmt = $connection->prepare($productQuery)) {
    $likeSearchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $likeSearchTerm);
    $stmt->execute();
    $productResult = $stmt->get_result();
    if ($row = $productResult->fetch_assoc()) {
        $product_id = $row['id'];
        header("Location: product_details.php?product_id=" . base64_encode($product_id));
        die();
    }
    $stmt->close();
}
$allProductsQuery = "SELECT id, name FROM products";
$allProductsResult = $connection->query($allProductsQuery);

$bestMatchId = null;
$shortestDistance = PHP_INT_MAX;
$threshold = 3; 

while ($row = $allProductsResult->fetch_assoc()) {
    $levDistance = levenshtein(strtolower($searchTerm), strtolower($row['name']));
    if ($levDistance < $shortestDistance) {
        $shortestDistance = $levDistance;
        $bestMatchId = $row['id'];
    }
}
if ($bestMatchId !== null && $shortestDistance <= $threshold) {
    header("Location: product_details.php?product_id=" . base64_encode($bestMatchId));
    die();
}
header("Location: 404.php");
die();
?>