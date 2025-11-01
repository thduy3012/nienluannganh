<?php
include_once("config.php");  // Bao gồm cấu hình VNPAY

// Lấy các tham số gửi qua POST từ VNPAY
$vnp_SecureHash = $_POST['vnp_SecureHash'];  // Mã bảo mật
$vnp_TxnRef = $_POST['vnp_TxnRef'];          // Mã giao dịch
$vnp_Amount = $_POST['vnp_Amount'];          // Số tiền thanh toán
$vnp_ResponseCode = $_POST['vnp_ResponseCode']; // Mã trạng thái giao dịch

// Kiểm tra tính hợp lệ của mã bảo mật
$hash_data = '';
foreach ($_POST as $key => $value) {
    if ($key != 'vnp_SecureHash') {
        $hash_data .= '&' . $key . "=" . $value;
    }
}
$secure_hash = strtoupper(hash('sha256', VNPAY_SECRET_KEY . $hash_data));

// Kiểm tra mã bảo mật và xử lý thông báo
if ($vnp_SecureHash == $secure_hash) {
    if ($vnp_ResponseCode == '00') {
        // Thanh toán thành công, lưu thông tin vào cơ sở dữ liệu
        // Ví dụ: Cập nhật trạng thái thanh toán trong bảng 'thanhtoan'
        echo "Thanh toán thành công!";
    } else {
        // Thanh toán thất bại, xử lý lỗi
        echo "Thanh toán thất bại!";
    }
} else {
    echo "Dữ liệu không hợp lệ!";
}
?>
