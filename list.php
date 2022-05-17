<?php
    session_start();
    include_once "header.php";
    include_once "db/db_class.php";
    $param = [
        'class_no' => $_POST['class_no'],
        'att_no' => $_POST['att_no']
    ];
    $list = sel_att_img($param);
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
        <a href="class_detail.php">◀ 알림목록</a>
        <a href="#">알림 시간 수정</a>
    </div>
    <div class="container">
        <?php
            foreach($list as $item){
        ?>
            <div class="stuWrap">
                <ul>
                    <li class="attImg"><img src="<?=$item['imgsrc']?>"></li>
                    <li class="stuName"><?=$item['user_nm']?></li>
                    <li class="stuName"><?=$item['uploaded_time']?></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</body>
</html>