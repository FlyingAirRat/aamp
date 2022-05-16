<?php
  session_start();
  if(isset($_SESSION['login_user'])){
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
  }else{
    echo 
    " <script>
        alert('로그인 해주세요.');
        location.href='index.html';
      </script>
    ";
    exit;
  }

?>
<link rel="stylesheet" href="./header.css">
<header>
  <div id="log">
    <?=$user_nm?>(<?=$lv_nm?>), 안녕하세요.
    <a href="logout.php"><button>로그아웃</button></a>
  </div>
</header>