<?php
// Thông tin kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cakesofbetty";  // Tên cơ sở dữ liệu của bạn

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Xử lý xóa thông điệp
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM contact_messages WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        $message = "Ý kiến đã được xóa thành công!";
        $status = "success";
    } else {
        $message = "Lỗi xóa ý kiến!";
        $status = "error";
    }
}

// Truy vấn để lấy tất cả các thông điệp từ bảng contact_messages
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Ý Kiến Từ Khách Hàng</title>
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 30px;
        }

        .message {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .message p {
            font-size: 16px;
            line-height: 1.6;
            margin: 8px 0;
        }

        .message strong {
            color: #4CAF50;
        }

        .message button {
            background-color: #FF6347;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .message button:hover {
            background-color: #e55347;
        }

        hr {
            border: 1px solid #ddd;
        }

        .no-message {
            text-align: center;
            font-size: 18px;
            color: #777;
        }

        /* Modal thông báo */
        .modal {
            display: <?php echo isset($message) ? 'block' : 'none'; ?>;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modal .message {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        .modal button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: #45a049;
        }

        .modal.success {
            border: 2px solid #4CAF50;
        }

        .modal.error {
            border: 2px solid #FF6347;
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

    </style>
</head>
<body>

    <a href="admin.php" class="back-to-admin">
         <i class="fas fa-arrow-left"></i>
    </a>

    <div class="container">
        <h1>Các Ý Kiến Từ Khách Hàng</h1>

        <?php
        if ($result->num_rows > 0) {
            // Hiển thị các thông điệp
            while($row = $result->fetch_assoc()) {
                echo "<div class='message'>";
                echo "<p><strong>Tên:</strong> " . $row["name"] . "</p>";
                echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
                echo "<p><strong>Số điện thoại:</strong> " . $row["mobile"] . "</p>";
                echo "<p><strong>Ý kiến:</strong> " . $row["msg"] . "</p>";
                echo "<p><strong>Thời gian gửi:</strong> " . $row["created_at"] . "</p>";
                echo "<a href='view_messages.php?delete_id=" . $row["id"] . "'><button>Xóa</button></a>";
                echo "</div><hr>";
            }
        } else {
            echo "<p class='no-message'>Chưa có ý kiến nào.</p>";
        }
        ?>

    </div>

    <!-- Modal thông báo -->
    <div class="modal <?php echo $status; ?>">
        <div class="modal-content">
            <p class="message"><?php echo $message; ?></p>
            <button onclick="window.location.href = 'view_messages.php';">Đồng ý</button>
        </div>
    </div>

</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
