<?php
// Kết nối tới cơ sở dữ liệu (thay thế bằng nội dung của connect.php)
require_once('connect.php');

// Truy vấn để lấy danh sách các username và role
$sql = "SELECT id, username, role FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
   // Tạo bảng và tiêu đề cột
   echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>";
   echo "<table style='border-collapse: collapse;'>";
   echo "<tr><th style='border: 1px solid black; font-size: 32px;'>Số thứ tự</th><th style='border: 1px solid black; font-size: 32px;'>Username</th><th style='border: 1px solid black; font-size: 32px;'>Role</th></tr>";

   // Lặp qua từng dòng kết quả
   $count = 1;
   while ($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $username = $row["username"];
      $role = $row["role"];

      // Hiển thị dữ liệu trong từng ô và mã hóa HTML
      echo "<tr>";
      echo "<td style='border: 1px solid black; font-size: 32px;'>" . htmlspecialchars($count) . "</td>";
      echo "<td style='border: 1px solid black; font-size: 32px;'><a href=\"profile.php?id=" . htmlspecialchars($id) . "\">" . htmlspecialchars($username) . "</a></td>";
      echo "<td style='border: 1px solid black; font-size: 32px;'>" . htmlspecialchars($role) . "</td>";
      echo "</tr>";

      $count++;
   }

   echo "</table>";
   echo "</div>";
} else {
   echo "Không có dữ liệu.";
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>