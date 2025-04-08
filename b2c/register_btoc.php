<?php
include 'session_config.php';
require_once "../Admin/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $addressOne = $data['addressOne'];
    $addressTwo = $data['addressTwo'];
    $state = $data['state'];
    $district = $data['district'];
    $landmark = $data['landmark'];
    $pin = $data['pin'];
    $password = $data['password'];
    $cpassword = $data['cpassword'];

    if ($password !== $cpassword) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Passwords do not match'], JSON_PRETTY_PRINT);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $b2cEmailCheckQuery = "SELECT * FROM reg_btoc WHERE email = '$email'";
    $b2cEmailExists = $obj->num($b2cEmailCheckQuery);
    if ($b2cEmailExists > 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Email already registered as B2C'], JSON_PRETTY_PRINT);
        exit;
    }

    $b2bEmailCheckQuery = "SELECT * FROM reg_btob WHERE email = '$email'";
    $b2bEmailExists = $obj->num($b2bEmailCheckQuery);
    if ($b2bEmailExists > 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Email already registered as B2B'], JSON_PRETTY_PRINT);
        exit;
    }

    $insertQuery = "INSERT INTO reg_btoc (name, email, phone, address_one, address_two, state, district, landmark, pin, password, c_password) 
                    VALUES ('$name', '$email', '$phone', '$addressOne', '$addressTwo', '$state', '$district', '$landmark', '$pin', '$hashedPassword', '$hashedPassword')";

    $insertResult = $obj->query($insertQuery);

    if ($insertResult) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Registration successful'], JSON_PRETTY_PRINT);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to save data'], JSON_PRETTY_PRINT);
    }
} else {
    http_response_code(405); 
    echo json_encode(['success' => false, 'message' => 'Invalid request method'], JSON_PRETTY_PRINT);
}
?>