<?php
include_once "./header.php";
include_once "./db/db_class.php";
$class_no = $login_user['class_no'];
$param = [
    'class_no' => $class_no,
];
$result = sel_class_set($param);
$class_nm = $result['class_nm'];
$teacher_nm = $result['user_nm']

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인화면</title>
</head>

<body>
    <main>
        <div class="class">
            수강중인 수업: <?= $class_nm ?> (<?= $teacher_nm ?> 선생님)
        </div>
        <div class="photo">
            <a href="photo.php"><button>사진 찍으러 가기</button></a>
        </div>
    </main>
</body>

</html>