<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>회원가입</title>
</head>
<body>
    <div class="login_wrap">
        <h1>자동 출결 확인 시스템</h1>
        <div class="container">
            <h1>회원가입</h1>
            <form action="join_proc.php" method="post">
                <div class="level">
                    <label><input type="radio" name="level" value="1" checked> 선생님</label>
                    <label><input type="radio" name="level" value="2"> 학생</label>
                    <label><input type="radio" name="level" value="0"> 관리자</label>
                </div>
                <div class="uid">
                    <h2>아이디</h2> 
                    <input type="email" name="uid" maxlength="50" required>
                    <span>아이디는 이메일 형식으로 작성해주세요.</span>
                </div>
                <div class="upw">
                    <h2>비밀번호</h2>
                    <input type="password" name="upw" minlength="8" maxlength="20" required>
                    <span>비밀번호는 8~20자 내외로 입력해주세요.</span>
                    <input type="password" name="upw" minlength="8" maxlength="20" required>
                    <span>비밀번호를 다시 한 번 입력해주세요.</span>
                </div>
                <div class="nm">
                    <h2>이름</h2>
                    <input type="text" name="nm" maxlength="20" required>
                </div>
                <div class="submit">
                    <input type="submit" value="가입하기">
                </div>
            </form>
            <div class="login"><a href="login.php">로그인</a></div>
        </div>
    </div>
</body>
</html>