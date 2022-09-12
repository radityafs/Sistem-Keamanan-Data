<?php
$db_server = "localhost";
$db_database = "keamanan_data";
$db_username = "root";
$db_password = "";

$conn = mysqli_connect($db_server, $db_username, $db_password, $db_database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    exit();
}

if (mysqli_num_rows(mysqli_query($conn, "SHOW TABLES LIKE 'users'")) == 0) {

    $sql = "CREATE TABLE users (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        username VARCHAR(128) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        province VARCHAR(255) NOT NULL,
        role VARCHAR(30) NOT NULL,
        token VARCHAR(255) NOT NULL,
        is_verified TINYINT NOT NULL
    )";

    mysqli_query($conn, $sql);

    $admin_password = password_hash("admin", PASSWORD_DEFAULT);
    $user_password = password_hash("user", PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, name,email,province, password,token, role, is_verified)
    VALUES ('admin', 'admin', 'admin','ACEH', '$admin_password','token', 'admin',1),
    ('user','user', 'user','ACEH', '$user_password','token', 'user',1)";

    mysqli_query($conn, $sql);
}
