<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $maBanh = $_POST['maBanh']; // Lấy mã bánh từ form
    $tenBanh = $_POST['tenBanh'];
    $maNSX = $_POST['maNSX']; // Lấy mã nhà sản xuất từ form
    $maLoai = $_POST['maLoai']; // Lấy mã loại bánh từ form
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    $query = "UPDATE banhngot SET MaBanh = '$maBanh', MaNSX = '$maNSX', MaLoai = '$maLoai', TenBanh = '$tenBanh', Description = '$description', Price = '$price' WHERE MaBanh = '$id'";
    if (mysqli_query($conn, $query)) {
        // Thông báo thành công bằng JavaScript
        echo '<script>alert("Cập nhật sản phẩm thành công!");</script>';
        // Chuyển hướng trở lại trang admin
        echo '<script>window.location = "manage_product.php";</script>';
        exit();
    } else {
        echo "Cập nhật sản phẩm thất bại: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
