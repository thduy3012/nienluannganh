<?php
include 'config.php';

session_start();

// Truy vấn cơ sở dữ liệu và lấy dữ liệu
$query = "SELECT * FROM banhnoibat";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/common.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/about.css">
    <link rel="stylesheet" href="style/products.css">
    <link rel="stylesheet" href="style/contact.css">
    <link rel="stylesheet" href="style/product-html.css">
    <link rel="stylesheet" href="style/cart.css">
    <link rel="stylesheet" href="style/button.css">
    <link rel="stylesheet" href="style/footer.css">
    <script src="script/products.js"></script>
    <title>Cakes of Betty - Sản Phẩm</title>
    <title>Cakes of Betty</title>
    <style>
    header {
        position: fixed; /* Cố định phần header */
        top: 0; /* Hiển thị phần header ở trên cùng của trang */
        width: 100%; /* Chiều rộng tối đa */
        background-color: rgb(248, 250, 229); /* Màu nền cho phần header */
        z-index: 1000; /* Đảm bảo phần header hiển thị trên các phần khác của trang */
        box-shadow: 0 0.2rem 0.5rem rgb(177, 148, 112); /* Thêm đổ bóng nhẹ cho phần header */
    }

    .about .about-content {
    width: 100%;
    height: auto;
    padding: 4rem 2rem;
    box-shadow: 0 .2rem .5rem rgb(236, 35, 119);
    text-align: center;
    background: rgb(212, 231, 197);;
    border-radius: 5px;
    }

    .about-content h2 {
        font-size: 2.5rem;
        color: #fff;
        padding: .5rem 0;
        letter-spacing: .2rem;
        text-shadow: .2rem .2rem #fa4975;
    }

    .about-content p {
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.5rem;
        color: rgb(179, 163, 152);
    }

    .about .image img {
        width: 100%;
        height: auto;
    }

    .about .image img:hover {
        animation: animate-img 5s ease infinite;
    }

    .btn {
        margin: 10px 0;
        width: 10rem;
        padding: .6rem;
        border-radius: 5px;
        border: none;
        background: rgb(153, 188, 133);
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: .1rem;
    }

    header {
    position: fixed; /* Cố định phần header */
    top: 0; /* Hiển thị phần header ở trên cùng của trang */
    width: 100%; /* Chiều rộng tối đa */
    background-color: rgb(248, 250, 229); /* Màu nền cho phần header */
    z-index: 1000; /* Đảm bảo phần header hiển thị trên các phần khác của trang */
    box-shadow: 0 0.2rem 0.5rem rgb(177, 148, 112); /* Thêm đổ bóng nhẹ cho phần header */
    display: flex;
    justify-content: space-between; /* Căn các phần tử trong header dọc theo trục ngang */
    align-items: center; /* Căn các phần tử vào giữa theo chiều dọc */
    padding: 0 20px; /* Thêm padding để tạo khoảng cách với các phần tử bên trong header */
}

.user-info {
    display: flex;
    align-items: center; /* Căn các phần tử vào giữa theo chiều dọc */
}

.user-info a {
    margin-left: 10px; /* Khoảng cách giữa các liên kết */
    text-decoration: none; /* Loại bỏ gạch chân */
    color: #333; /* Màu chữ */
}

.user-info a:hover {
    text-decoration: underline; /* Gạch chân khi di chuột qua */
}

.cart {
    position: relative; /* Tạo một vị trí tương đối cho phần cart */
    margin-right: 20px; /* Khoảng cách giữa cart và user-info */
}

/* .cart-count {
    position: absolute; /* Tạo một vị trí tuyệt đối cho cart-count */
    top: -10px; /* Đặt top về trên một chút để căn chỉnh với icon */
    right: -10px; /* Đặt right về phải một chút để căn chỉnh với icon */
    background-color: red; /* Màu nền của cart-count */
    color: white; /* Màu chữ của cart-count */
    border-radius: 50%; /* Đảm bảo cart-count là hình tròn */
    padding: 5px; /* Khoảng cách bên trong của cart-count */
    font-size: 12px; /* Kích thước chữ của cart-count */
} */


    </style>
</head>
<body>
    <!-- Header và phần khác ở đây -->
    <header>
    <a href="index.php" class="logo"><img src="img/logo.png" alt="Cakes of Betty" /></a>
    <nav class="navigate">
        <ul>
            <li><a href="index.php#home">Trang Chủ</a></li>
            <li><a href="index.php#about">Về Betty</a></li>
            <li><a href="products.php" class="active">Sản Phẩm</a></li>
            <li><a href="index.php#contact">Liên hệ</a></li>
        </ul>
    </nav>
    <div class="user-info">
        <?php
        if(isset($_SESSION['username'])) {
            echo '<span>Xin chào, ' . $_SESSION['username'] . '</span>';
            echo '<a href="logout.php">Đăng xuất</a>';
        } else {
            echo '<a href="login.php">Đăng nhập</a>';
            echo '<a href="register.php">Đăng ký</a>';
        }
        ?>
    </div>
    <div class="cart">
        <a href="cart.php" class="active"> <span class="cart-icon">&#128722;</span></a> <!-- Unicode của biểu tượng giỏ hàng -->
        <span class="cart-count"></span> <!-- Số lượng sản phẩm trong giỏ hàng -->
    </div>
    <div id="menu"><i class="fas fa-bars"></i></div>
</header>


<!-----------------------------HOME------------------------------------->
<section id="home" class="home">
    <h1>Bánh Ngon Tới Nhà</h1>
    <p>Sweet like justice</p>
    <div class="home-btn">
    <a href="products.php" class="active"><button>take me home<i class="fas fa-angle-right"></i></button></a>
    </div>
 </section>
<!----------------------------ABOUT-------------------------------------->
<section id="about" class="about">
    <div class="about-content">
        <h2>Câu chuyện từ Betty</h2>
        <p>Những chiếc bánh được chọn từ những nhà cung cấp mà Betty đã tìm hiểu kĩ lưỡng.<br>
           Bạn có thể chọn lựa những chiếc bánh mà bạn thật sự bị cuốn hút.<br>
            Hãy thử những hương vị tuyệt vời mà chúng mang lại.<br>
            Chúc bạn ngon miệng với những chiếc bánh từ Betty.</p>
        <button class="btn">Đọc thêm đi nè!<i class="fas fa-angle-right"></i></button>
    </div>
    <div class="image">
        <img src="img/cake_aboutus.png" alt="img">
    </div>
</section>

    <!-- Hiển thị dữ liệu từ cơ sở dữ liệu -->
    <section class="product" id="product">
        <h1 class="title">Những sản phẩm <span>phổ biến</span></h1>
        <div class="cake-product">
            <div class="inner-cake-row">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="inner-cake-col">';
                    echo '<img src="' . $row['image'] . '" alt="">';
                    // echo '<div class="cake-price">';
                    // echo '<p>' . $row['price'] . '</p>';
                    // echo '</div>';
                    // echo '<div class="cake-star">';
                    // for ($i = 1; $i <= $row['rating']; $i++) {
                    //     echo '<i class="fa fa-star" aria-hidden="true"></i>';
                    // }
                    // echo '</div>';
                    echo '<h2>' . $row['name'] . '</h2>';
                    echo '<h3>' . $row['description'] . '</h3>';
                    echo '<p></p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer và phần khác ở đây -->
<!------------------------contact us--------------->
<!------------------------contact us--------------->
<footer class="contact" id="contact">
    <div class="cake-contact">
        <div class="cake-contact-row">
            <div class="cake-contact-col">
                <img src="img/cakes.avif" alt="img" class="images">
            </div>
            <div class="cake-contact-col">
                <h1>Liên hệ chúng tôi</h1>
                <div class="social">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest"></i>
                </div>
                <p>Số 13, Đường 3 Tháng 2, Quận Ninh Kiều, Thành Phố Cần Thơ<br>123-456-7890</p>
                <p>Chúng tôi muốn nghe từ bạn, viết cho chúng tôi:</p>
                <!-- Chỉnh sửa form để gửi đến process_form.php -->
                <form id="formdetails" method="post" action="process_form.php">
                    <input type="text" name="name" id="name" placeholder="Vui lòng nhập tên của bạn" required>
                    <input type="email" name="email" id="email" placeholder="Vui lòng nhập E-mail của bạn" required>
                    <input type="text" name="mobile" id="mobile" placeholder="Vui lòng nhập số điện thoại" required>
                    <textarea rows="8" cols="10" name="msg" placeholder="Cho chúng tôi một vài ý kiến"></textarea>
                    <button class="btn">Gửi đi nào<i class="fas fa-angle-right"></i></button>
                </form>
            </div>
        </div>
    </div>
</footer>
        
    <?php mysqli_close($conn); ?>
</body>
</html>
