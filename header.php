<?php
session_start();
if (isset($_SESSION['login_user'])) {
    $login_user = $_SESSION['login_user'];
    $u_lv = $login_user['u_lv'];
    $user_nm = $login_user['user_nm'];

    $lv_nm = "";
    switch ($u_lv) {
        case 0:
            $lv_nm = "관리자";
            break;
        case 1:
            $lv_nm = "선생님";
            break;
        case 2:
            $lv_nm = "학생";
            break;
    }
} else {
    echo
    " <script>
        location.href='index.php';
      </script>
    ";
    exit;
}

?>
<!DOCTYPE html>
<link rel="stylesheet" href="css/header.css">
<header>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div id="log">
        <?= $user_nm ?>(<?= $lv_nm ?>), 안녕하세요.
        <a href="logout.php" tabindex="-1"><button id="bruh">로그아웃</button></a>
    </div>
</header>