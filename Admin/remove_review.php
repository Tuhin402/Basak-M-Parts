<?php
include "config.php"; 

if (isset($_POST['rating_id'])) {
    $rating_id = $_POST['rating_id'];

    $check_sql = "SELECT * FROM product_reviews WHERE id = $rating_id";
    $check_result = $obj->fetch($check_sql);

    if (!empty($check_result)) {
        $delete_sql = "DELETE FROM product_reviews WHERE id = $rating_id";
        if ($obj->query($delete_sql)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
?>