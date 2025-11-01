<?php
include 'config.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin - Quản lý tài khoản khách hàng</title>
    <style>
        /* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Quicksand', sans-serif;
}

.container {
    width: 90%;
    margin: 0 auto;
}

.header {
    background-color: #f2f2f2;
    padding: 20px 0;
}

.header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header .logo {
    font-size: 24px;
}

.admin-info {
    display: flex;
    align-items: center;
}

.content {
    padding: 20px 0;
}

.user-list {
    margin-bottom: 40px;
}

.user-table {
    width: 100%;
    border-collapse: collapse;
}

.user-table th,
.user-table td {
    border: 1px solid #ddd;
    padding: 8px;
}

.user-table th {
    position: sticky;
    top: 0;
    background-color: #c89898;
    text-align: left;
}

.user-table a {
    text-decoration: none;
    color: #007bff;
}

.user-table a:hover {
    text-decoration: underline;
}

        /* CSS cho icon */
        .back-to-admin {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #333; /* Màu chữ */
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease-in-out;
        }

        .back-to-admin i {
            margin-right: 5px;
            font-size: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .back-to-admin:hover i {
            transform: translateX(-3px);
        }

        .back-to-admin:hover {
            color: rgb(255, 64, 129); /* Màu khi di chuột qua */
        }

        .user-list {
            overflow: auto; /* Kích hoạt thanh cuộn khi cần thiết */
            max-height: 500px; /* Định chiều cao tối đa cho phần danh sách */
        }

        .user-table tbody {
            overflow: hidden; /* Ẩn phần vượt quá phần tử cha */
        }

        .title{
            text-decoration: none;
            color: #523020; /* Màu cho các liên kết */
            font-size: 30px;
            font-weight: bolder;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
            margin-top: 0px; /* Khoảng cách giữa tiêu đề và bảng */
            margin-bottom: 20px; /* Khoảng cách giữa các tiêu đề */
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo"><a class="title" href="index.php">CAKES OF BETTY</a></h1>
            <div class="admin-info">
                <p>Xin chào, Admin &#x1F601;</p>
            </div>
        </div>
    </header>

            <!-- Phần quay lại trang sản phẩm -->
            <a href="admin.php" class="back-to-admin">
                <i class="fas fa-arrow-left"></i>
            </a>

    <main class="content">
        <h2>Danh sách tài khoản khách hàng</h2>
        <section class="user-list">
            <div class="container">
                <!-- <h2>Danh sách tài khoản khách hàng</h2> -->
                <table class="user-table">
                    <tr>
                        <th>Tên Đăng Nhập</th>
                        <th>Email</th>
                        <th>Họ và tên</th>
                        <th>Đăng ký vào lúc</th>
                        <th>Thao tác</th>
                    </tr>
                    <?php
                    // Truy vấn cơ sở dữ liệu để lấy danh sách người dùng
                    $queryUsers = "SELECT * FROM users";
                    $resultUsers = mysqli_query($conn, $queryUsers);

                    // Duyệt qua từng dòng dữ liệu và hiển thị trong bảng
                    while ($user = mysqli_fetch_assoc($resultUsers)) {
                    ?>
                    <tr>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['full_name']; ?></td>
                        <td><?php echo $user['created_at']; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>">Chỉnh sửa</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>">Xóa</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <!-- Footer content -->
        </div>
    </footer>
</body>
</html>
