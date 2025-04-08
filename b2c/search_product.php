<?php
require '../Admin/config.php'; 

if (isset($_GET['product']) && !empty(trim($_GET['product']))) {
    $connection = $obj->getConnection();
    $searchTerm = trim($_GET['product']);

    $fullTextSql = "SELECT id FROM products WHERE MATCH(name, description) AGAINST(? IN BOOLEAN MODE) LIMIT 1";
    if ($stmt = mysqli_prepare($connection, $fullTextSql)) {
        mysqli_stmt_bind_param($stmt, "s", $searchTerm);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['id'];
            $encoded_id = base64_encode($product_id);
            header("Location: product-detail.php?product_id=" . $encoded_id);
            exit();
        }
        mysqli_stmt_close($stmt);
    }

    $likeSearchTerm = '%' . $searchTerm . '%';
    $likeSql = "SELECT id FROM products WHERE name LIKE ? OR description LIKE ? LIMIT 1";
    if ($stmt2 = mysqli_prepare($connection, $likeSql)) {
        mysqli_stmt_bind_param($stmt2, "ss", $likeSearchTerm, $likeSearchTerm);
        mysqli_stmt_execute($stmt2);
        $fallbackResult = mysqli_stmt_get_result($stmt2);

        if ($fallbackRow = mysqli_fetch_assoc($fallbackResult)) {
            $product_id = $fallbackRow['id'];
            $encoded_id = base64_encode($product_id);
            header("Location: product-detail.php?product_id=" . $encoded_id);
            exit();
        } else {
            header("Location: 404.php");
            exit();
        }
        mysqli_stmt_close($stmt2);
    }

    mysqli_close($connection);
} else {
    header("Location: products-all.php?error=empty_search");
    exit();
}
?>