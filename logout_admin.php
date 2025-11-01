<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập là admin hay không
if(isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Hủy session và chuyển hướng về trang đăng nhập admin
    session_unset();
    session_destroy();
    header("Location: login_admin.php");
    exit();
} else {
    // Nếu không phải admin, chuyển hướng về trang chính
    header("Location: index.php");
    exit();
}
?>
