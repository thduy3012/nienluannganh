<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">
    <title>Admin - Quản lý sản phẩm</title>
    <style>
        /* CSS cho header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background-color: #f2f2f2;
        }

        /* CSS cho tiêu đề "CAKES OF BETTY" */
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-align: center;
        }

        /* CSS cho thông tin chào mừng */
        .admin-info p {
            margin-bottom: 5px;
            padding-right: 10px;
            font-family: 'Quicksand', sans-serif;
            color: rgb(163, 67, 67);
        }

        /* CSS cho nút "Logout" */
        .logout-form {
            margin: 0;
            display: inline-block;
        }

        .logout-btn {
            background-color: #f44336;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: Arial, sans-serif;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="index.php" class="active"><h1>CAKES OF BETTY</h1></a>
        <div class="admin-info">
            <p>Xin chào, Admin &#x1F601;</p>
            <form method="POST" action="" class="logout-form">
                <button type="submit" class="logout-btn" name="logout">Logout</button>
            </form>
        </div>
    </div>
