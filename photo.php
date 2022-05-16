<?php
  session_start();
  if(isset($_SESSION['login_user'])){
    $login_user = $_SESSION['login_user'];
    $u_no = $login_user['u_no'];
    $u_lv = $login_user['u_lv'];
    $uid = $login_user['uid'];
    $upw = $login_user['upw'];
    $user_nm = $login_user['user_nm'];
  }else{
    echo 
    " <script>
        alert('로그인 해주세요.');
        location.href='index.html';
      </script>
    ";
    exit;
  }
  echo "u_no: $u_no, u_lv: $u_lv, uid: $uid, upw: $upw, user_nm: $user_nm";