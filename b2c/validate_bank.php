<?php
require_once '../Admin/config.php'; 
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    function getBankDetailsByIFSC($ifsc) {
        $url = "https://ifsc.razorpay.com/" . urlencode($ifsc);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode == 200) {
            return json_decode($result, true);
        } else {
            return false;
        }
    }

    if ($action === 'ifsc') {
        $ifsc = trim($_POST['ifsc']);
        $bankData = getBankDetailsByIFSC($ifsc);
        if ($bankData) {
            echo json_encode([
                'success'       => true,
                'bank_name'     => $bankData['BANK'] ?? '',
                'branch_address'=> $bankData['BRANCH'] ?? ''
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid IFSC code. Please check your entry.'
            ]);
        }
        exit;
    } elseif ($action === 'validate') {
        $order_id      = isset($_POST['order_id']) ? $_POST['order_id'] : '';
        $user_name     = isset($_POST['user_name']) ? $_POST['user_name'] : '';
        $ifsc          = trim($_POST['ifsc']);
        $bank_account  = trim($_POST['bank_account']);
        $bank_name     = trim($_POST['bank_name']);
        $banking_name  = trim($_POST['banking_name']);

        $bankData = getBankDetailsByIFSC($ifsc);
        if (!$bankData) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid IFSC code provided.'
            ]);
            exit;
        }
        $api_bank_name = $bankData['BANK'] ?? '';

        if (strcasecmp($bank_name, $api_bank_name) !== 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Bank name does not match the IFSC code.'
            ]);
            exit;
        }
        if (!ctype_digit($bank_account)) {
            echo json_encode([
                'success' => false,
                'message' => 'Bank account number must contain only digits.'
            ]);
            exit;
        }
        if (strlen($bank_account) < 9 || strlen($bank_account) > 18) {
            echo json_encode([
                'success' => false,
                'message' => 'Bank account number must be between 9 and 18 digits.'
            ]);
            exit;
        }
        if (!preg_match('/^[a-zA-Z\s\.\-]+$/', $banking_name)) {
            echo json_encode([
                'success' => false,
                'message' => 'Banking name contains invalid characters.'
            ]);
            exit;
        }
        similar_text(strtolower($user_name), strtolower($banking_name), $percent);
        if ($percent < 70) {
            echo json_encode([
                'success' => false,
                'message' => 'Banking name does not match your registered name.'
            ]);
            exit;
        }
        echo json_encode([
            'success' => true,
            'message' => 'All details validated successfully.'
        ]);
        exit;
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid action.'
        ]);
        exit;
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}
?>