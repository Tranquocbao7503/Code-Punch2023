<?php
// Kiểm tra xem người dùng đã gửi biểu mẫu đăng nhập chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ biểu mẫu đăng nhập
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kết nối tới cơ sở dữ liệu
    require 'connect.php';

    // Chuẩn bị truy vấn SQL với prepared statement
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả truy vấn
    if ($result->num_rows == 1) {
        // Đăng nhập thành công
        $row = $result->fetch_assoc();
        echo "Đăng nhập thành công! Xin chào " . $row['fullname'];
    } else {
        // Đăng nhập thất bại
        echo "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
    header("location: wellcome.php");
    // Đóng prepared statement và kết nối
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <form method="post" action="login.php">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" required><br><br>
        <label>Mật khẩu:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>