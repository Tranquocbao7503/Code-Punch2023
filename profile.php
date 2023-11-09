<?php
// Kết nối tới cơ sở dữ liệu (thay thế bằng nội dung của connect.php)
require_once('connect.php');

// Kiểm tra xem id có tồn tại trong URL không
if (isset($_GET['id'])) {
   // Lấy giá trị id từ URL và kiểm tra tính hợp lệ
   $id = $_GET['id'];
   if (!is_numeric($id)) {
      echo "Id không hợp lệ.";
      exit;
   }

   try {
      // Truy vấn để lấy thông tin của người dùng với id tương ứng
      $sql = "SELECT * FROM users WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
         // Hiển thị thông tin người dùng
         $row = $result->fetch_assoc();
         echo "<h1>Thông tin người dùng</h1>";
         echo "<p><strong>Id:</strong> " . htmlspecialchars($row['id']) . "</p>";
         echo "<p><strong>Username:</strong> " . htmlspecialchars($row['username']) . "</p>";
         echo "<p><strong>Fullname:</strong> " . htmlspecialchars($row['fullname']) . "</p>";
         echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
         echo "<p><strong>Phone Number:</strong> " . htmlspecialchars($row['phonenum']) . "</p>";
         echo "<p><strong>Role:</strong> " . htmlspecialchars($row['role']) . "</p>";

         // Nút chỉnh sửa profile
         echo "<a href=\"profile.php?id=" . htmlspecialchars($row['id']) . "&action=edit\">Chỉnh sửa</a>";

         // Nút xoá profile
         echo "<a href=\"profile.php?id=" . htmlspecialchars($row['id']) . "&action=delete\">Xoá</a>";

         // Xử lý yêu cầu chỉnh sửa hoặc xoá profile
         if (isset($_GET['action'])) {
            $action = $_GET['action'];
            if ($action === "edit") {
               // Hiển thị biểu mẫu chỉnh sửa profile
               echo "<h2>Chỉnh sửa profile</h2>";
               echo "<form action=\"profile.php?id=" . htmlspecialchars($row['id']) . "&action=update\" method=\"post\">";
               echo "<label for=\"username\">Username:</label>";
               echo "<input type=\"text\" id=\"username\" name=\"username\" value=\"" . htmlspecialchars($row['username']) . "\">";
               echo "<label for=\"fullname\">Fullname:</label>";
               echo "<input type=\"text\" id=\"fullname\" name=\"fullname\" value=\"" . htmlspecialchars($row['fullname']) . "\">";
               echo "<label for=\"email\">Email:</label>";
               echo "<input type=\"email\" id=\"email\" name=\"email\" value=\"" . htmlspecialchars($row['email']) . "\">";
               echo "<label for=\"phonenum\">Phone Number:</label>";
               echo "<input type=\"text\" id=\"phonenum\" name=\"phonenum\" value=\"" . htmlspecialchars($row['phonenum']) . "\">";
               echo "<label for=\"role\">Role:</label>";
               echo "<select id=\"role\" name=\"role\">";
               echo "<option value=\"teacher\"" . ($row['role'] === 'teacher' ? ' selected' : '') . ">Teacher</option>";
               echo "<option value=\"student\"" . ($row['role'] === 'student' ? ' selected' : '') . ">Student</option>";
               echo "<option value=\"admin\"" . ($row['role'] === 'admin' ? ' selected' : '') . ">Admin</option>";
               echo "</select>";
               echo "<button type=\"submit\">Lưu</button>";
               echo "</form>";

               // Xử lý khi người dùng gửi biểu mẫu chỉnh sửa
               if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  $username = $_POST['username'];
                  $fullname = $_POST['fullname'];
                  $email = $_POST['email'];
                  $phonenum = $_POST['phonenum'];
                  $role = $_POST['role'];

                  // Cập nhật thông tin profile vào cơ sở dữ liệu
                  $updateSql = "UPDATE users SET username = ?, fullname = ?, email = ?, phonenum = ?, role = ? WHERE id = ?";
                  $updateStmt = $conn->prepare($updateSql);
                  $updateStmt->bind_param("sssssi", $username, $fullname, $email, $phonenum, $role, $id);
                  $updateStmt->execute();

                  // Chuyển hướng về trang profile hiện tại
                  header("Location: profile.php?id=$id");
                  exit;
               }
            } elseif ($action === "delete") {
               // Hiển thị xác nhận xoá profile
               echo "<h2>Xoá profile</h2>";
               echo "<p>Bạn có chắc chắn muốn xoá profile này?</p>";
               echo "<form action=\"profile.php?id=" . htmlspecialchars($row['id']) . "&action=confirm_delete\" method=\"post\">";
               echo "<button type=\"submit\">Xoá</button>";
               echo "</form>";

               // Xử lý khi người dùng gửi yêu cầu xoá profile
               if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  // Xoá profile và chuyển hướng về trang khác (ví dụ: trang danh sách người dùng)
                  $deleteSql = "DELETE FROM users WHERE id = ?";
                  $deleteStmt = $conn->prepare($deleteSql);
                  $deleteStmt->bind_param("i", $id);
                  $deleteStmt->execute();

                  // Chuyển hướng về trang khác
                  header("Location: homepage.php");
                  exit;
               }
            }
         }
      } else {
         echo "Người dùng không tồn tại.";
      }

      // Đóng kết nối
      $stmt->close();
      $conn->close();

   } catch (Exception $e) {
      echo "Lỗi MySQL: " . $e->getMessage();
   }
} else {
   echo "Id không được cung cấp.";
}
?>