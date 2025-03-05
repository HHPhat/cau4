<?php
// Bắt đầu session
session_start();

// Xóa tất cả các biến trong session
session_unset();

// Hủy session
session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập hoặc trang chủ
header("Location: Login.php"); // Hoặc trang bạn muốn người dùng được chuyển hướng sau khi đăng xuất
exit();
?>
