<?php
include_once "./db/db_class.php";
include_once "./db/db_user.php";
$class_nm = $_POST['class_nm'];
$stu_list = $_POST['stu'];
$u_no = $_POST['u_no'];
$people = count($stu_list);

$param = [
    'class_nm' => $class_nm,
    'people' => $people,
    'u_no' => $u_no
];
ins_class($param);

for ($i = 0; $i < $people; $i++) {
    upd_stu($stu_list[$i]);
}

Header("Location: ./class.php");
