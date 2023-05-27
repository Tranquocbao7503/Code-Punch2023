<?php
    // Kết nối tới cơ sở dữ liệu
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "codeandpunch";
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }
?>
