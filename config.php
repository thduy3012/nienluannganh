<?php
// Thông tin kết nối cơ sở dữ liệu
define('DB_HOST', 'localhost'); // Địa chỉ máy chủ cơ sở dữ liệu (thường là localhost)
define('DB_USER', 'root'); // Tên người dùng cơ sở dữ liệu
define('DB_PASSWORD', ''); // Mật khẩu cơ sở dữ liệu
define('DB_NAME', 'cakesofbetty'); // Tên cơ sở dữ liệu

// Cấu hình thanh toán VNPAY
// $vnp_TmnCode = "X0DM3ZMG"; // Mã Website (Terminal ID)
// $vnp_HashSecret = "8JRLTXJZN6ZI0QWVB8EZSF60T0JKOE5Y"; // Chuỗi bí mật tạo checksum (Secret Key)
// $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // Địa chỉ URL của VNPAY (sandbox để thử nghiệm)
// $vnp_Returnurl = "http://localhost/cakesofbetty/vnpay_return.php"; // URL để VNPAY chuyển hướng sau khi thanh toán

// Cấu hình thanh toán VNPAY
$vnp_TmnCode = "X0DM3ZMG"; // Mã Website (Terminal ID)
$vnp_HashSecret = "R2ZCRPM059RIL0EXK944CV0UX7374I0U"; // Chuỗi bí mật tạo checksum (Secret Key)
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // Địa chỉ URL của VNPAY (sandbox để thử nghiệm)
$vnp_Returnurl = "http://localhost/cakesofbetty/vnpay_return.php"; // URL để VNPAY chuyển hướng sau khi thanh toán

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}
?>
