<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Thống kê</title>
    <style>
        /* CSS để định dạng giao diện */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        body {
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
        }

        h1 {
            margin-bottom: 20px;
            color: #2c3e50;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        form {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
            color: #34495e;
        }

        select {
            padding: 8px 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            width: 100%;
            max-width: 200px;
            font-size: 14px;
            background-color: #ecf0f1;
        }

        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            max-width: 600px;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
            color: #2c3e50;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        h2 {
            margin-top: 20px;
            font-size: 20px;
            color: #34495e;
        }

        /* Canvas để hiển thị biểu đồ */
        .chart-container {
            width: 80%;
            max-width: 800px;
            margin-top: 20px;
        }
                /* CSS cho icon */
                .back-to-admin {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #333; /* Màu chữ */
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease-in-out;
        }

        .back-to-admin i {
            margin-right: 5px;
            font-size: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .back-to-admin:hover i {
            transform: translateX(-3px);
        }

        .back-to-admin:hover {
            color: rgb(255, 64, 129); /* Màu khi di chuột qua */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <a href="admin.php" class="back-to-admin">
         <i class="fas fa-arrow-left"></i>
    </a>
    <h1>Thống kê Dữ liệu</h1>

    <!-- Form lựa chọn loại thống kê -->
    <form method="POST" action="">
        <label for="type">Chọn loại thống kê:</label>
        <select name="type" id="type">
            <option value="doanh_thu_ngay">Doanh Thu Theo Ngày</option>
            <option value="doanh_thu_thang">Doanh Thu Theo Tháng</option>
            <option value="doanh_thu_nam">Doanh Thu Theo Năm</option>
            <option value="don_hang_ngay">Số Lượng Đơn Hàng Theo Ngày</option>
            <option value="don_hang_thang">Số Lượng Đơn Hàng Theo Tháng</option>
            <option value="don_hang_nam">Số Lượng Đơn Hàng Theo Năm</option>
            <option value="san_pham_ban_chay">Top Sản Phẩm Bán Chạy</option>
            <option value="don_hang_trang_thai">Thống kê Đơn Hàng Theo Trạng Thái</option>
        </select>
        <button type="submit" name="submit">Xem Thống Kê</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $type = $_POST['type'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cakesofbetty";

        // Tạo kết nối
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Hàm lấy dữ liệu thống kê theo truy vấn
        function getStatistics($sql, $conn) {
            $result = $conn->query($sql);
            $data = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        
        // Câu truy vấn thống kê đơn hàng theo trạng thái
        if ($type == 'don_hang_trang_thai') {
            $sql = "SELECT trangThai, COUNT(*) as SoLuong FROM donhang GROUP BY trangThai";
            $statistics = getStatistics($sql, $conn);

            // Hiển thị kết quả thống kê đơn hàng theo trạng thái
            echo "<h2>Thống kê Đơn Hàng Theo Trạng Thái</h2>";
            echo "<table>";
            echo "<tr><th>Trạng Thái</th><th>Số Lượng</th></tr>";
            foreach ($statistics as $row) {
                echo "<tr><td>" . $row['trangThai'] . "</td><td>" . $row['SoLuong'] . "</td></tr>";
            }
            echo "</table>";
        }
// Câu truy vấn tương ứng với lựa chọn
        $sql = "";
        $title = "";

        switch ($type) {
            case "doanh_thu_ngay":
                $sql = "SELECT DATE(NgayDatHang) AS ThoiGian, SUM(GiaTriDonHang) AS GiaTri FROM donhang GROUP BY DATE(NgayDatHang)";
                $title = "Doanh Thu Theo Ngày";
                break;
            case "doanh_thu_thang":
                $sql = "SELECT CONCAT(YEAR(NgayDatHang), '-', MONTH(NgayDatHang)) AS ThoiGian, SUM(GiaTriDonHang) AS GiaTri FROM donhang GROUP BY YEAR(NgayDatHang), MONTH(NgayDatHang)";
                $title = "Doanh Thu Theo Tháng";
                break;
            case "doanh_thu_nam":
                $sql = "SELECT YEAR(NgayDatHang) AS ThoiGian, SUM(GiaTriDonHang) AS GiaTri FROM donhang GROUP BY YEAR(NgayDatHang)";
                $title = "Doanh Thu Theo Năm";
                break;
            case "don_hang_ngay":
                $sql = "SELECT DATE(NgayDatHang) AS ThoiGian, COUNT(*) AS GiaTri FROM donhang GROUP BY DATE(NgayDatHang)";
                $title = "Số Lượng Đơn Hàng Theo Ngày";
                break;
            case "don_hang_thang":
                $sql = "SELECT CONCAT(YEAR(NgayDatHang), '-', MONTH(NgayDatHang)) AS ThoiGian, COUNT(*) AS GiaTri FROM donhang GROUP BY YEAR(NgayDatHang), MONTH(NgayDatHang)";
                $title = "Số Lượng Đơn Hàng Theo Tháng";
                break;
            case "don_hang_nam":
                $sql = "SELECT YEAR(NgayDatHang) AS ThoiGian, COUNT(*) AS GiaTri FROM donhang GROUP BY YEAR(NgayDatHang)";
                $title = "Số Lượng Đơn Hàng Theo Năm";
                break;
            case "san_pham_ban_chay":
                $sql = "SELECT TenBanh AS ThoiGian, SUM(SoLuongBanh) AS GiaTri FROM donhang GROUP BY MaBanh ORDER BY GiaTri DESC LIMIT 5";
                $title = "Top Sản Phẩm Bán Chạy";
                break;
        }

        // Thực hiện truy vấn
        if ($sql !== "") {
            $data = getStatistics($sql, $conn);

            // Hiển thị kết quả
            echo "<h2>$title</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Thời Gian</th><th>Giá Trị</th></tr>";
            foreach ($data as $row) {
                echo "<tr><td>{$row['ThoiGian']}</td><td>{$row['GiaTri']}</td></tr>";
            }
            echo "</table>";

            // Chuyển dữ liệu sang định dạng JavaScript cho biểu đồ
            $labels = [];
            $values = [];
            foreach ($data as $row) {
                $labels[] = $row['ThoiGian'];
                $values[] = $row['GiaTri'];
            }
            $labels = json_encode($labels);
            $values = json_encode($values);
            echo "<div class='chart-container'><canvas id='myChart'></canvas></div>";
        }

        // Đóng kết nối
        $conn->close();
    }
    ?>

    <script>
        // Tạo biểu đồ sử dụng Chart.js
        const ctx = document.getElementById('myChart').getContext('2d');
        const labels = <?php echo $labels ?? '[]'; ?>;
        const values = <?php echo $values ?? '[]'; ?>;
        const title = "<?php echo $title ?? ''; ?>";

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: title,
                    data: values,
                    backgroundColor: 'rgba(52, 152, 219, 0.5)',
                    borderColor: 'rgba(41, 128, 185, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
