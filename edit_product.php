<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $query = "SELECT * FROM banhngot WHERE MaBanh = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Hiển thị form chỉnh sửa thông tin sản phẩm
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Chỉnh sửa sản phẩm</title>
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
    <a href="manage_product.php" class="back-to-admin">
            <i class="fas fa-arrow-left"></i>
    </a>
            
    <h1>Chỉnh sửa sản phẩm</h1>
    <form action="update_product.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['MaBanh']; ?>">
        <!-- Hiển thị trường MaBanh -->
        <label for="maBanh">Mã bánh:</label><br>
        <input type="text" id="maBanh" name="maBanh" value="<?php echo $row['MaBanh']; ?>" readonly><br>
        <label for="tenBanh">Tên bánh:</label><br>
        <input type="text" id="tenBanh" name="tenBanh" value="<?php echo $row['TenBanh']; ?>"><br>
        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description"><?php echo $row['Description']; ?></textarea><br>
        <label for="price">Giá:</label><br>
        <input type="text" id="price" name="price" value="<?php echo $row['Price']; ?>"><br>
        <!-- Thêm trường MaNSX -->
        <label for="maNSX">Mã nhà sản xuất:</label><br>
        <input type="text" id="maNSX" name="maNSX" value="<?php echo $row['MaNSX']; ?>"><br>
        <!-- Thêm trường MaLoai -->
        <label for="maLoai">Mã loại bánh:</label><br>
        <input type="text" id="maLoai" name="maLoai" value="<?php echo $row['MaLoai']; ?>"><br>
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>
<?php
} else {
    echo "Không tìm thấy sản phẩm.";
}

mysqli_close($conn);
?>
