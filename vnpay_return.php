<?php
session_start();
include('config.php');  // Bao gồm file config.php

// Lấy các tham số từ URL trả về của VNPAY
$vnp_TxnRef = $_GET['vnp_TxnRef'];  // Mã đơn hàng
$vnp_Amount = $_GET['vnp_Amount'] / 100;  // Số tiền thanh toán (chuyển về VND)
$vnp_ResponseCode = $_GET['vnp_ResponseCode'];  // Mã trạng thái phản hồi
$vnp_SecureHash = $_GET['vnp_SecureHash'];  // Mã bảo mật

// Tạo lại mã hash từ các tham số trả về để kiểm tra tính hợp lệ
$transactionData = $_GET;
unset($transactionData['vnp_SecureHash']);
ksort($transactionData);
$hashData = "";
foreach ($transactionData as $key => $value) {
    if (empty($value)) continue;
    $hashData .= $key . "=" . $value . "&";
}
$hashData = rtrim($hashData, "&");
$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

// Kiểm tra mã bảo mật và mã phản hồi
if ($secureHash == $vnp_SecureHash && $vnp_ResponseCode == '00') {
    // Thanh toán thành công, cập nhật trạng thái trong cơ sở dữ liệu
    $sql = "INSERT INTO thanhtoan (ma_donhang, hinhthuc, trangthai, vnp_transaction_code, vnp_payment_status, vnp_amount) 
            VALUES ('$vnp_TxnRef', 'VNPAY', 'Thành công', '$vnp_TxnRef', '00', '$vnp_Amount')";
    if (mysqli_query($conn, $sql)) {
        echo "Thanh toán thành công!";
    } else {
        echo "Lỗi cập nhật cơ sở dữ liệu: " . mysqli_error($conn);
    }
} else {
    echo "Thanh toán thất bại! Mã phản hồi không hợp lệ hoặc mã bảo mật không đúng.";
}
?>
