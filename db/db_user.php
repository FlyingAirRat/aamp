<?php
  include_once "db.php";

  function sel_user(&$param){
    $uid = $param['uid'];
    $sql = 
    " SELECT u_no, u_lv, uid, upw, user_nm
      FROM info_user
      WHERE uid = $uid";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return mysqli_fetch_assoc($result);
  }