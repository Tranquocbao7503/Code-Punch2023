<?php
session_start();

// Check if the session variables exist
if (isset($_SESSION['username'])) {
    $fullname = $_SESSION['fullname'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $role = $_SESSION['role'];
} else {
    // Redirect to the login page if the session variables are not set
    header('Location: login.php');
   
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <p>Full Name: <?php echo $fullname; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Phone: <?php echo $phone; ?></p>
    <p>Role: <?php echo $role; ?></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
