<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    echo "Welcome Admin, account username : {$_SESSION['username']} !";
} else {
    header("Location: ../../index.php");
}
