<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maBanh = $_POST['maBanh']; // Lấy mã bánh từ form
    $tenBanh = $_POST['tenBanh'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $maNSX = $_POST['maNSX']; // Lấy mã nhà sản xuất từ form
    $maLoai = $_POST['maLoai']; // Lấy mã loại bánh từ form

    // Xử lý upload hình ảnh
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    $image = $targetFile;

    // Thêm bản ghi vào cơ sở dữ liệu
    $query = "INSERT INTO banhngot (MaBanh, TenBanh, Description, Price, Image, MaNSX, MaLoai) VALUES ('$maBanh', '$tenBanh', '$description', '$price', '$image', '$maNSX', '$maLoai')";
    if (mysqli_query($conn, $query)) {
        // Thông báo thành công bằng JavaScript
        echo '<script>alert("Thêm sản phẩm thành công!");</script>';
        // Chuyển hướng trở lại trang admin
        echo '<script>window.location = "manage_product.php";</script>';
    } else {
        echo "Thêm sản phẩm thất bại: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
