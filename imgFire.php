<?php

function imgFire(&$param) {
    $imgsrc = $param["imgsrc"];

    $conn = get_conn();
    $sql = 
    "   INSERT INTO stu_img 
        (u_no, imgsrc)
        VALUES
        (1, '$imgsrc')
    ";        
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

    include_once "db/db.php";
    session_start();
    $u_no = $_POST["u_no"];
    $imgsrc = $_POST["imgsrc"];
    if($imgsrc === 'undefined'){
        echo "사진이 첨부되지 않았습니다.";
        die;
    }
    
    $param = [
        "u_no" => $u_no,
        "imgsrc" => $imgsrc
    ];

    $result = imgFire($param);
    if($result) {
        Header("Location: photo.php");
    }