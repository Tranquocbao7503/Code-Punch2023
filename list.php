<?php
// Kết nối tới cơ sở dữ liệu (thay thế bằng nội dung của connect.php)
require_once('connect.php');

// Truy vấn để lấy danh sách các username
$sql = "SELECT id, username FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   // Tạo bảng và tiêu đề cột
   echo "<table>";
   echo "<tr><th>Số thứ tự</th><th>Username</th></tr>";

   // Lặp qua từng dòng kết quả
   $count = 1;
   while ($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $username = $row["username"];

      // Hiển thị dữ liệu trong từng ô
      echo "<tr>";
      echo "<td>$count</td>";
      echo "<td><a href=\"profile.php?id=$id\">$username</a></td>";
      echo "</tr>";

      $count++;
   }

   echo "</table>";
} else {
   echo "Không có dữ liệu.";
}

// Đóng kết nối
$conn->close();
?>