$(document).ready(function() {
    // Xử lý sự kiện khi nhấn nút "Thanh toán"
    $('#checkout-btn').click(function() {
        // Hiển thị form nhập thông tin khách hàng
        $('#checkout-form').show();
    });

    // Xử lý sự kiện khi nhấn nút "Xác nhận đơn hàng"
    $('#confirm-order-btn').click(function() {
        // Lấy thông tin từ form
        var name = $('#name').val();
        var phone = $('#phone').val();
        var address = $('#address').val();

        // Kiểm tra xem các trường thông tin có trống không
        if (name && phone && address) {
            // Xử lý đơn hàng và hiển thị thông tin
            // Hiển thị thông tin đơn hàng và khách hàng đã đặt hàng
            $('#order-details').html(`
                <h2>Thông tin đơn hàng</h2>
                <p>Tên: ${name}</p>
                <p>Số điện thoại: ${phone}</p>
                <p>Địa chỉ: ${address}</p>
                <!-- Hiển thị các sản phẩm đã đặt -->
            `);
        } else {
            alert('Vui lòng nhập đầy đủ thông tin khách hàng.');
        }
    });
});