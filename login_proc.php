<?php
include_once "./db/db_user.php";
session_start();
if (isset($_COOKIE['uid']) && isset($_COOKIE['upw'])) {
    $uid = $_COOKIE['uid'];
    $upw = $_COOKIE['upw'];
} else {
    $uid = $_POST['uid'];
    $upw = $_POST['upw'];
    $auto_login = isset($_POST['auto_login']) ? $_POST['auto_login'] : 0;
}
$param = [
    'uid' => $uid,
    'upw' => $upw
];

$result = sel_user($param);
if (empty($result)) {
    echo
    " <script>
        alert('해당하는 아이디가 없습니다.');
        history.back();
      </script>
    ";
    exit;
}


if ($result['upw'] === $upw) {
    if ($auto_login == "1") {
        setcookie('uid', $result['uid'], time() + 86400 * 30);
        setcookie('upw', $result['upw'], time() + 86400 * 30);
    }

    $_SESSION["login_user"] = $result;
    switch ($result['u_lv']) {
        case 0:
            Header("Location: admin.php");
            break;
        case 1:
            Header("Location: class.php");
            break;
        case 2:
            if (is_null($result['class_no'])) {
                Header("Location: main.php");
            } else {
                Header("Location: photo.php");
            }

            break;
    }
} else {
    echo
    " <script>
        alert('비밀번호가 다릅니다.');
        history.back();
      </script>
    ";
}
