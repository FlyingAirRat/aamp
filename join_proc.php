<?php
    include_once "db/db_user.php";

    $u_lv = $_POST['u_lv'];
    $uid = $_POST['uid'];
    $upw = $_POST['upw'];
    $nm = $_POST['nm'];

    $param = [
        'u_lv' => $u_lv,
        'uid' => $uid,
        'upw' => $upw,
        'nm' => $nm,
    ];

    $result = ins_user($param);
    
    echo "<script type='text/javascript'>
        alret('회원가입 성공!');
        location.href='index.php';
    </script>";
?>

