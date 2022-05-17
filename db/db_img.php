<?php
  include_once "db.php";

  function sel_list(){
    $sql = 
    "   SELECT A.imgsrc, B.user_nm
        FROM stu_img A
        INNER JOIN info_user B
            ON A.u_no = B.u_no
        WHERE uploaded_time BETWEEN 
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }