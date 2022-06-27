<?php
if (isset($_SESSION['login_user'])) {
    $login_user = $_SESSION['login_user'];
    $u_no = $login_user['u_no'];
    $u_lv = $login_user['u_lv'];
    $uid = $login_user['uid'];
    $upw = $login_user['upw'];
    $user_nm = $login_user['user_nm'];
    $class_no = $login_user['class_no'];
} else {
    echo
    " <script>
        location.href='index.php';
      </script>
    ";
    exit;
}

date_default_timezone_set('Asia/Seoul');
$att_container = get_att($login_user);

$att_no = 0;
$att_time = "";
foreach ($att_container as $item) {
    $current_time = date("H:i:s");
    if (
        $item['start_time'] <= $current_time &&
        $current_time <= $item['end_time']
    ) {
        $att_no = $item['att_no'];
        break;
    }
}
if ($att_no === 0) {
    $att_time = "현재 출석체크 시간이 아닙니다.<br>";
} else {
    $att_time = "현재 {$att_no}교시 진행중<br>";
}

$param = [
    'class_no' => $class_no,
];
$result = sel_class_set($param);
define("CLASS_NM", $result['class_nm']);
define("TEACHER_NM", $result['user_nm']);
