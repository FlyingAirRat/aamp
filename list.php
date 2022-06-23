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
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('7e35ec0a379bddf815bb', {
            cluster: 'stu_img_fire'
        });
        var stu_img_info = "stu_img_sent/'+<?=$class_no.'/'.date('Y-m-d', time()).'/'.$att_no?>"
        var stu_img_reciever = pusher.subscribe(stu_img_info);
        stu_img_reciever.bind(stu_img_info, function(data) {
            //여기에 stu_img_info와 함께 실시간으로 받은 data를 어떻게 가공할 지 쓰자.
            
        });
    </script>
</head>

<body>
    <div class="topbar">
        <div class="prevPage">
            <a href="class_detail.php?class_no=<?= $class_no ?>&class_nm=<?= $class_nm ?>&people=<?= $people ?>"><img src="./img/left.png">알림목록</a>
        </div>
        <div class="modPushtime">
            <a href="#"><img src="./img/editing.png">알림 시간 수정</a>
        </div>
    </div>
    <div class="container">
        <?php
        foreach ($list as $item) {
            $param['u_no'] = $item['u_no'];
            $att = sel_att_img($param);
            if (isset($att)) {
                $imgsrc = "./userPic/" . $class_no . "/" . date("Y-m-d", time()) . "/" . $param['att_no'] . "/" . $item['u_no'] . ".png";
                $uploaded_time = $att["uploaded_time"];
            } else {
                $imgsrc = "./img/profile.png";
                $uploaded_time = '0000-00-00 00:00:00';
            };
        ?>
            <div class="stuWrap">
                <ul>
                    <li class="attImg"><img id="<?=$item['u_no']?>" src="<?= $imgsrc ?>"></li>
                    <li class="stuName"><?= $item['user_nm'] ?></li>
                    <li class="uploadTime"><?= $uploaded_time ?></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</body>

</html>