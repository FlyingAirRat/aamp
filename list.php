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
            $i = 0;
            foreach($list as $item){
                $param['u_no'] = $item['u_no'];
                $result = sel_att_img($param);
                if($result != ""){
                    $att = mysqli_fetch_assoc($result);
                    $imgsrc = $att['imgsrc'];
                    $uploaded_time = $att['uploaded_time'];
                } else {
                    continue;
                }
        ?>
            <div class="stuWrap">
                <ul>
                    <li class="attImg"></li>
                    <li class="stuName"><?=$item['user_nm']?></li>
                    <li class="uploadTime"></li>
                </ul>
            </div>
            <script>
                let attImg = document.querySelectorAll('.attImg');
                let uploadTime = document.querySelectorAll('.uploadTime');

                if(<?php $att ?> == "") {
                    attImg[<?php $i ?>].innerHTML = '<img src="./img/profile.png">';
                    uploadTime[<?php $i ?>].innerHTML = '0000-00-00 00:00:00';
                } else {
                    attImg[<?php $i ?>].innerHTML = '<img src="<?php $imgsrc?>">';
                    uploadTime[<?php $i ?>].innerHTML = '<?php $uploaded_time ?>';
                }
            </script>
        <?php $i++; } ?>
    </div>
</body>
</html>