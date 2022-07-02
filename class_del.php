<?php
include_once "db/db_class.php";
include_once "db/db_user.php";
$class_no = $_POST['class_no'];

$param = [
    'class_no' => $class_no
];
del_class($param);

Header("Location: ./class.php");
