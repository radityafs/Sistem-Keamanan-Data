<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <title>SKD - Authentikasi</title>
</head>

<body>
    <div class="login-box">

        <?php
        if (isset($_SESSION['error'])) {

            echo "<div class='error-msg'>
      <p>{$_SESSION['error']}</p>
    </div>";

            unset($_SESSION['error']);
        }
        ?>

        <h2>Register</h2>
        <h3> Kelompok 2 </h3>

        <form method="POST" action="./handler/register_handler.php">
            <div class="user-box">
                <input type="text" name="name" required>
                <label>Nama</label>
            </div>
            <div class="user-box">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="user-box">
                <select name="province">

                </select>
                <label>Address</label>
            </div>
            <div class="btn-right">
                <button type="submit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Submit
                </button>
            </div>
            <div style="display: flex; justify-content:center; flex-direction:column; margin-top:50px;" class="btn-nav">
                <p style="color:white; text-align:center;">Already registered ?</p>

                <a style="margin-top: 10px; text-align:center;" href="./login.php">Login
                    <span></span>
                </a>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="./src/province.js"></script>
    <script>
        window.onload = function() {
            const select = document.querySelector('select');
            for (let i = 0; i < province.length; i++) {
                const option = document.createElement('option');
                option.value = province[i];
                option.innerHTML = province[i];
                select.appendChild(option);
            }
        }
    </script>
</body>

</html>