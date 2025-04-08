<?php
include "../Admin/config.php";

if (!empty($_POST['mobile']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['message'])) {
    $connection = $obj -> getConnection();

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['mobile']);
    $address = htmlspecialchars($_POST['address']);

    $message = trim($_POST["message"] ?? '');
    $message = mysqli_real_escape_string($connection, $message);

   
    $to="office@basakmparts.com";

    $subject = "New Contact Form Submission";

    $body = "Dear Team,\n\n";
    $body .= "A new contact form submission has been received with the following details:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Message:\n$message\n\n";
    $body .= "Please take necessary action.\n\n";
    $body .= "Best regards,\n Basak M Store";
    
    $from_email = $email;

    $headers .= "X-Mailer: PHP/" . phpversion();
    $mail_sent = mail($to, $subject, $body);

    if ($mail_sent) {
        $que=$obj->query("INSERT INTO `call_req` (`name`, `email`, `phone`, `address`, `message`) VALUES ('$name', '$email', '$phone', '$address', '$message')");
        echo 200;
    } else {
        echo "Sorry, there was a problem sending your message. Please try again later.";
    }

} else {
    echo '<p class="alert alert-warning">Please fillup all the mendatory fields !!</p>';
}
?>