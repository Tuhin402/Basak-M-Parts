<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $certificateId = intval($_POST["id"]);

    $certificate = $obj->fetch("SELECT image FROM certificates WHERE id = $certificateId");

    if (!empty($certificate)) {
        $imagePath = "uploads/certificate/" . $certificate[0]['image'];
        $delete = $obj->query("DELETE FROM certificates WHERE id = $certificateId");

        if ($delete) {
            if (!empty($certificate[0]['image']) && file_exists($imagePath)) {
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