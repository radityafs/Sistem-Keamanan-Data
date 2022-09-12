<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
    echo "Welcome User, account username : {$_SESSION['username']} !";
} else {
    header("Location: ../../index.php");
}
