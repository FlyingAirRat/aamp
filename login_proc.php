<?php
  include_once "db/db_user.php";
  $uid = $_POST['uid'];
  $upw = $_POST['upw'];

  $param = [
    'uid' => $uid
  ];

  $result = sel_user($param);
  if(empty($result)){
    echo "<script>
            alert('해당하는 아이디가 없습니다.');
            history.back();
          </script>";
    exit;
  }
  
  if($result['upw'] === $upw){
    echo "<script>
            alert('비밀번호가 다릅니다.');
            history.back();
          </script>";
  }else{
    session_start();
    $_SESSION["login_user"] = $result;
    echo "로그인 성공";
    // switch($result['u_lv']){
    //   case 1:
    //     Header("Location: 메인1");
    //     break;
    //   case 2:
    //     Header("Location: 메인2");
    //     break;
    //   case 3:
    //     Header("Location: 메인3");
    //     break;
    // }
  }