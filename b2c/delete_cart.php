<?php
include 'session_config.php';
include "../Admin/config.php";

if (isset($_POST["product_id"]) && isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
    $productId = $_POST["product_id"];

    $deleteQuery = "DELETE FROM cart WHERE b2c_id = '$userId' AND pro_id = '$productId'";
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