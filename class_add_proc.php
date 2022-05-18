<?php
  include_once "./db/db_class.php";
  $class_nm = $_POST['class_nm'];
  $stu_list = $_POST['stu'];
  $u_no = $_POST['u_no'];
  print_r($stu_list);

  // $param = [
  //   'class_nm' => $class_nm,
  //   'people' => $people,
  //   'u_no' => $u_no
  // ];
  // ins_class($param);
  // Header("Location: ./class.php");