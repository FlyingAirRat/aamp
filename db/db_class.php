<?php
  include_once "db.php";

  function sel_class_list(&$param){
    $u_no = $param['u_no'];
    $sql = 
    " SELECT class_nm, people, class_no
      FROM class
      WHERE u_no = $u_no
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }

  function sel_timetable(&$param){
    $class_no = $param['class_no'];
    $sql = 
    " SELECT att_no, start_time, end_time
      FROM class_timetable
      WHERE class_no = $class_no
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }

  function sel_stu_list(&$param) {
    $sql =
    " SELECT user_nm
      FROM info_user
      WHERE class_no = {$param['class_no']}
      ORDER BY user_nm ASC
    ";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }

  function sel_att_img(&$param) {
    $sql =
    " SELECT A.imgsrc, B.user_nm, A.uploaded_time
      FROM stu_img A
        INNER JOIN info_user B
              ON A.u_no = B.u_no
      WHERE class_no = {$param['class_no']} 
        AND att_no = {$param['att_no']}
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }