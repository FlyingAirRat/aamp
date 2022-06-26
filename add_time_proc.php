<?php
include_once "db/db_class.php";
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$class_no = $_POST['class_no'];

$param = [
    'start_time' => $start_time,
    'end_time' => $end_time,
    'class_no' => $class_no
];
ins_time($param);
header("Location: class_detail.php?class_no=$class_no");
