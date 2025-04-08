<?php
include '../Admin/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $addressOne = $_POST['addressOne'];
    $addressTwo = $_POST['addressTwo'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $landmark = $_POST['landmark'];
    $pin = $_POST['pin'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($password !== $cpassword) {
        echo json_encode(['success' => false, 'message' => 'Password do not match']);
        exit;
    }

    $business = $_POST['business'];
    $gst = $_POST['gst'];

    $b2cEmailCheckQuery = "SELECT * FROM reg_btoc WHERE email = '$email'";
    $b2cEmailExists = $obj->num($b2cEmailCheckQuery);
    if ($b2cEmailExists > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered as B2C']);
        exit;
    }

    $b2bEmailCheckQuery = "SELECT * FROM reg_btob WHERE email = '$email'";
    $b2bEmailExists = $obj->num($b2bEmailCheckQuery);
    if ($b2bEmailExists > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered as B2B']);
        exit;
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $imageName = basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $insertQuery = "INSERT INTO reg_btob (name, email, phone, address_one, address_two, state, district, landmark, pin, password, c_password, business_name, gst, shop_image) 
            VALUES ('$name', '$email', '$phone', '$addressOne', '$addressTwo', '$state', '$district', '$landmark', '$pin', '$hashedPassword', '$hashedPassword', '$business', '$gst', '$targetFile')";

            $insertResult = $obj->query($insertQuery);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Image upload failed']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No image uploaded']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>