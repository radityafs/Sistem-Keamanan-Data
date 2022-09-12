<?php
require_once('./db_connection.php');

session_start();

if (isset($_POST['username'], $_POST['password'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST["password"]);

    $sql = "SELECT password,role,is_verified FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['is_verified'] == 0) {
            $_SESSION['error'] = "Please verify your email first";
            header("Location: ../confirm.php");
            exit();
        }

        $password_hash = $row['password'];

        if (password_verify($password, $password_hash)) {

            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: ../pages/admin/");
            } else {
                header("Location: ../pages/user/");
            }
        } else {
            $_SESSION['error'] = "Username or password is incorrect";
            header("Location: ../index.php");
        }
    } else {
        $_SESSION["error"] = "Username or password is incorrect";
        header("Location: ../index.php");
    }
} else {
    $_SESSION["error"] = "Username or password is not set";
    header("Location: ../index.php");
}
