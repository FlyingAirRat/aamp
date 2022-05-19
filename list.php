<?php
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
    <div class="topbar">
        <div class="prevPage">
            <a href="class_detail.php?class_no=<?=$class_no?>&class_nm=<?=$class_nm?>&people=<?=$people?>">◀ 알림목록</a>
        </div>
        <div class="modPushtime">
            <a href="#">알림 시간 수정</a>
        </div>
    </div>
    <div class="container">
        <?php
            foreach($list as $item){
                $param['u_no'] = $item['u_no'];
                $att = sel_att_img($param);
                if(isset($att)){ 
                    $imgsrc = $att["imgsrc"];
                    $uploaded_time = $att["uploaded_time"];
                }else { 
                    $imgsrc = "./img/profile.png"; 
                    $uploaded_time = '0000-00-00 00:00:00';
                }
        ?>
            <div class="stuWrap">
                <ul>
                    <li class="attImg"><img src="<?=$imgsrc?>"></li>
                    <li class="stuName"><?=$item['user_nm']?></li>
                    <li class="uploadTime"><?=$uploaded_time?></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</body>
</html> 