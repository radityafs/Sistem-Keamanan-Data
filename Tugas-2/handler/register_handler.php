<?php
require_once('./email_handler.php');
require_once('./db_connection.php');

session_start();

if (isset($_POST['name'], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["province"])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST["password"];
    $province = $_POST["province"];

    if ($username == trim($username) && str_contains($username, ' ')) {
        $_SESSION['error'] = "Username cannot contain spaces";
        header("Location: ../index.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email is not valid";
        header("Location: ../index.php");
        exit();
    }

    $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
    if (!preg_match($pattern, $password)) {
        $_SESSION['error'] = "Password is not strong enough";
        header("Location: ../index.php");
        exit();
    }

    $name = $conn->escape_string($name);
    $username = $conn->escape_string($username);
    $email = $conn->escape_string($email);
    $password = $conn->escape_string($password);
    $province = $conn->escape_string($province);
    $token = bin2hex(random_bytes(36));

    $sql = "INSERT INTO users (name, username, email, password, province, role, token, is_verified) VALUES ('$name', '$username', '$email', '$password', '$province','user', '$token',0)";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $sendEmail = sendEmailConfirmation($email, $token);
        if ($sendEmail) {
            $_SESSION['error'] = "Register success, please check your email";
            header("Location: ../confirm.php");
        } else {
            $_SESSION['error'] = "Failed send email verification, please contact admin.";
            header("Location: ../index.php");
        }
    } else {
        $_SESSION['error'] = "Register failed";
        header("Location: ../index.php");
    }
} else {
    $_SESSION["error"] = "Username or password is not set";
    header("Location: ../index.php");
}
