<?php

require_once('./db_connection.php');

session_start();

if (isset($_POST['token'])) {
    $token = $conn->real_escape_string($_POST['token']);

    $sql = "SELECT username,role FROM users WHERE token = '$token'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $username = $row['username'];

        $sql = "UPDATE users SET is_verified = 1 WHERE username = '$username'";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['error'] = "Your account has been verified";

            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: ../pages/admin/");
            } else {
                header("Location: ../pages/user/");
            }
        } else {
            $_SESSION['error'] = "Something went wrong";
            header("Location: ../confirm.php");
        }
    } else {
        $_SESSION['error'] = "Token is incorrect";
        header("Location: ../confirm.php");
    }
} else {
    $_SESSION['error'] = "Token is not set";
    header("Location: ../confirm.php");
}
