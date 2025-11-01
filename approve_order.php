<?php
include 'config.php';

// Kiểm tra xem có tham số id được truyền từ trang admin không
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $orderId = $_GET['id'];

    // Lấy mã khách hàng từ đơn hàng
    $queryCustomerId = "SELECT MaKH FROM donhang WHERE MaDonHang = $orderId";
    $resultCustomerId = mysqli_query($conn, $queryCustomerId);
    $customerId = mysqli_fetch_assoc($resultCustomerId)['MaKH'];

    // Xóa tất cả các đơn hàng của khách hàng
    $deleteOrdersQuery = "DELETE FROM donhang WHERE MaKH = $customerId";
    $deleteOrdersResult = mysqli_query($conn, $deleteOrdersQuery);

    // Kiểm tra xem việc xóa đơn hàng đã thành công hay không
    if($deleteOrdersResult) {
        // Xóa thông tin khách hàng
        $deleteCustomerQuery = "DELETE FROM khachhang WHERE MaKH = $customerId";
        $deleteCustomerResult = mysqli_query($conn, $deleteCustomerQuery);

        // Kiểm tra xem việc xóa thông tin khách hàng đã thành công hay không
        if($deleteCustomerResult) {
            // Thông báo thành công bằng JavaScript
            echo '<script>alert("Hoàn thành đơn hàng!");</script>';
            // Chuyển hướng trở lại trang admin
            echo '<script>window.location = "manage_order.php";</script>';
            exit; // Đảm bảo dừng kịch bản PHP sau khi chuyển hướng
        } else {
            echo "Đã xảy ra lỗi trong quá trình xóa thông tin khách hàng.";
        }
    } else {
        echo "Đã xảy ra lỗi trong quá trình xóa đơn hàng.";
    }
} else {
    echo "ID đơn hàng không hợp lệ.";
}

mysqli_close($conn);
?>
