<?php
include 'config.php'; // Bao gồm tệp cấu hình cơ sở dữ liệu

session_start(); // Khởi động phiên làm việc

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập với cơ sở dữ liệu
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Lấy mật khẩu đã mã hóa từ cơ sở dữ liệu
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        // Kiểm tra mật khẩu người dùng nhập vào với mật khẩu đã mã hóa
        if (password_verify($password, $hashed_password)) {
            // Đăng nhập thành công, thiết lập phiên làm việc và chuyển hướng người dùng
            $_SESSION['username'] = $username;
            header("Location: cart.php"); // Chuyển hướng đến trang chính sau khi đăng nhập
            exit();
        } else {
            // Đăng nhập không thành công, thông báo lỗi
            header("Location: login.php?error=Tên đăng nhập hoặc mật khẩu không đúng.");
            exit();
        }
    } else {
        // Tên đăng nhập không tồn tại
        header("Location: login.php?error=Tên đăng nhập không tồn tại.");
        exit();
    }
}

mysqli_close($conn);
?>
