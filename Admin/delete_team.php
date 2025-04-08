<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $memberId = intval($_POST["id"]);

    $member = $obj->fetch("SELECT image FROM team WHERE id = $memberId");

    if (!empty($member)) {
        $imagePath = "uploads/team/" . $member[0]['image'];
        $delete = $obj->query("DELETE FROM team WHERE id = $memberId");

        if ($delete) {
            if (!empty($member[0]['image']) && file_exists($imagePath)) {
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