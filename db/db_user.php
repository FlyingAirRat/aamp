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
    " SELECT u_no, u_lv, uid, upw, user_nm
      FROM info_user
      WHERE uid = '$uid'";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return mysqli_fetch_assoc($result);
  }

  function sel_stu(){
    $sql = 
    " SELECT u_no, user_nm
      FROM info_user
      WHERE u_lv = 2
      AND class_no IS NULL
      ORDER BY user_nm
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }

  function upd_stu(&$u_no){
    $sql1 =
    " SELECT MAX(class_no) as 'class_no'
      FROM class
    ";
    $conn = get_conn();
    $result1 = mysqli_query($conn, $sql1);
    print_r($result1);
    // $class_no = $result1['class_no'];

    // $sql2 = 
    // " UPDATE info_user
    //   SET class_no = $class_no
    //   WHERE u_no = $u_no
    // ";
    // mysqli_query($conn, $sql2);
    // mysqli_close($conn);
  }