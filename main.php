<?php
  session_start();
  $login_user = $_SESSION['login_user'];
  $u_lv = $login_user['u_lv'];
  $user_nm = $login_user['user_nm'];

  $lv_nm = "";
  switch($u_lv){
    case 0:
      $lv_nm = "관리자";
      break;
    case 1:
      $lv_nm = "선생님";
      break;
    case 2:
      $lv_nm = "학생";
      break;
  }
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
  <div><?=$user_nm?> (<?=$lv_nm?>)님, 안녕하세요.</div>
</body>
</html>