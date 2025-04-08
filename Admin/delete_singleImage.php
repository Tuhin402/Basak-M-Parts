<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $imageField = isset($_POST['image_field']) ? $_POST['image_field'] : '';

    $allowedFields = ['image_2', 'image_3', 'image_4'];
    if ($productId > 0 && in_array($imageField, $allowedFields)) {
        $result = $obj->fetch("SELECT $imageField FROM products WHERE id = $productId");
        if (!empty($result)) {
            $imageFile = $result[0][$imageField];
            $update = $obj->query("UPDATE products SET $imageField = '' WHERE id = $productId");
            if ($update) {
                $filePath = "uploads/products/" . $imageFile;
                if ($imageFile && file_exists($filePath)) {
                    unlink($filePath);
                }
                echo json_encode(['status' => 'success', 'message' => 'Image deleted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Database update failed']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Product not found']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid product or image field']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>