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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div id="log">
        <?= $user_nm ?>(<?= $lv_nm ?>), 안녕하세요.
        <a href="logout.php" tabindex="-1"><button id="bruh">로그아웃</button></a>
    </div>
</header>