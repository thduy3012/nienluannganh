<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa các tham chiếu từ bảng ChiTietDonHang trước khi xóa sản phẩm
    // $queryDeleteReferences1 = "DELETE FROM ChiTietDonHang WHERE MaBanh = '$id'";
    // mysqli_query($conn, $queryDeleteReferences1);

    // Xóa các tham chiếu từ bảng LamViecTai trước khi xóa sản phẩm
    // $queryDeleteReferences2 = "DELETE FROM LamViecTai WHERE MaBanh = '$id'";
    // mysqli_query($conn, $queryDeleteReferences2);

    // Xóa sản phẩm khỏi bảng BanhNgot
    $query = "DELETE FROM BanhNgot WHERE MaBanh = '$id'";
    if (mysqli_query($conn, $query)) {
        // Thông báo thành công bằng JavaScript
        echo '<script>alert("Đã xóa sản phẩm thành công!");</script>';
        // Chuyển hướng trở lại trang admin
        echo '<script>window.location = "manage_product.php";</script>';
    } else {
        echo "Xóa sản phẩm thất bại: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
