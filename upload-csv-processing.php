<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra file được tải lên
if (isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra định dạng CSV
    if ($fileType != "csv") {
        die("Chỉ chấp nhận file CSV!");
    }

    // Lưu file vào server
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "File ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " đã được tải lên.<br>";
        
        // Đọc nội dung file CSV
        $csv = array();
        $lines = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $key => $value) {
            $csv[] = str_getcsv($value); // Chuyển từng dòng thành mảng
        }

        // Chèn dữ liệu vào CSDL
        foreach ($csv as $row) {
            if (count($row) < 4) continue; // Bỏ qua dòng không đủ dữ liệu
            
            $fullname = $conn->real_escape_string($row[0]);
            $email = $conn->real_escape_string($row[1]);
            $birthday = date('Y-m-d', strtotime($row[2]));
            $password = md5($row[3]); // Mã hóa mật khẩu trước khi lưu

            $sql = "INSERT INTO customers (fullname, email, birthday, password) VALUES ('$fullname', '$email', '$birthday', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "Thêm khách hàng: $fullname thành công!<br>";
            } else {
                echo "Lỗi: " . $conn->error . "<br>";
            }
        }
    } else {
        echo "Lỗi khi tải file.";
    }
}

$conn->close();
?>
