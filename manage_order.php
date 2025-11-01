<?php
include 'config.php';
session_start();

// Xử lý cập nhật trạng thái đơn hàng
if (isset($_POST['updateStatus'])) {
    $MaDonHang = $_POST['MaDonHang'];
    $trangThai = $_POST['trangThai'];  // Thay đổi tên biến cho đúng với tên cột

    // Cập nhật trạng thái đơn hàng trong cơ sở dữ liệu
    $updateQuery = "UPDATE donhang SET trangThai = '$trangThai' WHERE MaDonHang = '$MaDonHang'";
    mysqli_query($conn, $updateQuery);

    // Refresh lại trang sau khi cập nhật
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Truy vấn cơ sở dữ liệu để lấy thông tin đơn hàng nhóm theo khách hàng, cùng với thông tin bánh và trạng thái hiện tại
$queryOrders = "SELECT donhang.MaDonHang, donhang.NgayDatHang, donhang.NgayNhanHang, donhang.SoLuongBanh, donhang.GiaTriDonHang, donhang.MaKH, khachhang.TenKH, khachhang.DiaChiKH, khachhang.SoDienThoai, banhngot.TenBanh, donhang.trangThai 
                FROM donhang 
                INNER JOIN khachhang ON donhang.MaKH = khachhang.MaKH 
                INNER JOIN banhngot ON donhang.MaBanh = banhngot.MaBanh 
                GROUP BY donhang.MaDonHang";

$resultOrders = mysqli_query($conn, $queryOrders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin - Quản lý đơn hàng</title>
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

.order-list {
    margin-bottom: 40px;
}

.order-table {
    width: 100%;
    border-collapse: collapse;
}

.order-table th,
.order-table td {
    border: 1px solid #ddd;
    padding: 8px;
}

.order-table th {
    position: sticky;
    top: 0;
    background-color:#c89898;
    text-align: left;
}

.order-table img {
    max-width: 100px;
}

.order-table a {
    text-decoration: none;
    color: #007bff;
}

.order-table a:hover {
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
        .order-list {
            overflow: auto; /* Kích hoạt thanh cuộn khi cần thiết */
            max-height: 500px; /* Định chiều cao tối đa cho phần danh sách */
        }

        .order-table tbody {
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
        <h2>Danh sách đơn hàng</h2>
        <section class="order-list">
            <div class="container">
                <!-- <h2>Danh sách đơn hàng</h2> -->
                <table class="order-table">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Ngày nhận hàng</th>
                        <th>Số lượng bánh</th>
                        <th>Giá trị đơn hàng</th>
                        <th>Mã khách hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Tên bánh</th>
                        <th>Trạng Thái</th>
                        <th>Thao tác</th>
                    </tr>
                    <?php while ($order = mysqli_fetch_assoc($resultOrders)) { ?>
                        <tr>
                            <td><?php echo $order['MaDonHang']; ?></td>
                            <td><?php echo $order['NgayDatHang']; ?></td>
                            <td><?php echo $order['NgayNhanHang']; ?></td>
                            <td><?php echo $order['SoLuongBanh']; ?></td>
                            <td><?php echo $order['GiaTriDonHang']; ?></td>
                            <td><?php echo $order['MaKH']; ?></td>
                            <td><?php echo $order['TenKH']; ?></td>
                            <td><?php echo $order['DiaChiKH']; ?></td>
                            <td><?php echo $order['SoDienThoai']; ?></td>
                            <td><?php echo $order['TenBanh']; ?></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="MaDonHang" value="<?php echo $order['MaDonHang']; ?>">
                                    <select name="trangThai">
                                        <option value="xác nhận" <?php if($order['trangThai'] == 'xác nhận') echo 'selected'; ?>>Xác nhận</option>
                                        <option value="đang giao" <?php if($order['trangThai'] == 'đang giao') echo 'selected'; ?>>Đang giao</option>
                                        <option value="hoàn thành" <?php if($order['trangThai'] == 'hoàn thành') echo 'selected'; ?>>Hoàn thành</option>
                                    </select>
                                    <button type="submit" name="updateStatus">Cập nhật</button>
                                </form>
                            </td>
                            <td>
                                <a href="approve_order.php?id=<?php echo $order['MaDonHang']; ?>">Đã kiểm tra</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </section>
    </main>

    <!-- <?php
// // Xử lý cập nhật trạng thái đơn hàng
// if (isset($_POST['updateStatus'])) {
//     $MaDonHang = $_POST['MaDonHang'];
//     $TrangThai = $_POST['TrangThai'];

//     // Cập nhật trạng thái đơn hàng trong cơ sở dữ liệu
//     $updateQuery = "UPDATE donhang SET TrangThai = '$TrangThai' WHERE MaDonHang = '$MaDonHang'";
//     mysqli_query($conn, $updateQuery);

//     // Refresh lại trang sau khi cập nhật
//     echo "<meta http-equiv='refresh' content='0'>";
// }
?> -->
    <footer class="footer">
        <div class="container">
            <!-- Footer content -->
        </div>
    </footer>
</body>
</html>
