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

    <h2>Login</h2>
    <h3> Kelompok 2 </h3>

    <form method="POST" action="./handler/login_handler.php">
      <div class="user-box">
        <input type="text" name="username" required>
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required>
        <label>Password</label>
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


    </form>
  </div>
</body>

</html>