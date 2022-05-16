<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>로그인</title>
</head>
<body>
    <div class="login_wrap">
        <h1>자동 출결 확인 시스템</h1>
        <div class="container">
            <h1>로그인</h1>
            <form action="login_proc.php" method="post">
                <div class="uid">
                    <h2>아이디</h2> 
                    <input type="text" name="uid" placeholder="아이디를 입력해주세요" maxlength="50"></div>
                <div class="upw">
                    <h2>비밀번호</h2>
                    <input type="password" name="upw" placeholder="비밀번호를 입력해주세요" minlength="8" maxlength="20"></div>
                <div class="submit">
                    <input type="submit" value="로그인">
                </div>
            </form>
            <div class="join"><a href="join.php">회원가입</a></div>
        </div>
    </div>
</body>
</html>
