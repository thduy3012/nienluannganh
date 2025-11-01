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
        var address = $('#address').val();
        
        // Kiểm tra thông tin đặt hàng
        if (name && phone && address) {
            // Hiển thị thông báo đặt hàng thành công và xóa giỏ hàng
            alert("Đặt hàng thành công!");
            sessionStorage.clear(); // Xóa tất cả sản phẩm khỏi giỏ hàng
            location.reload(); // Tải lại trang để cập nhật giỏ hàng
        } else {
            alert("Vui lòng điền đầy đủ thông tin thanh toán!");
        }
    });
});