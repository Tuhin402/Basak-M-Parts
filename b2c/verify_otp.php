<?php
include "../Admin/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'] ?? null; 
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid email address'], JSON_PRETTY_PRINT);
        exit;
    }

    $otp = rand(1000, 9999);

    $subject = "Your OTP Code for Verification - Basak M Parts";

    $message = "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #0D0D0D;
                color: #FFFFFF;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                max-width: 500px;
                background-color: #1C1C1C;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0px 8px 20px rgba(255, 255, 255, 0.1);
                text-align: center;
                padding: 25px;
            }
            .header {
                background-color: #A70A0A;
                padding: 20px;
                border-top-left-radius: 12px;
                border-top-right-radius: 12px;
            }
            .header img {
                max-width: 120px;
                display: block;
                margin: 0 auto;
            }
            .content h1 {
                font-weight: 600;
                color: #FFFFFF;
                margin-bottom: 10px;
            }
            .content p {
                font-size: 16px;
                line-height: 1.6;
                color: #CCCCCC;
                margin-bottom: 15px;
            }
            .otp {
                font-size: 28px;
                font-weight: bold;
                background-color: #A70A0A;
                color: #FFFFFF;
                padding: 12px 24px;
                border-radius: 8px;
                display: inline-block;
                letter-spacing: 2px;
                margin: 20px 0;
            }
            .footer {
                background-color: #1C1C1C;
                padding: 15px;
                text-align: center;
                color: #888888;
                font-size: 12px;
                border-bottom-left-radius: 12px;
                border-bottom-right-radius: 12px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <img src='https://basakmparts.com/b2c/images/logo-white.png' alt='Basak M Parts Logo'>
            </div>
            <div class='content'>
                <h1>Hello, User!</h1>
                <p>Your OTP code for B2C registration is:</p>
                <div class='otp'>$otp</div>
                <p>Use this code to complete your verification. This OTP is valid for a limited time only.</p>
                <p>Thank you for choosing Basak M Parts!</p>
            </div>
            <div class='footer'>
                &copy; " . date('Y') . " Basak M Parts. All rights reserved.
            </div>
        </div>
    </body>
    </html>
    ";

    $headers = "From: Basak M Parts <no-reply@yourdomain.com>\r\n";
    $headers .= "Reply-To: no-reply@yourdomain.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($email, $subject, $message, $headers)) {
        http_response_code(200);
        echo json_encode(['success' => true, 'otp' => $otp], JSON_PRETTY_PRINT);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to send email'], JSON_PRETTY_PRINT);
    }
}
?>