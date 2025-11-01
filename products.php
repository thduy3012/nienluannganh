<?php
// Bao gồm tệp cấu hình cơ sở dữ liệu
include 'config.php';

session_start();

// // Kiểm tra xem người dùng đã đăng nhập hay chưa
// if(isset($_SESSION['username'])) {
//     // Nếu đã đăng nhập, hiển thị nút Đăng xuất hoặc các phần phù hợp khác
//     echo '<a href="logout.php">Đăng xuất</a>';
// } else {
//     // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập hoặc hiển thị thông báo
//     header("Location: login.php");
//     exit();
// }

// Truy vấn cơ sở dữ liệu và lấy dữ liệu cho Cookies
$queryCookies = "SELECT * FROM banhngot WHERE MaLoai = 321"; // Giả sử MaLoai của Cookies là 1
$resultCookies = mysqli_query($conn, $queryCookies);

// Truy vấn cơ sở dữ liệu và lấy dữ liệu cho Cupcakes
$queryCupcakes = "SELECT * FROM banhngot WHERE MaLoai = 654"; // Giả sử MaLoai của Cupcakes là 2
$resultCupcakes = mysqli_query($conn, $queryCupcakes);

// Truy vấn cơ sở dữ liệu và lấy dữ liệu cho Cakes
$queryCakes = "SELECT * FROM banhngot WHERE MaLoai = 987"; // Giả sử MaLoai của Cakes là 3
$resultCakes = mysqli_query($conn, $queryCakes);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
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
        <style>
        header {
            position: fixed; /* Cố định phần header */
            top: 0; /* Hiển thị phần header ở trên cùng của trang */
            width: 100%; /* Chiều rộng tối đa */
            background-color: rgb(248, 250, 229); /* Màu nền cho phần header */
            z-index: 1000; /* Đảm bảo phần header hiển thị trên các phần khác của trang */
            box-shadow: 0 0.2rem 0.5rem rgb(177, 148, 112); /* Thêm đổ bóng nhẹ cho phần header */
        }

        .cake-product .inner-cake-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0 1rem; /* Thêm padding ở cả hai bên để tạo khoảng cách với mép trang */
        }

        .cake-product .inner-cake-col {
            background: #fff;
            height: auto;
            flex: 1 1 calc(33.33% - 2rem); /* Điều chỉnh chiều rộng của cột */
            max-width: calc(33.33% - 2rem); /* Điều chỉnh chiều rộng tối đa */
            margin-bottom: 2rem; /* Thêm khoảng cách giữa các cột */
            border-radius: 1rem;
            box-shadow: 0 .3rem .6rem rgb(236, 35, 119);
            text-align: center;
            transition: transform 0.5s ease;
        }

        @media (max-width: 768px) {
            .cake-product .inner-cake-col {
                flex: 1 1 calc(50% - 2rem); /* Thay đổi số cột hiển thị khi màn hình nhỏ hơn 768px */
                max-width: calc(50% - 2rem); /* Thay đổi số cột hiển thị khi màn hình nhỏ hơn 768px */
            }
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

    .cart-count {
        position: absolute; /* Tạo một vị trí tuyệt đối cho cart-count */
        top: -10px; /* Đặt top về trên một chút để căn chỉnh với icon */
        right: -10px; /* Đặt right về phải một chút để căn chỉnh với icon */
        background-color: red; /* Màu nền của cart-count */
        color: white; /* Màu chữ của cart-count */
        border-radius: 50%; /* Đảm bảo cart-count là hình tròn */
        padding: 5px; /* Khoảng cách bên trong của cart-count */
        font-size: 12px; /* Kích thước chữ của cart-count */
    }

/* Định dạng input tìm kiếm */
form input[type="text"] {
    width: 200px; /* Giảm độ rộng của input */
    padding: 8px; /* Giảm padding để làm cho input nhỏ hơn */
    border: 1px solid #ccc;
    border-radius: 3px; /* Giảm độ cong của border-radius */
    font-size: 14px; /* Giảm kích thước font */
}

/* Định dạng placeholder */
form input[type="text"]::placeholder {
    color: #999;
}

/* Định dạng nút tìm kiếm */
form button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 8px 15px; /* Giảm padding để làm cho nút nhỏ hơn */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px; /* Giảm kích thước font */
    border-radius: 3px; /* Giảm độ cong của border-radius */
    cursor: pointer;
}

/* Hiệu ứng khi di chuột vào nút tìm kiếm */
form button[type="submit"]:hover {
    background-color: #45a049;
}

/* Định dạng nút và input trong cùng một hàng */
form input[type="text"],
form button[type="submit"] {
    vertical-align: middle;
    margin-right: 5px; /* Giảm khoảng cách giữa input và nút */
}

        </style>
    </head>

    <body>
    <header>
    <a href="index.php" class="logo"><img src="img/logo.png" alt="Cakes of Betty" /></a>
    <nav class="navigate">
        <ul>
            <li><a href="index.php#home">Trang Chủ</a></li>
            <!-- <li><a href="index.php#about">Về Betty</a></li> -->
            <li><a href="products.php" class="active">Sản Phẩm</a></li>
            <!-- <li><a href="index.php#contact">Liên hệ</a></li> -->
            <li><a href="track_order.php">Theo dõi đơn hàng</a></li>
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
    
    <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Nhập từ khóa tìm kiếm">
        <button type="submit">Tìm kiếm</button>
    </form>

    <div class="cart">
        <a href="cart.php" class="active"> <span class="cart-icon">&#128722;</span> </a>
        <span class="cart-count">0</span>
    </div>
    <div id="menu"><i class="fas fa-bars"></i></div>
    </header>

        <!-- Các danh mục sản phẩm cố định -->
        <section class="product" id="product">
        <h1 class="title">Những sản phẩm từ <span>Betty</span></h1>

        <!-- Cookies Section -->
        <div class="cake-product slider">
            <h2 class="subtitle">Cookies</h2>
            <div class="inner-cake-row slick-slider">
                <?php
                // Hiển thị sản phẩm Cookies từ cơ sở dữ liệu
                while ($row = mysqli_fetch_assoc($resultCookies)) {
                    echo "
                        <div class='inner-cake-col' data-product-id='{$row['MaBanh']}'>
                            <img src='{$row['Image']}' alt='{$row['TenBanh']}'>
                            <div class='cake-price'>
                                <p>{$row['Price']}</p>
                            </div>
                            <h2>{$row['TenBanh']}</h2>
                            <h3>{$row['Description']}</h3>
                            <button class='add-to-cart'>Thêm vào giỏ hàng</button>
                        </div>
                    ";
                }
                ?>
            </div>
        </div>

        <!-- Cupcakes Section -->
        <div class="cake-product slider">
            <h2 class="subtitle">Cupcakes</h2>
            <div class="inner-cake-row slick-slider">
                <?php
                // Hiển thị sản phẩm Cupcakes từ cơ sở dữ liệu
                while ($row = mysqli_fetch_assoc($resultCupcakes)) {
                    echo "
                        <div class='inner-cake-col' data-product-id='{$row['MaBanh']}'>
                            <img src='{$row['Image']}' alt='{$row['TenBanh']}'>
                            <div class='cake-price'>
                                <p>{$row['Price']}</p>
                            </div>
                            <h2>{$row['TenBanh']}</h2>
                            <h3>{$row['Description']}</h3>
                            <button class='add-to-cart'>Thêm vào giỏ hàng</button>
                        </div>
                    ";
                }
                ?>
            </div>
        </div>

        <!-- Cakes Section -->
        <div class="cake-product slider">
            <h2 class="subtitle">Cakes</h2>
            <div class="inner-cake-row slick-slider">
                <?php
                // Hiển thị sản phẩm Cakes từ cơ sở dữ liệu
                while ($row = mysqli_fetch_assoc($resultCakes)) {
                    echo "
                        <div class='inner-cake-col' data-product-id='{$row['MaBanh']}'>
                            <img src='{$row['Image']}' alt='{$row['TenBanh']}'>
                            <div class='cake-price'>
                                <p>{$row['Price']}</p>
                            </div>
                            <h2>{$row['TenBanh']}</h2>
                            <h3>{$row['Description']}</h3>
                            <button class='add-to-cart'>Thêm vào giỏ hàng</button>
                        </div>
                    ";
                }
                ?>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            // Khởi tạo Slick Carousel cho mỗi phần slider
            $('.slider').each(function(){
                $(this).find('.slick-slider').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    dots: true,
                    arrows: false,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });

            // Kích hoạt chuyển đổi slide khi di chuột qua dots
            $(this).find('.slick-dots li').on('mouseover', function() {
                var index = $(this).index();
                $(this).closest('.slick-slider').slick('slickGoTo', index);
            });

            });
        });
    </script>
    
        <!-- Footer và các phần khác của trang web -->

        <?php
        // Đóng kết nối cơ sở dữ liệu
        mysqli_close($conn);
        ?>
        
    </body>
</html>