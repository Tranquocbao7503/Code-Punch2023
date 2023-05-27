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

    // Đóng prepared statement và kết nối
    $stmt->close();
    $conn->close();
}
?>
