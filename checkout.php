<?php
session_start();
include('config.php');

if (isset($_POST['vnpay'])) {
    $totalAmount = $_POST['total_amount'];  // Tổng tiền giỏ hàng
    $orderInfo = $_POST['order_info'];  // Thông tin đơn hàng
    $orderId = rand(100000, 999999);  // Mã đơn hàng duy nhất

    $transactionData = array(
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $totalAmount * 100,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date("YmdHis"),
        "vnp_Currency" => "VND",
        "vnp_OrderInfo" => $orderInfo,
        "vnp_OrderType" => "other",
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $orderId,
    );

    ksort($transactionData);
    $hashData = "";
    foreach ($transactionData as $key => $value) {
        if (!empty($value)) {
            $hashData .= $key . "=" . $value . "&";
        }
    }
    $hashData = rtrim($hashData, "&");
    $vnp_SecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    $vnp_Url = $vnp_Url . "?" . http_build_query($transactionData) . "&vnp_SecureHash=" . $vnp_SecureHash;

    // Ghi log tham số để kiểm tra
    file_put_contents("vnpay_log.txt", print_r($transactionData, true));

    header("Location: $vnp_Url");
    exit();
}
?>
