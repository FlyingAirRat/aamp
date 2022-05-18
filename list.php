<?php
    session_start();
    include_once "header.php";
    include_once "db/db_class.php";

    $class_no = $_POST['class_no'];
    $class_nm = $_POST['class_nm'];
    $people = $_POST['people'];

    $param = [
        'class_no' => $class_no,
        'att_no' => $_POST['att_no']
    ];

    $list = sel_stu_list($param);
    $img_list = sel_att_img($param);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./list.css">
    <title>목록</title>
</head>
<body>
    <div class="prevPage">
        <a href="class_detail.php?class_no=<?=$class_no?>&class_nm=<?=$class_nm?>&people=<?=$people?>">◀ 알림목록</a>
        <a href="#">알림 시간 수정</a>
    </div>
    <div class="container">
        <?php
            foreach($list as $item){
                $user_nm = $item['user_nm'];
        ?>
            <div class="stuWrap">
                <ul>
                    <li class="attImg"><img src="./img/profile.png"></li>
                    <li class="stuName"><?=$user_nm?></li>
                    <li class="uploadTime"></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</body>
</html>

<script src=""></script>