<?php
include_once "./header.php";
include_once "./db/db_class.php";
if (isset($_GET['class_no'])) {
    $class_no = $_GET['class_no'];

    $param = [
        'class_no' => $class_no
    ];
    $result = sel_timetable($param);

    $class_info = sel_class_info($param);
    $class_nm = $class_info['class_nm'];
    $people = $class_info['people'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>알림시간 설정</title>
    <link rel="stylesheet" href="./class_detail.css">
</head>

<body>
    <header>
        <div id="cls_info"><a href="./class.php"><img src="./img/left.png"><span>수업 정보</span></a></div>
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
                    echo
                    " <tr>
                  <td>$att_no</td>
                  <td>$start_time ~ $end_time</td>
                  <td>
                    출석/$people
                    <form id='class' action='./list.php' method='POST'>
                      <input type='hidden' name='class_no' value='$class_no'>
                      <input type='hidden' name='att_no' value='$att_no'>
                      <input type='hidden' name='class_nm' value='$class_nm'>
                      <input type='hidden' name='people' value='$people'>
                      <input type='submit' value='현황보기'>
                    </form>
                  </td>
                </tr>
              ";
                    $att_no++;
                }
                ?>
            </table>
        </div>
        </div>
        <div id="plus_btn">
            <span>알림 시간 추가</span>
            <a href="./add_time.php?class_no=<?= $class_no ?>"><button>+</button></a>
        </div>
    </main>
    <script type="text/javascript">

    </script>
</body>

</html>