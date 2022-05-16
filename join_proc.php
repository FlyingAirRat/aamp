<?php
    include_once "db/db_user.php";

    $u_lv = $_POST['level'];
    $uid = $_POST['uid'];
    $upw = $_POST['upw'];
    $nm = $_POST['nm'];

    $param = [
        'u_lv' => $u_lv,
        'uid' => $uid,
        'upw' => $upw,
        'nm' => $nm
    ];

    $result = ins_user($param);

    header("location: index.php");