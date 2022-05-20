<?php
    include_once "db/db_user.php";

    $uid = $_POST['uid'];
    $upw = $_POST['upw'];
    $nm = $_POST['nm'];

    $param = [
        'uid' => $uid,
        'upw' => $upw,
        'nm' => $nm,
    ];

    $result = ins_user($param);
    
    header("location: index.php");

?>

