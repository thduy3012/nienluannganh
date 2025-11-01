<?php
// Kết nối cơ sở dữ liệu
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

// Lấy dữ liệu từ form
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$msg = $_POST['msg'];

// Chuẩn bị câu lệnh SQL để lưu dữ liệu
$sql = "INSERT INTO contact_messages (name, email, mobile, msg) 
        VALUES ('$name', '$email', '$mobile', '$msg')";

if ($conn->query($sql) === TRUE) {
    // Nếu thành công, hiển thị thông báo cảm ơn và chuyển hướng về trang chủ
    echo "
    <html>
    <head>
        <style>
            /* Style cho modal */
            .modal {
                display: block; /* Mặc định hiển thị modal */
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5); /* Màu nền mờ */
            }
            .modal-content {
                background-color: #fff;
                margin: 15% auto;
                padding: 30px;
                border-radius: 10px;
                width: 60%;
                text-align: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }
            .modal h2 {
                font-size: 24px;
                margin-bottom: 20px;
                color: #4CAF50; /* Màu xanh lá cho tiêu đề */
            }
            .modal p {
                font-size: 18px;
                color: #333;
                margin-bottom: 30px;
            }
            .modal button {
                padding: 10px 20px;
                font-size: 16px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            .modal button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <!-- Modal -->
        <div id='thankYouModal' class='modal'>
            <div class='modal-content'>
                <h2>Cảm ơn bạn đã để lại ý kiến!</h2>
                <p>Chúng tôi sẽ phản hồi bạn sớm nhất có thể. Hãy quay lại trang chủ để tiếp tục khám phá các sản phẩm của chúng tôi.</p>
                <button onclick='window.location.href = \"index.php\";'>Quay lại trang chủ</button>
            </div>
        </div>

        <script>
            // Tự động đóng modal sau 5 giây nếu người dùng không nhấn vào nút
            setTimeout(function() {
                window.location.href = 'index.php'; // Chuyển hướng về trang chủ sau 5 giây
            }, 5000);
        </script>
    </body>
    </html>
    ";
    exit();
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
