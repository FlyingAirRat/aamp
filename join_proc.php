<?php
    include_once "db/db_user.php";

    $uid = $_POST['uid'];
    $upw = $_POST['upw'];
    $nm = $_POST['nm'];
    $class_selection = $_POST['class_selection'];

    $param = [
        'uid' => $uid,
        'upw' => $upw,
        'nm' => $nm,
        'class_selection' => $class_selection,
    ];

    $result = ins_user($param);
    
    header("location: index.php");
