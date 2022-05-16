<?php
  include_once "db/db_user.php";
  $uid = $_POST['uid'];
  $upw = $_POST['upw'];

  $param = [
    'uid' => $uid
  ];

  $result = sel_user($param);
  if(empty($result)){
    echo
    " <script>
        alert('해당하는 아이디가 없습니다.');
        history.back();
      </script>
    ";
    exit;
  }
  
  if($result['upw'] === $upw){
    session_start();
    $_SESSION["login_user"] = $result;
    
    switch($result['u_lv']){
      case 0:
        Header("Location: admin.php");
        break;
      case 1:
        Header("Location: class.php");
        break;
      case 2:
        Header("Location: main.php");
        break;
    }
  }else{
    echo
    " <script>
        alert('비밀번호가 다릅니다.');
        history.back();
      </script>
    ";
  }