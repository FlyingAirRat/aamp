<?php

function imgFire(&$param) {
    $imgsrc = $param["imgsrc"];
    $u_no = $param["u_no"];
    $att_no = $param["att_no"];
    $class_no = $param["class_no"];

    $conn = get_conn();
    $sql = 
    "   INSERT INTO stu_img 
        (u_no, imgsrc, att_no, class_no)
        VALUES
        ('$u_no', '$imgsrc', '$att_no', '$class_no')
        on DUPLICATE KEY UPDATE imgsrc = '$imgsrc', uploaded_time = current_timestamp();
    ";        
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

    include_once "db/db.php";
    session_start();
    $u_no = $_POST["u_no"];
    $imgsrc = $_POST["imgsrc"];
    $att_no = $_POST["att_no"];
    $class_no = $_POST["class_no"];
    if($imgsrc === 'undefined'){
        echo "사진이 첨부되지 않았습니다.";
        die;
    }
    
    $param = [
        "u_no" => $u_no,
        "imgsrc" => $imgsrc,
        "att_no" => $att_no,
        "class_no" => $class_no
    ];

    $result = imgFire($param);
    if($result) {
        Header("Location: photo.php");
    }