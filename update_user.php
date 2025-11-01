<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form chỉnh sửa người dùng
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];

    // Cập nhật thông tin người dùng trong cơ sở dữ liệu
    $query = "UPDATE users SET username='$username', password='$password', email='$email', full_name='$full_name' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        // Thông báo thành công bằng JavaScript
        echo '<script>alert("Cập nhật thông tin người dùng thành công!");</script>';
        // Chuyển hướng trở lại trang admin
        echo '<script>window.location = "manage_users.php";</script>';
        exit();
    } else {
        echo "Cập nhật thông tin người dùng thất bại: " . mysqli_error($conn);
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}

mysqli_close($conn);
?>
