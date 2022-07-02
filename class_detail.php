<?php
include_once "header.php";
include_once "db/db_class.php";
if (isset($_GET['class_no'])) {
    $class_no = $_GET['class_no'];

    $param = [
        'class_no' => $class_no
    ];
    $result = sel_timetable($param);

    $class_info = sel_class_info($param);
    if (isset($class_info['class_nm']) && isset($class_info['people'])) {
        $class_nm = $class_info['class_nm'];
        $people = $class_info['people'];
    } else {
        $class_nm = 0;
        $people = 0;
    };
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>알림시간 설정</title>
    <link rel="stylesheet" href="css/class_detail.css">
</head>

<body>
    <header>
        <script src="./class_detail.js"></script>
        <div id="cls_info">
            <a href="./class.php" id="back"><img src="./img/left.png"><span>수업 정보</span></a>
            <a href="#" id="classDel"><img src="./img/right.png"><span>삭제</span></a>
        </div>
        <form action="./class_del.php" method="POST">
            <input type='hidden' name='class_no' value='<?= $class_no ?>'>
            <input type='submit' id='classDelSubmit' value=''>
        </form>
    </header>

    <main>
        <div id="t_table">
            <table>
                <tr>
                    <th>교시</th>
                    <th>출석 유효 시간</th>
                    <th>출석 인원</th>
                </tr>
                <?php
                $att_no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $start_time = $row['start_time'];
                    $end_time = $row['end_time'];
                    // $att_no = $row['att_no'];
                ?>
                    <tr>
                        <td><?= $att_no ?></td>
                        <td><?= $start_time ?> ~ <?= $end_time ?></td>
                        <td>
                            출석
                            <?php
                            $stu_att_counter = json_decode(count_attended_students($att_no, $class_no));
                            echo $stu_att_counter->attstu;
                            ?>/<?= $people ?>
                            <form id='class' action='./list.php' method='POST'>
                                <input type='hidden' name='class_no' value='<?= $class_no ?>'>
                                <input type='hidden' name='att_no' value='<?= $att_no ?>'>
                                <input type='hidden' name='class_nm' value='<?= $class_nm ?>'>
                                <input type='hidden' name='people' value='<?= $people ?>'>
                                <input type='submit' value='현황보기'>
                            </form>
                        </td>
                    </tr>
                <?php $att_no += 1;
                }
                //바로 윗줄 <?php를 <?=로 적어서 $att_no가 문서 내에 찍혔었다. 고생깨나 했네.
                ?>
            </table>
        </div>
        </div>
        <div id="plus_btn">
            <span>알림 시간 추가</span>
            <form action="./add_time.php" method="POST">
                <input type='hidden' name='class_no' value='<?= $class_no ?>'>
                <input type='submit' value='+'>
            </form>
        </div>
    </main>
</body>

</html>