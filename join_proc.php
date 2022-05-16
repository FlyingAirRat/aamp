<?php
    include_once "db/db_user.php";

    $param = [
        'u_lv' => $_POST['level'],
        'uid' => $_POST['uid'],
        'upw' => $_POST['upw'],
        'nm' => $_POST['nm']
    ];

    $result = ins_user($param);

    header("location: index.html");