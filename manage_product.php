<?php
include 'config.php';

session_start();

// Truy vấn cơ sở dữ liệu và lấy dữ liệu sản phẩm
$queryProducts = "SELECT * FROM banhngot";
$resultProducts = mysqli_query($conn, $queryProducts);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

.product-list,
.add-product {
    margin-bottom: 40px;
}

.product-table {
    width: 100%;
    border-collapse: collapse;
}

.product-table th,
.product-table td {
    border: 1px solid #ddd;
    padding: 8px;
}

.product-table th {
    position: sticky;
    top: 0;
    background-color: #c89898;
    text-align: left;
}

.product-table img {
    max-width: 100px;
}

.add-product form {
    max-width: 500px;
}

.add-product label {
    display: block;
    margin-bottom: 10px;
}

.add-product input[type="text"],
.add-product textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
}

.add-product input[type="file"] {
    margin-top: 5px;
}

.add-product input[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.add-product input[type="submit"]:hover {
    background-color: #45a049;
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

        .product-list {
            overflow: auto; /* Kích hoạt thanh cuộn khi cần thiết */
            max-height: 500px; /* Định chiều cao tối đa cho phần danh sách */
        }

        .product-table tbody {
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
        <h2>Danh sách các sản phẩm</h2>
        <section class="product-list">
            <div class="container">
                <!-- <h2>Danh sách sản phẩm</h2> -->
                <table class="product-table">
                    <tr>
                        <th>ID</th>
                        <th>Tên bánh</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Hình ảnh</th>
                        <th>Thao tác</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($resultProducts)) { ?>
                        <tr>
                            <td><?php echo $row['MaBanh']; ?></td>
                            <td><?php echo $row['TenBanh']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                            <td><?php echo $row['Price']; ?></td>
                            <td><img src="<?php echo $row['Image']; ?>" width="100"></td>
                            <td>
                                <a href="edit_product.php?id=<?php echo $row['MaBanh']; ?>">Chỉnh sửa</a>
                                <a href="delete_product.php?id=<?php echo $row['MaBanh']; ?>">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </section>

        <section class="add-product">
            <div class="container">
                <h2>Thêm mới sản phẩm</h2>
                <form action="add_sp.php" method="POST" enctype="multipart/form-data">
                    <label for="maBanh">Mã bánh:</label><br>
                    <input type="text" id="maBanh" name="maBanh"><br>
                    <label for="tenBanh">Tên bánh:</label><br>
                    <input type="text" id="tenBanh" name="tenBanh"><br>
                    <label for="description">Mô tả:</label><br>
                    <textarea id="description" name="description"></textarea><br>
                    <label for="price">Giá:</label><br>
                    <input type="text" id="price" name="price"><br>
                    <label for="maNSX">Mã nhà sản xuất:</label><br>
                    <input type="text" id="maNSX" name="maNSX"><br>
                    <label for="maLoai">Mã loại bánh:</label><br>
                    <input type="text" id="maLoai" name="maLoai"><br>
                    <label for="image">Hình ảnh:</label><br>
                    <input type="file" id="image" name="image"><br><br>
                    <input type="submit" value="Thêm mới">
                </form>
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
