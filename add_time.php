<?php
  if(isset($_GET['class_no'])){
    $class_no = $_GET['class_no'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./index.css">
  <title>알림 시간 추가</title>
</head>
<body>
<div class="login_wrap">
        <div class="container">
            <h1>알림 시간 추가</h1>
            <form name="joinForm" action="add_time_proc.php" method="post">
                <div class="time">
                    <label>시작 시간<input type="time" name="start_time" value="00:00:00"></label>
                    <label>종료 시간<input type="time" name="end_time" value="00:00:00"></label>
                </div>
                <input type="hidden" name="class_no" value="<?=$class_no?>">
                <div class="submit">
                    <input type="submit" value="추가" name="btnSubmit">
                </div>
            </form>
            <div class="login"><a href="class_detail.php?class_no=<?=$class_no?>">돌아가기</a></div>
        </div>
    </div>
</body>
</html>