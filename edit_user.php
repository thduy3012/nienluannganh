<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin người dùng từ cơ sở dữ liệu
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Hiển thị form chỉnh sửa thông tin người dùng
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Chỉnh sửa thông tin người dùng</title>
    <style>
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
    </style>
</head>
<body>
    <!-- Phần quay lại trang sản phẩm -->
    <a href="manage_users.php" class="back-to-admin">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h1>Chỉnh sửa thông tin người dùng</h1>
    <form action="update_user.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <!-- Hiển thị trường ID -->
        <label for="id">ID:</label><br>
        <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" readonly><br>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>"><br>
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>"><br>
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>
<?php
} else {
    echo "Không tìm thấy người dùng.";
}

mysqli_close($conn);
?>
