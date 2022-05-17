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