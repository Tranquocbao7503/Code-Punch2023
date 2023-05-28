<?php
// Kết nối tới cơ sở dữ liệu
include 'connect.php';

// Xử lý khi nhấn nút đăng nhập
if (isset($_POST['login'])) {
    // Lấy dữ liệu từ biểu mẫu
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Tìm người dùng trong cơ sở dữ liệu
    $getUserQuery = "SELECT * FROM users WHERE username = ?";
    $getUserStmt = $conn->prepare($getUserQuery);
    $getUserStmt->bind_param("s", $username);
    $getUserStmt->execute();
    $getUserResult = $getUserStmt->get_result();

    if ($getUserResult->num_rows == 1) {
        $user = $getUserResult->fetch_assoc();
        $hashedPassword = hash('sha256', $password);

        // Kiểm tra mật khẩu
        if ($hashedPassword === $user['password']) {
            // Đăng nhập thành công, tạo session và chuyển hướng đến wellcome.php
            session_start();
            $_SESSION['username'] = $username;
            // require_once('../Class/homepage.php');
            require_once($_SERVER['DOCUMENT_ROOT'] . '/Code-Punch2023/Class/homepage.php');
            exit();
        } else {
            echo "Mật khẩu không chính xác.";
        }
    } else {
        echo "Tên đăng nhập không tồn tại.";
    }
    $getUserStmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>

<body>
    <h2>Đăng nhập</h2>
    <form method="post" action="login.php">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" required><br><br>
        <label>Mật khẩu:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="login" value="Đăng nhập">
    </form>
</body>

</html>