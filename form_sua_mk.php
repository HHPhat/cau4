<!DOCTYPE html>
<html>
<head>
    <title>Đổi Mật Khẩu</title>
</head>
<body>
    <h2>Đổi Mật Khẩu</h2>
    <form action="luu2.php" method="post">
        <label for="old_pass">Mật khẩu cũ:</label>
        <input type="password" name="old_pass" required><br>

        <label for="new_pass">Mật khẩu mới:</label>
        <input type="password" name="new_pass" required><br>

        <label for="confirm_pass">Nhập lại mật khẩu mới:</label>
        <input type="password" name="confirm_pass" required><br>

        <input type="submit" value="Đổi mật khẩu">
    </form>
</body>
</html>
