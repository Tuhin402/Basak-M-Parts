<?php
include "config.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $policyId = intval($_POST["id"]);

    $policy = $obj->fetch("SELECT * FROM return_policy WHERE id = $policyId");

    if (!empty($policy)) {
        $delete = $obj->query("DELETE FROM return_policy WHERE id = $policyId");

        if ($delete) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
?>