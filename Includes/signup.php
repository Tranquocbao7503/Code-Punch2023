<?php

require_once("connection.php");


if (isset($_POST["submit"])) {

    // grabbing data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];
    $role = $_POST['role'];
    // kiem tra dieu kien neu cac attribute bi bo rong

    if ($username == "" || $password == "" || $name == "" || $email == "" || $phonenum == '' || $role == '') {
        echo "Your input cannot be empty";
    } else {
        $hashedPassword = hash('sha256', $password);
        $sql = "INSERT INTO users (username,password,fullname,email,phonenum,role) VALUES
('$username','$hashedPassword','$name','$email','$phonenum','$role')";


        // thực thi câu sql với biến con lấy từ file connection.php
        try {
            mysqli_query($connection, $sql);
            echo "Signing up successfully";
        } catch (mysqli_sql_exception $e) {
            $errorMessage = $e->getMessage();
            if (strpos($errorMessage, "Duplicate entry") !== false) {
                echo "Duplicate signing up account";
            } else {
                echo "Error occurred during signing up";
            }
        }
    }
}

?>

<form action="signup.php" method="post">
    <table>
        <tr>
            <td colspan="2" align="center">Sign up system </td>
        </tr>
        <tr>
            <td>Username :</td>
            <td><input type="text" id="username" name="username"></td>
        </tr>
        <tr>
            <td>Password :</td>
            <td><input type="password" id="password" name="password"></td>
        </tr>
        <tr>
            <td>Full Name :</td>
            <td><input type="text" id="name" name="name"></td>
        </tr>
        <tr>
            <td>Email :</td>
            <td><input type="text" id="email" name="email"></td>
        </tr>
        <tr>
            <td>Phone number: </td>
            <td> <input type="text" id="phonenum" name="phonenum"></td>
        </tr>

        <tr>
            <td>Role: </td>
            <td>
                <label>
                    <input type="radio" name="role" value="teacher">
                    Teacher
                </label>
                <label>
                    <input type="radio" name="role" value="student">
                    Student
                </label>
                <label>
                    <input type="radio" name="role" value="admin">
                    Admin
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="submit" value="Sign up"></td>
        </tr>

    </table>

</form>