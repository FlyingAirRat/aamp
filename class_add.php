<?php
include_once "./db/db_user.php";
session_start();
if (isset($_SESSION['login_user'])) {
    $login_user = $_SESSION['login_user'];
    $u_no = $login_user['u_no'];
} else {
    echo
    " <script>
        alert('로그인 해주세요.');
        location.href='index.php';
      </script>
    ";
    exit;
}
$result = sel_stu();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>수업 추가</title>
</head>

<body>
    <div class="login_wrap">
        <div class="container">
            <h1>수업 추가</h1>
            <form action="class_add_proc.php" method="post">
                <div class="class_nm">
                    <h2>수업명</h2>
                    <input type="text" name="class_nm" placeholder="수업명을 입력해주세요" maxlength="50" required>
                </div>
                <div class="people">
                    <h2>수강 인원</h2>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $u_no_stu = $row['u_no'];
                        $user_nm = $row['user_nm'];
                        print "<label><input type='checkbox' name='stu[]' value='$u_no_stu'>$user_nm($u_no_stu)</label> ";
                    }
                    ?>
                    <input type="hidden" name="u_no" value="<?= $u_no ?>">
                    <div class="submit">
                        <input type="submit" value="추가">
                    </div>
            </form>
            <div class="back"><a href="class.php">돌아가기</a></div>
        </div>
    </div>
</body>

</html>