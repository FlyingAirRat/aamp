<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>회원구분</title>
</head>
<body>
    <div class="login_wrap">
        <h1>자동 출결 확인 시스템</h1>
        <div class="container">
            <h1>회원구분</h1>
            <form name="joinForm" action="join.php" method="post">
                <div class="level">
                    <label><input type="radio" name="level" value="1" checked> 선생님</label>
                    <label><input type="radio" name="level" value="2"> 학생</label>
                    <label><input type="radio" name="level" value="0"> 관리자</label>
                </div>
                <div class="submit">
                    <input type="submit" value="다음" name="btnSubmit">
                </div>
            </form>
            <div class="login"><a href="index.php">로그인</a></div>
        </div>
    </div>
    <script src="./join_form.js"></script>
</body>
</html>