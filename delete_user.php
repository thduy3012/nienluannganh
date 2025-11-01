<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa người dùng khỏi bảng users
    $query = "DELETE FROM users WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        // Thông báo thành công bằng JavaScript
        echo '<script>alert("Xóa người dùng thành công!");</script>';
        // Chuyển hướng trở lại trang admin
        echo '<script>window.location = "manage_users.php";</script>';
    } else {
        echo "Xóa người dùng thất bại: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
