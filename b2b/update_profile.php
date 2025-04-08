<?php
include '../Admin/config.php';

$user_id     = $_POST['user_id'];
$name        = $_POST['name'];
$email       = $_POST['email'];
$phone       = $_POST['phone'];
$address_one = $_POST['addressOne'];
$address_two = $_POST['addressTwo'];
$state       = $_POST['state'];
$district    = $_POST['district'];
$landmark    = $_POST['landmark'];
$pin         = $_POST['pin'];
$business    = $_POST['business'];
$gst         = $_POST['gst'];

$sql = "UPDATE reg_btob SET  name = '$name',  email = '$email',  phone = '$phone',  address_one = '$address_one',  address_two = '$address_two',  state = '$state',  district = '$district',  landmark = '$landmark',  pin = '$pin',  business_name = '$business',  gst = '$gst' WHERE id = '$user_id'";
$result = $obj->query($sql);

if($result){
    $response = array("status" => "success", "message" => "Profile updated successfully!");
} else {
    $response = array("status" => "error", "message" => "Failed to update profile.");
}

echo json_encode($response);
?>