<?php
  session_start();
  $login_user = $_SESSION['login_user'];
  $user_nm = $login_user['user_nm'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>메인화면</title>
</head>
<body>
  <?php include_once "header.php";?>
  <main>
    <a href="photo.php"><button>사진 찍으러 가기</button></a>
  </main>
</body>
</html>