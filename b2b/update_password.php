<?php
include 'session_config.php';
include "../Admin/config.php";

if(isset($_POST['password']) && isset($_POST['cpassword'])){
    $cpassword = trim($_POST['cpassword']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    
    if($password === "" || $cpassword === ""){
        echo json_encode(["status" => "error", "message" => "Password fields cannot be empty."]);
        exit;
    }
    
    if($password !== $cpassword){
        echo json_encode(["status" => "error", "message" => "Passwords do not match."]);
        exit;
    }
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "UPDATE reg_btob SET password = '$hashedPassword', c_password = '$hashedPassword' WHERE email = '$email'";
    $result = $obj->query($sql);
    
    if($result) {
        echo json_encode(["status" => "success", "message" => "OTP updated Successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Some error occured"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>