<?php
session_start();
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cakesofbetty";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Sử dụng PHPMailer qua Composer autoload
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$totalPriceAll = 0;

if (isset($_POST['add_cart'])) {
    $currentDate = date("Y-m-d");
    $deliveryDate = date("Y-m-d", strtotime($currentDate . "+3 days"));

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email']; // Lấy email từ biểu mẫu
    $address = $_POST['address'];

    // Kiểm tra email hợp lệ
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        die("Không nhận được email từ biểu mẫu.");
    } else {
        $email = $_POST['email'];
        error_log("Email nhận được: " . $email); // Ghi log giá trị email
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Địa chỉ email không hợp lệ hoặc bị thiếu.");
    }

    // Lưu thông tin khách hàng vào bảng KhachHang
    $sqlInsertCustomer = "INSERT INTO KhachHang (TenKH, DiaChiKH, SoDienThoai, email) 
                          VALUES ('$name', '$address', '$phone', '$email')";
    mysqli_query($conn, $sqlInsertCustomer);
    $customerId = mysqli_insert_id($conn);


    // Prepare email content
        $emailBody = "
        <div style='font-family: Quicksand, Arial, sans-serif; background-color: #C2FFC7; padding: 20px; color: #526E48; line-height: 1.6;'>
            <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #9EDF9C; border-radius: 8px; overflow: hidden;'>
                <!-- Email Header -->
                <div style='background-color: #9EDF9C; padding: 20px; text-align: center;'>
                    <h1 style='color: #526E48; margin: 0; font-size: 24px;'>Cảm ơn bạn đã đặt hàng!</h1>
                    <p style='color: #62825D; margin: 5px 0; font-size: 14px;'>Chúng tôi rất vui khi phục vụ bạn</p>
                </div>

                <!-- Customer Information -->
                <div style='padding: 20px;'>
                    <h3 style='color: #62825D;'>Thông tin khách hàng</h3>
                    <p><strong>Tên:</strong> $name</p>
                    <p><strong>Số điện thoại:</strong> $phone</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Địa chỉ:</strong> $address</p>
                </div>

                <!-- Order Details Table -->
                <div style='padding: 0 20px 20px 20px;'>
                    <h3 style='color: #62825D;'>Chi tiết đơn hàng</h3>
                    <table style='width: 100%; border-collapse: collapse; margin-top: 10px;'>
                        <thead>
                            <tr style='background-color: #C2FFC7; text-align: left;'>
                                <th style='padding: 10px; border: 1px solid #9EDF9C; color: #526E48;'>Tên sản phẩm</th>
                                <th style='padding: 10px; border: 1px solid #9EDF9C; color: #526E48;'>Số lượng</th>
                                <th style='padding: 10px; border: 1px solid #9EDF9C; color: #526E48;'>Giá</th>
                            </tr>
                        </thead>
                        <tbody>";

        // Process products and build rows
        foreach ($_POST['name_product'] as $key => $value) {
        $name_product = $_POST['name_product'][$key];
        $price = $_POST['price'][$key];
        $quantity = $_POST['quantity'][$key];
        $id = $_POST['id'][$key];
        $totalPrice = $price * $quantity;
        $totalPriceAll += $totalPrice;

        $add_bill = "INSERT INTO donhang(NgayDatHang, NgayNhanHang, SoLuongBanh, GiaTriDonHang, MaKH, MaBanh, TenBanh) 
                    VALUES ('$currentDate', '$deliveryDate', '$quantity', '$totalPrice', '$customerId', '$id', '$name_product')";
        mysqli_query($conn, $add_bill);

        $emailBody .= "
                            <tr>
                                <td style='padding: 10px; border: 1px solid #9EDF9C; color: #526E48;'>$name_product</td>
                                <td style='padding: 10px; border: 1px solid #9EDF9C; text-align: center; color: #526E48;'>$quantity</td>
                                <td style='padding: 10px; border: 1px solid #9EDF9C; text-align: right; color: #526E48;'>".number_format($price, 2)." VND</td>
                            </tr>";
        }

        // Finalize email content
        $emailBody .= "
                        </tbody>
                    </table>
                    <div style='text-align: right; margin-top: 15px;'>
                        <h3 style='color: #62825D;'>Tổng tiền: <span style='color: #526E48;'>".number_format($totalPriceAll, 2)." VND</span></h3>
                    </div>
                </div>

                <!-- Footer -->
                <div style='background-color: #9EDF9C; padding: 15px; text-align: center;'>
                    <p style='font-size: 14px; color: #526E48;'>Cảm ơn bạn đã mua hàng tại cửa hàng của chúng tôi.</p>
                    <p style='font-size: 14px; color: #526E48;'>Đơn hàng của bạn dự kiến giao đến bạn từ 3 đến 5 ngày!</p>
                    <p style='font-size: 14px; color: #526E48;'>Nếu có bất kỳ câu hỏi nào, hãy liên hệ <a href='#' style='color: #526E48; text-decoration: none; font-weight: bold;'>tại đây</a>.</p>
                    <p style='font-size: 12px; color: #526E48;'>&copy; 2024 Cakes Of Betty</p>
                </div>
            </div>
        </div>";


    // Gửi email xác nhận
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'cakesofbetty@gmail.com'; // Replace with your email
        $mail->Password = 'vgkd wuxe svpy zvcw'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        $mail->setFrom('cakesofbetty@gmail.com', 'Cakes of Betty');
        $mail->addAddress($email); // Gửi đến email của khách hàng
    
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8'; // Thiết lập mã hóa UTF-8
        $mail->Subject = 'Xác nhận đơn hàng từ Cakes of Betty';
        $mail->Body = $emailBody;
    
        $mail->send();
        echo '
            <div class="success-message">
                <strong>Thành công!</strong> Đơn hàng đã được xác nhận và email đã được gửi.
            </div>
        ';
    } catch (Exception $e) {
        echo '
            <div class="error-message" style="
                background-color: #f8d7da;
                color: #721c24;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #f5c6cb;
                border-radius: 5px;
                text-align: center;
            ">
                <strong>Lỗi!</strong> Không thể gửi email. Lỗi: ' . $mail->ErrorInfo . '
            </div>
        ';
    }
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Đơn Hàng</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');
        /* Reset CSS */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Global Styles */
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: rgb(255, 251, 233);
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Order Details Styles */
        #order-details {
            background-color: rgb(255, 251, 233);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #order-details h2 {
            margin-bottom: 20px;
            font-size: 30px;
            text-align: center;
            color: rgb(173, 139, 115);
        }

        #order-details p {
            margin-bottom: 15px;
            font-size: 18px;
            color: rgb(173, 139, 115);
        }

        #order-details .product {
            margin-bottom: 20px;
            padding: 10px;
            background-color: rgb(206, 171, 147);
            border-radius: 5px;
        }

        #order-details .product p {
            margin-bottom: 5px;
            color: rgb(173, 139, 115);
        }

        #order-details .product .product-name {
            font-weight: bold;
            color: rgb(173, 139, 115);
        }

        #order-details .total {
            font-weight: bold;
            font-size: 24px;
            margin-top: 20px;
            text-align: right;
            color: rgb(173, 139, 115);
        }

        /* CSS cho phần hiển thị thông báo */
        .success-message {
            background-color: #dff0d8;
            text-align: center;
            color: #3c763d;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #d6e9c6;
            border-radius: 5px;
        }

        /* CSS cho icon */
        .back-to-products {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #333; /* Màu chữ */
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease-in-out;
        }

        .back-to-products i {
            margin-right: 5px;
            font-size: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .back-to-products:hover i {
            transform: translateX(-3px);
        }

        .back-to-products:hover {
            color: rgb(255, 64, 129); /* Màu khi di chuột qua */
        }


    </style>
</head>
<body>
<div class="container">
        <div id="order-details">
            <h2>Thông Tin Đơn Hàng</h2>
            <p>Tên: <?php echo $name; ?></p>
            <p>Số điện thoại: <?php echo $phone; ?></p>
            <p>Địa chỉ: <?php echo $address; ?></p>

            <?php
            $sqlOrderDetail = "SELECT * FROM donhang WHERE MaKH = '$customerId'";
            $result = $conn->query($sqlOrderDetail);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $productName = $row['TenBanh'];
                    $quantity = $row['SoLuongBanh'];
                    $price = $row['GiaTriDonHang'];
                    
                    echo "<div class='product'>";
                    echo "<p class='product-name'>Tên sản phẩm: $productName</p>";
                    echo "<p>Số lượng: $quantity</p>";
                    echo "<p>Giá: $price VND</p>";
                    echo "</div>";
                }
            }
            ?>

            <!-- Hiển thị tổng tiền đơn hàng -->
            <p class="total">Tổng tiền: <?php echo number_format($totalPriceAll, 2); ?> VND</p>

            <a href="products.php" class="back-to-products">
                <i class="fas fa-arrow-left"></i> Quay lại trang sản phẩm
            </a>
        </div>
    </div>
</body>
</html>

<!-- <?php
// Đóng kết nối (không cần đóng kết nối ở đây để tránh lỗi khi thực hiện truy vấn SQL ở dưới)
?> -->