<?php
  include_once "db.php";

  function ins_user(&$param){
    $u_lv = $param['u_lv'];
    $uid = $param['uid'];
    $upw = $param['upw'];
    $nm = $param['nm'];
    $class_no = $param['class_no'];

    $sql =
    " INSERT INTO info_user
      (u_lv, uid, upw, user_nm, class_no)
      VALUES
      ($u_lv, '$uid', '$upw', '$nm', $class_no)
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }

  function sel_user(&$param){
    $uid = $param['uid'];
    $sql = 
    " SELECT u_no, u_lv, uid, upw, user_nm, class_no
      FROM info_user
      WHERE uid = '$uid'";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return mysqli_fetch_assoc($result);
  }
