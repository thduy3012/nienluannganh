<?php
include 'config.php'; // Bao gồm tệp cấu hình cơ sở dữ liệu

// Embedded CSS for styled success and error messages
echo '
<style>
    .message {
        font-family: Arial, sans-serif;
        font-size: 16px;
        border-radius: 8px;
        margin: 20px 0;
        padding: 20px;
        display: flex;
        align-items: center;
        transition: transform 0.3s ease-in-out;
    }

    .success-message {
        background-color: #4CAF50;
        color: white;
        border-left: 5px solid #388E3C;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .error-message {
        background-color: #f44336;
        color: white;
        border-left: 5px solid #d32f2f;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .message i {
        margin-right: 15px;
        font-size: 20px;
        opacity: 0.8;
    }

    .success-message i {
        color: #fff;
        background-color: #388E3C;
        border-radius: 50%;
        padding: 10px;
    }

    .error-message i {
        color: #fff;
        background-color: #d32f2f;
        border-radius: 50%;
        padding: 10px;
    }

    .message:hover {
        transform: translateY(-5px);
    }

    .message a {
        color: #fff;
        text-decoration: underline;
        font-weight: bold;
        margin-left: 10px;
    }

    .message a:hover {
        color: #d1eaff;
    }
</style>
';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];

    // Kiểm tra độ dài và tính bảo mật của mật khẩu
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[\W_]/', $password)) {
        echo '
            <div class="message error-message">
                <i class="fa fa-exclamation-circle"></i>
                <strong>Lỗi! </strong> Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.
                <a href="register.php">Trở lại trang đăng ký</a>
            </div>';
        exit();
    }

    // Kiểm tra xem tên người dùng đã tồn tại trong cơ sở dữ liệu chưa
    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    $check_username_result = mysqli_query($conn, $check_username_query);

    // Kiểm tra xem email đã được sử dụng chưa
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_username_result) > 0) {
        // Tên đăng nhập đã tồn tại, hiển thị thông báo lỗi
        echo '
            <div class="message error-message">
                <i class="fa fa-exclamation-circle"></i>
                <strong>Lỗi! </strong> Tên đăng nhập đã được sử dụng. Vui lòng chọn tên đăng nhập khác.
                <a href="register.php">Trở lại trang đăng ký</a>
            </div>';
        exit();
    } elseif (mysqli_num_rows($check_email_result) > 0) {
        // Email đã được sử dụng, hiển thị thông báo lỗi
        echo '
            <div class="message error-message">
                <i class="fa fa-exclamation-circle"></i>
                <strong>Lỗi! </strong> Email đã được sử dụng. Vui lòng chọn email khác.
                <a href="register.php">Trở lại trang đăng ký</a>
            </div>';
        exit();
    } else {
        // Hash password before inserting
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Thêm thông tin người dùng mới vào cơ sở dữ liệu
        $insert_query = "INSERT INTO users (username, password, email, full_name) VALUES ('$username', '$hashed_password', '$email', '$full_name')";
        if (mysqli_query($conn, $insert_query)) {
            // Đăng ký thành công, hiển thị thông báo
            echo '
                <div class="message success-message">
                    <i class="fa fa-check-circle"></i>
                    <strong>Thành công! </strong> Đăng ký thành công, vui lòng đăng nhập.
                    <a href="login.php">Đến trang đăng nhập</a>
                </div>';
            exit();
        } else {
            // Nếu có lỗi trong quá trình thêm dữ liệu
            echo '
                <div class="message error-message">
                    <i class="fa fa-exclamation-triangle"></i>
                    <strong>Lỗi! </strong> Có lỗi xảy ra khi đăng ký, vui lòng thử lại.
                    <a href="register.php">Trở lại trang đăng ký</a>
                </div>';
        }
    }
}
?>
