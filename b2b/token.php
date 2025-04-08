<?php
function getShiprocketToken() {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            "email" => "surjavabasak@gmail.com",
            "password" => "#gg9cu977suU"
        ]),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);

    $response_data = json_decode($response, true);
    return $response_data['token'];
}
?>