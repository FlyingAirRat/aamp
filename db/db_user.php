<?php
  include_once "db.php";

  function ins_user(&$param){
    $u_lv = $param['u_lv'];
    $uid = $param['uid'];
    $upw = $param['upw'];
    $nm = $param['nm'];

    $sql =
    " INSERT INTO info_user
      (u_lv, uid, upw, user_nm)
      VALUES
      ('$u_lv', '$uid', '$upw', '$nm')
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return $result;
  }

  function sel_user(&$param){
    $uid = $param['uid'];
    $sql = 
    " SELECT u_no, u_lv, uid, upw, user_nm
      FROM info_user
      WHERE uid = '$uid'";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return mysqli_fetch_assoc($result);
  }
