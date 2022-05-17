<?php
  $class_no = $_GET['class_no'];
  echo $class_no;
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
    <div id="cls_info"><a href="./class.php"><</a> <span>수업정보</span></div>
  </header>
  
  <main>
    <div id="cls_box">
      <span>수업이름<br></span>
      <span id="text_s">정원: ㅇㅇ명</span>
      <img src="./img/star_b.png">
    </div>
    <div id="t_table">
        <table>
          <tr>
            <th>푸시 알림 유효 시간</th>
            <th>출석 인원</th>
          </tr>
          <tr>
            <td>09:20 ~ 09:25</td>
            <td>29/30 <a href="">></a></td>
          </tr>
          <tr>
          <td>10:20 ~ 10:25</td>
            <td>29/30 <a href="">></a></td>
          </tr>
          <tr>
            <td>11:20 ~ 11:25</td>
            <td>29/30 <a href="">></a></td>
          </tr>
          <tr>
            <td>12:20 ~ 12:25</td>
            <td>29/30 <a href="">></a></td>
          </tr>
        </table>
      </div>
    </div>
    <div id="plus_btn">
      <span>알림 시간 추가</span>
      <button>+</button>
    </div>
  </main>
  
</body>
</html>