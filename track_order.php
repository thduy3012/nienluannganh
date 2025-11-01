<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <title>Theo dõi Đơn Hàng</title>
    <style>
        body {
            /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
            font-family: 'Quicksand', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 2.5em;
            text-align: center;
            color: #5cb85c;
            margin-bottom: 30px;
        }
        h2 {
            font-size: 2 em;
            text-align: center;
            color: #5cb85c;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 40px;
        }

        label {
            font-size: 1.1em;
            color: #555;
            font-weight: 600;
        }

        input[type="email"] {
            padding: 12px;
            font-size: 1.1em;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            background-color: #fafafa;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out;
        }

        input[type="email"]:focus {
            border-color: #5cb85c;
            outline: none;
        }

        button[type="submit"] {
            padding: 12px 25px;
            font-size: 1.1em;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #4cae4c;
            transform: scale(1.05);
        }

        button[type="submit"]:active {
            background-color: #4cae4c;
            transform: scale(1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 1.1em;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td {
            background-color: #ffffff;
            color: #555;
            border-color: #ddd;
            transition: background-color 0.3s ease;
        }

        table tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        table tr:hover td {
            background-color: #f1f1f1;
        }

        .error-message, .success-message {
            font-size: 1.2em;
            text-align: center;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .back-to-products {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 12px 25px;
            font-size: 1.1em;
            background-color: #f5f5f5;
            color: #5cb85c;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .back-to-products:hover {
            background-color: #e7e7e7;
            transform: scale(1.05);
        }

        .back-to-products:active {
            background-color: #d4e4d4;
            transform: scale(1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Theo Dõi Đơn Hàng</h1>
        
        <!-- Form nhập Gmail -->
        <form action="track_order.php" method="post">
            <label for="email">Nhập địa chỉ Gmail:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Tìm kiếm</button>
        </form>

        <?php
        // Kết nối đến MySQL
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cakesofbetty";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Hàm để lấy thông tin đơn hàng theo email của khách hàng
        function getOrdersByEmail($email) {
            global $conn;
            
            // Lấy thông tin khách hàng dựa trên email
            $sql = "SELECT MaKH FROM khachhang WHERE email = ?"; // Lấy mã khách hàng từ email
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($MaKH);
            $stmt->fetch();
            $stmt->close();

            // Nếu khách hàng không tồn tại
            if (!$MaKH) {
                echo "<div class='error-message'>Khách hàng không tồn tại.</div>";
                return;
            }

            // Lấy thông tin đơn hàng của khách hàng
            $sql = "SELECT MaDonHang, TenBanh, SoLuongBanh, GiaTriDonHang, NgayDatHang, TrangThai 
                    FROM donhang
                    WHERE MaKH = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $MaKH);
            $stmt->execute();
            $stmt->bind_result($MaDonHang, $TenBanh, $SoLuongBanh, $GiaTriDonHang, $NgayDatHang, $TrangThai);
            
            echo "<h2>Danh sách đơn hàng của bạn</h2>";
            echo "<table>
                    <tr>
                        <!-- <th>Mã Đơn Hàng</th> -->
                        <th>Tên Bánh</th>
                        <th>Số Lượng</th>
                        <th>Giá Trị Đơn Hàng</th>
                        <th>Ngày Đặt Hàng</th>
                        <th>Trạng Thái</th>
                    </tr>";

            while ($stmt->fetch()) {
                echo "<tr>
                        <!-- <td>$MaDonHang</td> -->
                        <td>$TenBanh</td>
                        <td>$SoLuongBanh</td>
                        <td>$GiaTriDonHang</td>
                        <td>$NgayDatHang</td>
                        <td>$TrangThai</td>
                    </tr>";
            }

            echo "</table>";
            $stmt->close();
        }

        // Kiểm tra xem email được gửi từ form hay từ session
        if (isset($_POST['email'])) {
            // Lấy email từ form
            $email = $_POST['email'];
        } elseif (isset($_SESSION['email'])) {
            // Nếu người dùng đã đăng nhập, lấy email từ session
            $email = $_SESSION['email'];
        } else {
            // Nếu không có email, yêu cầu người dùng nhập
            echo "<div class='error-message'>Vui lòng nhập email.</div>";
            exit;
        }

        getOrdersByEmail($email);

        // Đóng kết nối
        $conn->close();
        ?>

        <!-- Link quay lại trang sản phẩm -->
        <a href="products.php" class="back-to-products">
            <i class="fas fa-arrow-left"></i> Quay lại trang sản phẩm
        </a>

    </div>
</body>
</html>
