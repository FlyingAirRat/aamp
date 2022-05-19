<?php
  include_once "./db/db_user.php";
  $uid = $_POST['uid'];
  $upw = $_POST['upw'];
  $auto_login = isset($_POST['auto_login']) ? $_POST['auto_login'] : 0;

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
    if($auto_login == "1"){
      $duration = 24 * 60 * 60 * 30;  // 30일
      ini_set('session.gc_maxlifetime', $duration);
      session_set_cookie_params($duration);
      session_start();
      print "1";
    }
    session_start();
    $_SESSION["login_user"] = $result;
    print "0";
    // switch($result['u_lv']){
    //   case 0:
    //     Header("Location: admin.php");
    //     break;
    //   case 1:
    //     Header("Location: class.php");
    //     break;
    //   case 2:
    //     Header("Location: photo.php");
    //     break;
    }
  }else{
    echo
    " <script>
        alert('비밀번호가 다릅니다.');
        history.back();
      </script>
    ";
  }