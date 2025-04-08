<?php
include("Admin/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];

    $conn = $obj->getConnection();
    $check_query = "SELECT delivery_status, last_status_update FROM orders WHERE order_id = '$order_id'";
    $result = mysqli_query($conn, $check_query);
    $order_data = mysqli_fetch_assoc($result);

    if ($order_data) {
        $last_update = strtotime($order_data['last_status_update']);
        $current_time = time();

        if (($current_time - $last_update) < 7200) {
            echo json_encode(['status' => 'success', 'current_status' => $order_data['delivery_status']]);
            exit;
        }
    }

    include('token.php');
    $token = getShiprocketToken();

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track?order_id=" . $order_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_HTTPGET => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $token"
        ]
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $response_data = json_decode($response, true);

    if (isset($response_data['tracking_data']['shipment_track'][0]['current_status'])) {
        $current_status = $response_data['tracking_data']['shipment_track'][0]['current_status'];

        $update_query = "UPDATE orders SET delivery_status = '$current_status', last_status_update = NOW() WHERE order_id = '$order_id'";
        mysqli_query($conn, $update_query);

        echo json_encode(['status' => 'success', 'current_status' => $current_status]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tracking information not available.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>