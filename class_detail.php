<?php
  include_once "./db/db_class.php";
  $class_no = $_GET['class_no'];
  $class_nm = $_GET['class_nm'];
  $people = $_GET['people'];
  
  $param = [
    'class_no' => $class_no
  ];
  $result = sel_timetable($param);
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
    <div id="cls_info"><a href="./class.php"><</a> <span>수업 정보</span></div>
  </header>
  
  <main>
    <div id="cls_box">
      <span><?=$class_nm?><br></span>
      <span id="text_s">정원: <?=$people?>명</span>
      <img src="./img/star_b.png">
    </div>
    <div id="t_table">
        <table>
          <tr>
            <th>교시</th>
            <th>출석 유효 시간</th>
            <th>출석 인원</th>
          </tr>
          <?php
            while($row = mysqli_fetch_assoc($result)){
              $att_no = $row['att_no'];
              $start_time = $row['start_time'];
              $end_time = $row['end_time'];
              echo 
              " <tr>
                  <td>$att_no</td>
                  <td>$start_time ~ $end_time</td>
                  <td>
                    출석한 인원/$people
                    <form id='class' action='./list.php' method='POST'>
                      <input type='hidden' name='class_no' value='$class_no'>
                      <input type='hidden' name='att_no' value='$att_no'>
                      <input type='hidden' name='class_nm' value='$class_nm'>
                      <input type='hidden' name='people' value='$people'>
                      <input type='submit' value='>'>
                    </form>
                  </td>
                </tr>
              ";
            }
          ?>
        </table>
      </div>
    </div>
    <div id="plus_btn">
      <span>알림 시간 추가</span>
      <a href=""><button>+</button></a>
    </div>
  </main>
  <script type="text/javascript">

  </script>
</body>
</html>