<?php
  include_once "db.php";

  function sel_student_list(&$param){
    $sql = 
    "   SELECT user_nm
        FROM info_user
        WHERE class_no = {$param['class_no']}
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }

  function sel_att_img(&$param) {
    $sql =
    " SELECT imgsrc
      FROM stu_img
       
    "
  }
