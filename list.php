<?php
// Kết nối tới cơ sở dữ liệu (thay thế bằng nội dung của connect.php)
require_once('connect.php');

// Truy vấn để lấy danh sách các username
$sql = "SELECT id, username FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   // In danh sách các username và tạo liên kết đến profile.php
   echo "<ul>";
   while ($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $username = $row["username"];
      $profileLink = "profile.php?id=" . $id;
      echo "<li><a href=\"$profileLink\">$username</a></li>";
   }
   echo "</ul>";
} else {
   echo "Không có dữ liệu.";
}

// Đóng kết nối
$conn->close();
?>