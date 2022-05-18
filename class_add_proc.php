<?php
  include_once "./db/db_class.php";
  $class_nm = $_POST['class_nm'];
  $people = $_POST['people'];
  $u_no = $_POST['u_no'];

  echo $class_nm, $people, $u_no;
  // $param = [
  //   'class_nm' => $class_nm,
  //   'people' => $people,
  //   'u_no' => $u_no
  // ];
  // ins_class($param);
  // Header("Location: ./class.php");