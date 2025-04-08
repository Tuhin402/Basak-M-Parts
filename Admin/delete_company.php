<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $companyId = intval($_POST["id"]);

    $company = $obj->fetch("SELECT image FROM company WHERE id = $companyId");

    if (!empty($company)) {
        $imagePath = "uploads/company/" . $company[0]['image'];
        $delete = $obj->query("DELETE FROM company WHERE id = $companyId");

        if ($delete) {
            if (!empty($company[0]['image']) && file_exists($imagePath)) {
                unlink($imagePath);
            }
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
?>