<!-- register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

    /* Styles for body */
    body {
        font-family: 'Quicksand', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    /* Styles for form container */
    form {
        background-color: #fff;
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Styles for headings */
    h2 {
        text-align: center;
        color: #333;
    }

    /* Styles for labels */
    label {
        display: block;
        margin-bottom: 6px;
    }

    /* Styles for input fields */
    input[type="text"],
    input[type="password"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* Styles for submit button */
    button[type="submit"] {
        width: 100%;
        background-color: #4caf50;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Styles for link */
    p {
        text-align: center;
    }

    a {
        color: #4caf50;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    /* General styling for the registration form */
.register-form {
    background-color: #fff;
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-family: 'Quicksand', sans-serif;
}

h2 {
    text-align: center;
    color: #333;
}

/* Style for form labels */
label {
    font-size: 14px;
    color: #555;
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

/* Style for input fields */
input[type="text"], input[type="password"], input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}

input[type="password"] {
    font-family: 'Quicksand', sans-serif;
}

/* Style for the password requirements list */
.password-requirements {
    margin-top: 10px;
    font-size: 14px;
    font-family: 'Quicksand', sans-serif;
    color: #555;
}

/* Style for the individual list items */
.password-requirements ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.password-requirements li {
    margin-bottom: 5px;
    display: flex;
    align-items: center;
}

/* Style for valid password requirements */
.password-requirements .valid {
    color: #4CAF50; /* Green color */
}

/* Add an icon before each valid requirement */
.password-requirements .valid:before {
    content: "✔️";
    margin-right: 10px;
    font-size: 18px;
}

/* Style for the submit button */
button[type="submit"] {
    width: 100%;
    background-color: #4CAF50;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

/* Style for the login link */
.login-link {
    text-align: center;
    margin-top: 10px;
}

.login-link a {
    color: #4CAF50;
    text-decoration: none;
}

.login-link a:hover {
    text-decoration: underline;
}

    </style>

</head>
<body>
    <!-- Hiển thị thông báo lỗi nếu có -->
    <?php if(isset($_GET['error'])) { ?>
    <p style="color: red;"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    
    <h2>Đăng ký</h2>
<form action="register_process.php" method="post" class="register-form">
    <label for="username">Tên đăng nhập:</label><br>
    <input type="text" id="username" name="username" required><br>

    <label for="password" class="password-label">Mật khẩu (Yêu cầu: ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt):</label><br>
    <input type="password" id="password" name="password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$" title="Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt" class="password-input"><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>

    <label for="full_name">Họ và tên:</label><br>
    <input type="text" id="full_name" name="full_name" required><br>

    <button type="submit">Đăng ký</button>
</form>
<p class="login-link">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>

</body>
</html>
