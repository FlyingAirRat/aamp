<?php
include_once "header.php";
include_once "db/db_class.php";
require __DIR__ . '/vendor/autoload.php';

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
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <link rel="stylesheet" href="css/list.css">
    <title>목록</title>
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('7e35ec0a379bddf815bb', {
            cluster: 'ap3'
        });
        var stu_img_info = "stu_img_sent.<?= $class_no . '.'?>";
        
        var date = new Date();
        const formatDate = (date) => {
            let formatted_date =  date.getFullYear() + "-" + (date.getMonth()<10 ? "0" + (date.getMonth() + 1) : date.getMonth()+ 1) + "-" +(date.getDate()<10 ? "0" + (date.getDate()) : date.getDate());
            console.log(formatted_date);
            return formatted_date;
        }
        stu_img_info += formatDate(date) + '<?='.'.$param['att_no']?>';
        var channel_stu_img_reciever = pusher.subscribe(stu_img_info);
        console.log(stu_img_info);
        channel_stu_img_reciever.bind('img_sent', function(data) {
            console.log('1');
            //여기에 stu_img_info와 함께 실시간으로 받은 data를 어떻게 가공할 지 쓰자.
            var data_parsed = JSON.stringify(data);
            data_parsed = JSON.parse(data_parsed);
            console.log(data);
            document.getElementById(data_parsed.who).src = data_parsed.img_src+ "?" + Math.random();
            
        });
    </script>
</head>

<body>
    <div class="topbar">
        <div class="prevPage">
            <a href="class_detail.php?class_no=<?= $class_no ?>&class_nm=<?= $class_nm ?>&people=<?= $people ?>"><img src="./img/left.png">알림목록</a>
        </div>
        <div class="modPushtime">
            <a href="edit_time.php?class_no=<?=$param['class_no']?>&att_no=<?=$param['att_no']?>"><img src="./img/editing.png">알림 시간 수정</a>
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
                <ul style="padding-left: 0px; padding-top: 25px;">
                    <li class="attImg"><img id="<?=$param['u_no']?>" src="<?= $imgsrc ?>" name="u_no"></li>
                    <li class="stuName"><?= $item['user_nm'] ?></li>
                    <li class="uploadTime"><?= $uploaded_time ?></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</body>

</html>