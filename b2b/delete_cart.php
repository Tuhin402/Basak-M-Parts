<?php
include 'session_config.php';
require_once "../Admin/config.php"; 

if (isset($_POST["product_id"]) && isset($_SESSION["b2b_user_id"])) {
    $userId = $_SESSION["b2b_user_id"];
    $productId = $_POST["product_id"];

    $deleteQuery = "DELETE FROM cart WHERE b2b_id = '$userId' AND pro_id = '$productId'";
    $delete = $obj->query($deleteQuery);

    if ($delete) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>