<?php
include 'config.php';

session_start();

if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login_admin.php");
    exit();
}

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login_admin.php");
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <title>Admin - Quản lý sản phẩm</title>
    <style>
/* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Quicksand', sans-serif;
    background-color: #f9f9f9;
    color: #333;
}

.container {
    width: 90%;
    margin: 0 auto;
}

.header {
    background-color: #f2f2f2;  /* Màu nền như cũ */
    padding: 20px 0;
}

.header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header .logo {
    font-size: 30px;
    font-weight: bold;
    color: #4eac5a;  /* Sử dụng màu logo cũ */
    text-decoration: none;
}

.header .logo:hover {
    color: #c9aaaa;
}

.admin-info {
    display: flex;
    align-items: center;
    color: #333;
}

.admin-info p {
    margin-right: 15px;
}

.logout-btn {
    background-color: #f44336;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.logout-btn:hover {
    background-color: #d32f2f;
}

.menu {
    background-color: #4eac5a;
    color: #fff;
    margin-top: 20px;
}

.menu ul {
    list-style: none;
    padding: 10px 0;
    display: flex;
    justify-content: center;
}

.menu ul li {
    margin-right: 20px;
}

.menu ul li:last-child {
    margin-right: 0;
}

.menu ul li a {
    color: #fff;
    text-decoration: none;
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
}

.menu ul li a:hover {
    background-color: #c9aaaa;
}

.main-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 40px 0;
}

.main-content h2 {
    font-size: 28px;
    color: #4eac5a;
    margin-bottom: 30px;
    margin-top: 30px;
}

.footer {
    background-color: #4eac5a;
    color: white;
    text-align: center;
    padding: 15px;
    margin-top: 50px;
}

a {
    text-decoration: none;
    color: #4eac5a;
}

@media (max-width: 768px) {
    .header .container {
        flex-direction: column;
        text-align: center;
    }

    .menu ul {
        flex-direction: column;
        padding: 0;
    }

    .menu ul li {
        margin-bottom: 10px;
    }

    .admin-info {
        flex-direction: column;
        margin-top: 10px;
    }

    .main-content {
        width: 90%;
        margin-top: 20px;
    }
}

    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo"><a href="index.php">CAKES OF BETTY</a></h1>
            <div class="admin-info">
                <p>Xin chào, Admin &#x1F601;</p>
                <form method="POST" action="">
                    <button type="submit" class="logout-btn" name="logout">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <nav class="menu">
        <div class="container">
            <ul>
                <li><a href="manage_product.php">Quản lý sản phẩm</a></li>
                <li><a href="manage_order.php">Danh sách đơn hàng</a></li>
                <li><a href="manage_users.php">Danh sách tài khoản khách hàng</a></li>
                <li><a href="statistics.php">Thống kê</a></li>
                <li><a href="view_messages.php">Ý Kiến KH</a></li>
            </ul>
        </div>
    </nav>

    <div class="main-content">
        <h2>Chào mừng đến với trang quản lý</h2>
        <!-- Nội dung chính của trang -->
    </div>

    <footer class="footer">
        <p>&copy; 2024 Cakes of Betty. All rights reserved.</p>
    </footer>
</body>
</html>
