<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if(isset($_SESSION['username'])) {
    // Nếu đã đăng nhập, hiển thị nội dung của trang
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="style/cart.css"> <!-- Đường dẫn đến file CSS cho trang giỏ hàng -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/cartPage.css">

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
    line-height: 1.6;
    background-color: rgb(214, 218, 200);
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Header Styles */
header {
    background-color: rgb(156, 175, 170);
    color: rgb(34, 40, 49);
    padding: 20px;
    text-align: center;
    border-radius: 20px 20px 0 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.order-info {
    font-size: 28px;
    font-weight: bold;
}

/* Cart Styles */
.cart {
    margin-top: 20px;
    margin-left: 20px;
    padding: 20px;
    background-color: rgb(251, 243, 213);
    border-radius: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.product {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgb(239, 188, 155);
    padding: 15px 0;
}

.product-name {
    font-weight: bold;
    color: rgb(34, 40, 49);
}

.product-price {
    color: green;
}

.quantity {
    width: 50px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

.quantity:focus {
    outline: none;
    border-color: #66afe9;
    box-shadow: 0 0 5px #66afe9;
}

.remove-from-cart {
    background-color: rgb(239, 188, 155);
    color: rgb(34, 40, 49);
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 20px;
    transition: background-color 0.3s ease-in-out;
}

.remove-from-cart:hover {
    background-color: rgb(255, 105, 97);
}

.total {
    margin-top: 20px;
    margin-right: 25px;
    font-size: 24px;
    font-weight: bold;
    text-align: right;
    color: rgb(34, 40, 49);
}

/* Payment Form Styles */
.payment-container {
    margin-top: 20px;
    background-color: rgb(214, 218, 200);
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.payment-container h2 {
    margin-bottom: 20px;
    font-size: 32px;
    font-weight: bold;
    color: rgb(34, 40, 49);
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: rgb(34, 40, 49);
}

.input-group input[type="text"] {
    width: calc(100% - 22px); /* Subtract padding and border width */
    padding: 15px;
    border-radius: 10px;
    border: 1px solid rgb(156, 175, 170);
}


.input-group input[type="email"] {
    width: calc(100% - 22px); /* Subtract padding and border width */
    padding: 15px;
    border-radius: 10px;
    border: 1px solid rgb(156, 175, 170);
}
#checkout-btn {
    background-color: rgb(85, 184, 76);
    color: rgb(251, 243, 213);
    border: none;
    padding: 15px 30px;
    cursor: pointer;
    border-radius: 20px;
    margin-bottom: 20px;
    transition: background-color 0.3s ease-in-out;
}

#checkout-btn:hover {
    background-color: rgb(69, 160, 73);
}

/* Footer Styles */
footer {
    background-color: rgb(156, 175, 170);
    color: rgb(34, 40, 49);
    padding: 20px;
    text-align: center;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
}

.thank-you {
    font-size: 32px;
    font-weight: bold;
}

.user-info {
    display: flex;
    justify-content: flex-end; /* Căn phải */
    align-items: center; /* Căn các phần tử vào giữa theo chiều dọc */
    padding: 10px;
}

.user-info a {
    margin-left: 10px; /* Khoảng cách giữa các liên kết */
    text-decoration: none; /* Loại bỏ gạch chân */
    color: #333; /* Màu chữ */
}

.user-info a:hover {
    text-decoration: underline; /* Gạch chân khi di chuột qua */
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
    <header>
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
        <!-- Header của trang -->
        <div class="order-info">
            <p>Đây là những sản phẩm bạn đã chọn:</p>
        </div>
    </header>

    <section class="cart" id="cart">
        <!-- Hiển thị giỏ hàng -->
    </section>

    <!-- Hiển thị tổng tiền hóa đơn -->
    <div class="total">
        Tổng tiền: <span id="totalPriceDisplay"></span> VND
    </div>

    <!-- Phần quay lại trang sản phẩm -->
    <a href="products.php" class="back-to-products">
        <i class="fas fa-arrow-left"></i> Quay lại trang sản phẩm
    </a>

    <!-- <div class="payment-container">
        <h2>Thanh toán</h2>
        <form id="checkout-form" action="process_order.php" method="POST">
            <div class="input-group">
                <label for="name">Tên:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="input-group">
                <label for="address">Địa chỉ giao hàng:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <button type="submit" id="checkout-btn" name="add_cart">Thanh toán</button>

            <form action="OnlineCheckoutController/online_checkout" method="POST">
                <button type="submit" name="vnpay">Thanh toán bằng VNPay</button>
            </form>

            
        </form>
    </div> -->

<div class="payment-container">
    <h2>Thanh toán</h2>
    <form id="checkout-form" action="process_order.php" method="POST">
        <div class="input-group">
            <label for="name">Tên:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="address">Địa chỉ giao hàng:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <button type="submit" id="checkout-btn" name="add_cart">Thanh toán</button>
    </form>

    <!-- Form thanh toán VNPay
    <form action="checkout.php" method="POST">
        <button type="submit" name="vnpay">Thanh toán bằng VNPay</button>
    </form> -->
    <!-- Form thanh toán VNPay -->
    <form action="checkout.php" method="POST">
            <button type="submit" name="vnpay">Thanh toán bằng VNPay</button>
            
            <!-- Các trường thông tin giỏ hàng cho VNPay -->
            <input type="hidden" name="name" id="vnpay_name" value="">
            <input type="hidden" name="email" id="vnpay_email" value="">
            <input type="hidden" name="phone" id="vnpay_phone" value="">
            <input type="hidden" name="address" id="vnpay_address" value="">
            <input type="hidden" name="total_price" id="vnpay_total_price" value="">
            <input type="hidden" name="total_quantity" id="vnpay_total_quantity" value="">
            <input type="hidden" name="cart_items" id="vnpay_cart_items" value="">
    </form>
</div>


    <footer>
        <!-- Footer của trang -->
        <div class="thank-you">
            <p>Cảm ơn bạn đã ghé qua Betty!</p>
        </div>
    </footer>

    <script>
$(document).ready(function() {
    var totalPrice = 0;
    var totalQuantity = 0;
    var cartItems = {}; // Để lưu trữ thông tin sản phẩm trong giỏ hàng

    // Lặp qua các mục đã được lưu trong sessionStorage và hiển thị trong giỏ hàng
    for (var i = 0; i < sessionStorage.length; i++) {
        var key = sessionStorage.key(i);
        if (key.indexOf('cartProduct_') !== -1) {
            var productInfo = JSON.parse(sessionStorage.getItem(key));
            var productId = productInfo.id;

            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            if (cartItems[productId]) {
                // Nếu sản phẩm đã tồn tại, tăng số lượng lên
                cartItems[productId].quantity++;
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng với số lượng là 1
                cartItems[productId] = {
                    name: productInfo.name,
                    price: productInfo.price,
                    quantity: 1
                };
            }
        }
    }

    // Hiển thị các sản phẩm trong giỏ hàng
    for (var productId in cartItems) {
        var product = cartItems[productId];
        totalQuantity += product.quantity;
        totalPrice += parseFloat(product.price) * product.quantity;
        $('#cart').append(`
            <div class="product">
                <p>${product.name}</p>
                <p>${product.price}</p>
                <input type="number" class="quantity" value="${product.quantity}" min="1">
                <button class="remove-from-cart" data-product-id="${productId}">Xóa</button>
            
            </div>
        `);
    }

    // Thêm thông tin sản phẩm vào form VNPay
    for (var productId in cartItems) {
                var product = cartItems[productId];
                $('#vnpay_cart_items').val($('#vnpay_cart_items').val() + product.name + ' x' + product.quantity + ', ');
            }

            // Cập nhật giá trị tổng vào các trường hidden
            $('#vnpay_total_price').val(totalPrice.toFixed(2));
            $('#vnpay_total_quantity').val(totalQuantity);

            // Xử lý thanh toán VNPay
            $('#vnpay_name').val($('#name').val());
            $('#vnpay_email').val($('#email').val());
            $('#vnpay_phone').val($('#phone').val());
            $('#vnpay_address').val($('#address').val());
            
    //thm
    for (var productId in cartItems) {
        var product = cartItems[productId];
        totalQuantity += product.quantity;
        $('#checkout-form').append(`
                <input type="hidden" name="name_product[]" value="${product.name}"> 
                <input type="hidden"  name="price[]" value="${product.price}"> 
                <input type="hidden"  name="quantity[]" value="${product.quantity}" > 
                <input type="hidden"  name="id[]" value="${productId}" > 
             
   `);
    }
    

    // Hiển thị tổng tiền hóa đơn
    $('#totalPriceDisplay').text(totalPrice.toFixed(2));

    // Hiển thị tổng số lượng và tổng giá trị vào form thanh toán
    $('#totalQuantity').val(totalQuantity);
    $('#totalPrice').val(totalPrice.toFixed(2));
    

    // Xử lý sự kiện khi nhấn nút "Xóa" cho mỗi sản phẩm trong giỏ hàng
    $(document).on('click', '.remove-from-cart', function() {
        var productId = $(this).data('product-id');
        for (var i = 0; i < sessionStorage.length; i++) {
            var key = sessionStorage.key(i);
            if (key.indexOf('cartProduct_') !== -1) {
                var productInfo = JSON.parse(sessionStorage.getItem(key));
                if (productInfo.id == productId) {
                    sessionStorage.removeItem(key); // Xóa sản phẩm khỏi sessionStorage
                    break;
                }
            }
        }
        location.reload(); // Tải lại trang để cập nhật giỏ hàng
    });
    
    // Xử lý sự kiện khi nhấn nút "Thanh toán"
    $('#checkout-btn').click(function() {
        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var address = $('#address').val();
        
        // Kiểm tra thông tin đặt hàng
        if (name && phone && email && address) {
            // Hiển thị thông báo đặt hàng thành công và xóa giỏ hàng
            alert("Đặt hàng thành công!");
            sessionStorage.clear(); // Xóa tất cả sản phẩm khỏi giỏ hàng
            location.reload(); // Tải lại trang để cập nhật giỏ hàng
        } else {
            alert("Vui lòng điền đầy đủ thông tin thanh toán!");
        }
    });
});

    </script>

</body>
</html>

<?php
} else {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    exit();
}
?>