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
            <form name="joinForm" action="join_proc.php" method="post">
                <div class="uid">
                    <h2>아이디</h2> 
                    <input type="email" name="uid" maxlength="50" required>
                    <span>아이디는 이메일 형식으로 작성해주세요.</span>
                </div>
                <div class="upw">
                    <h2>비밀번호</h2>
                    <input type="password" name="upw" minlength="8" maxlength="20" required>
                    <span>비밀번호는 8~20자 내외로 입력해주세요.</span>
                    <input type="password" name="upwConfirm" minlength="8" maxlength="20">
                    <span id="checkUpw">비밀번호를 다시 한 번 입력해주세요</span>
                </div>
                <div class="nm">
                    <h2>이름</h2>
                    <input type="text" name="nm" maxlength="20" required>
                </div>
                <div class="class">
                <?php
                    include_once "./db/db_class.php";
                    $level = $_POST['level'];
                    print $level;
                    if($level === 2){
                        print "222";
                        $result = sel_all_class();
                        print "<select name='class'>";
                        while($row = mysqli_fetch_assoc($result)){
                            $class_no = $row['class_no'];
                            $class_nm = $row['class_nm'];
                            print "<option value='$class_no'>$class_nm</option>";
                        }
                        print "</select>";
                    }
                ?>
                </div>
                <div class="submit">
                    <input type="submit" value="가입하기" name="btnSubmit">
                </div>
            </form>
            <div class="login"><a href="index.php">로그인</a></div>
        </div>
    </div>
    <script src="./join_form.js"></script>
</body>
</html>