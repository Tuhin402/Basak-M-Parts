<?php
include '../Admin/config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $review = isset($_POST['review']) ? trim($_POST['review']) : '';
    $rating = isset($_POST['rate']) ? intval($_POST['rate']) : 0;

    if ($product_id <= 0 || empty($name) || empty($review) || $rating <= 0) {
        echo json_encode(["status" => "error", "message" => "All fields are required!"]);
        exit;
    }

    $sql = "INSERT INTO product_reviews (product_id, name, review, rating, created_at) VALUES 
            ('$product_id', '$name', '$review', '$rating', NOW())";

    if ($obj->query($sql)) {
        echo json_encode(["status" => "success", "message" => "Thanks for your valuable review!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to submit review."]);
    }
}
?>