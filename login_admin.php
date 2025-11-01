<?php
session_start();

// Xử lý đăng nhập
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    if($username === 'admin' && $password === 'swift') {
        // Lưu trạng thái đăng nhập và chuyển hướng đến trang admin
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        // Đăng nhập không thành công, chuyển hướng về trang login với thông báo lỗi
        header("Location: login_admin.php?error=1");
        exit();
    }
} 

// Kiểm tra nếu có thông báo lỗi
$error = isset($_GET['error']) ? $_GET['error'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="style/login.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

 /* Căn giữa trang */
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-image: url('img/backgroundadminlogin.jpg'); /* Đường dẫn đến hình ảnh */
    background-size: cover;
    background-position: center;
    font-family: 'Quicksand', sans-serif;
}

/* Khu vực container */
.login-container {
    width: 350px;
    padding: 30px;
    background-color: rgba(255, 255, 255, 0.2); /* Tạo độ trong suốt */
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px); /* Hiệu ứng làm mờ nền phía sau */
}

/* Tiêu đề "Login" */
.login-container h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Hiệu ứng đổ bóng cho chữ */
}

/* Thông báo lỗi */
.login-container p.error {
    color: #e74c3c;
    margin-bottom: 15px;
    text-align: center;
}

/* Nhóm input */
.input-group {
    margin-bottom: 20px;
}

/* Nhãn input */
.input-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: #fff; /* Đổi màu nhãn sang trắng cho dễ nhìn */
}

/* Input */
.input-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: rgba(255, 255, 255, 0.8); /* Làm input trong suốt nhẹ */
    transition: border-color 0.3s;
}

/* Input khi focus */
.input-group input:focus {
    border-color: #007bff;
    outline: none;
}

/* Nút đăng nhập */
.login-container button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

/* Hiệu ứng hover cho nút */
.login-container button:hover {
    background-color: #0056b3;
}


  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <?php if($error === '1'): ?>
        <p style="color: red;">Thông tin đăng nhập không hợp lệ. Vui lòng thử lại.</p>
    <?php endif; ?>
    <form action="login_admin.php" method="POST">
      <div class="input-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
