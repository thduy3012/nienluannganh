<?php
session_start(); // Khởi động phiên làm việc

// Xóa phiên làm việc
session_unset();
session_destroy();

// Chuyển hướng người dùng về trang chính
header("Location: index.php");
exit();
?>
