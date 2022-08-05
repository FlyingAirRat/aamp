<?php
if (isset($_GET['class_no']) && isset($_GET['att_no'])) {
    $class_no = $_GET['class_no'];
    $att_no = $_GET['att_no'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>알림 시간 수정</title>
</head>

<body>
    <div class="login_wrap">
        <div class="container">
            <h1>알림 시간 수정</h1>
            <h2>현재 수정 교시: <?=$att_no?>교시</h2>
            <form name="joinForm" action="edit_time_proc.php?att_no=<?= $att_no ?>" method="post">
                <div class="time">
                    <label>시작 시간<input type="time" name="start_time" value="00:00:00" step="1"></label>
                    <br>
                    <label>종료 시간<input type="time" name="end_time" value="00:00:00" step="1"></label>
                </div>
                <input type="hidden" name="class_no" value="<?= $class_no ?>">
                <div class="submit">
                    <input type="submit" value="수정" name="btnSubmit">
                </div>
            </form>
            <div class="login"><a href="class_detail.php?class_no=<?= $class_no ?>">돌아가기</a></div>
        </div>
    </div>
</body>

</html>