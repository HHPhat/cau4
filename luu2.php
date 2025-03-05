<?php
session_start(); // Khởi động session
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin từ form
$old_pass = md5($_POST["old_pass"]);  // Mã hóa mật khẩu cũ
$new_pass = $_POST["new_pass"];
$confirm_pass = $_POST["confirm_pass"];
$user_email = $_SESSION['email']; // Lấy email từ session

// Kiểm tra mật khẩu cũ có đúng không
$sql = "SELECT password FROM customers WHERE email='$user_email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row["password"] !== $old_pass) {
    die("Mật khẩu cũ không đúng. Vui lòng thử lại!");
}

// Kiểm tra mật khẩu mới có khớp với mật khẩu nhập lại không
if ($new_pass !== $confirm_pass) {
    die("Mật khẩu mới nhập lại không khớp. Vui lòng thử lại!");
}

// Kiểm tra mật khẩu mới không được trùng với mật khẩu cũ
if (md5($new_pass) === $old_pass) {
    die("Mật khẩu mới không được giống mật khẩu cũ!");
}

// Cập nhật mật khẩu mới vào CSDL
$new_pass_hashed = md5($new_pass);
$update_sql = "UPDATE customers SET password='$new_pass_hashed' WHERE email='$user_email'";

if ($conn->query($update_sql) === TRUE) {
    echo "Đổi mật khẩu thành công! Hãy đăng nhập lại.";
    session_destroy(); // Đăng xuất để người dùng đăng nhập lại với mật khẩu mới
    header("refresh:3;url=login.php");
} else {
    echo "Lỗi khi đổi mật khẩu: " . $conn->error;
}

$conn->close();
?>
