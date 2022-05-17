<?php
    include_once "db/db_user.php";

    $u_lv = $_POST['u_lv'];
    $uid = $_POST['uid'];
    $upw = $_POST['upw'];
    $nm = $_POST['nm'];
    $class_no = $_POST['class_no'];

    $param = [
        'u_lv' => $u_lv,
        'uid' => $uid,
        'upw' => $upw,
        'nm' => $nm,
        'class_no' => $class_no
    ];

    $result = ins_user($param);

    header("location: index.php");