<?php
include 'session_config.php';
require_once "../Admin/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sqlBtoC = "SELECT * FROM reg_btoc WHERE email = '$email'";
    $userBtoC = $obj->fetch($sqlBtoC);
    
    if (!empty($userBtoC)) {
        $hashedPassword = $userBtoC[0]['password'];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION["user_id"] = $userBtoC[0]["id"];
            $_SESSION["user_name"] = $userBtoC[0]["name"];
            $_SESSION["user_email"] = $userBtoC[0]["email"];
            $_SESSION["user_mobile"] = $userBtoC[0]["phone"];
            $_SESSION["user_address"] = $userBtoC[0]["address_one"];
            $_SESSION["user_state"] = $userBtoC[0]["state"];
            $_SESSION["user_district"] = $userBtoC[0]["district"];
            $_SESSION["user_landmark"] = $userBtoC[0]["landmark"];
            $_SESSION["user_pin"] = $userBtoC[0]["pin"];
            echo json_encode(['status' => 'success', 'redirect' => 'index.php']);
            exit;
        }
    }

    $sqlBtoB = "SELECT * FROM reg_btob WHERE email = '$email'";
    $userBtoB = $obj->fetch($sqlBtoB);
    
    if (!empty($userBtoB)) {
        $hashedPassword = $userBtoB[0]['password'];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION["b2b_user_id"] = $userBtoB[0]["id"];
            $_SESSION["b2b_user_name"] = $userBtoB[0]["name"];
            $_SESSION["b2b_user_email"] = $userBtoB[0]["email"];
            $_SESSION["b2b_user_mobile"] = $userBtoB[0]["phone"];
            $_SESSION["b2b_user_address"] = $userBtoB[0]["address_one"];
            $_SESSION["b2b_user_state"] = $userBtoB[0]["state"];
            $_SESSION["b2b_user_district"] = $userBtoB[0]["district"];
            $_SESSION["b2b_user_landmark"] = $userBtoB[0]["landmark"];
            $_SESSION["b2b_user_pin"] = $userBtoB[0]["pin"];
            echo json_encode(['status' => 'success', 'redirect' => '../b2b/index.php']);
            exit;
        }
    }
    
    echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}