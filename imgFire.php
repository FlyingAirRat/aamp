<?php
include_once "db/db.php";
require __DIR__ . '/vendor/autoload.php';







function imgFire(&$param)
{
    $img_base64 = $param["img_base64"];
    $u_no = $param["u_no"];
    $att_no = $param["att_no"];
    $class_no = $param["class_no"];

    $savedir = "./userPic/" . $class_no . "/" . date("Y-m-d", time()) . "/" . $att_no . "/";
    if (!file_exists($savedir)) {
        mkdir($savedir, 0777, true);
    }
    $src = explode(',', $img_base64);
    file_put_contents($savedir . $u_no . ".png", base64_decode($src[1]));

    $conn = get_conn();
    $sql =
        "   INSERT INTO stu_attended
        (u_no, att_no, class_no)
        VALUES
        ('$u_no', '$att_no', '$class_no')
        on DUPLICATE KEY UPDATE uploaded_time = current_timestamp();
    ";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

session_start();
$u_no = $_POST["u_no"];
$img_base64 = $_POST["img_base64"];
$att_no = $_POST["att_no"];
$class_no = $_POST["class_no"];
if ($img_base64 === 'undefined') {
    echo "사진이 첨부되지 않았습니다.";
    die;
}

$param = [
    "u_no" => $u_no,
    "img_base64" => $img_base64,
    "att_no" => $att_no,
    "class_no" => $class_no
];

$result = imgFire($param);
if ($result) {
    echo "<script>alert('등록되었습니다.');</script>";
} else {
    echo "<script>alert('사진이 등록되지 않았습니다. 관리자에게 문의해주세요.');</script><br>";
}

$options = array(
    'cluster' => 'stu_img_fire',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    '7e35ec0a379bddf815bb',
    '7cc5d44fd41e08a19672',
    '1427171',
    $options
);
$data['message'] = $img_base64;
$pusher->trigger("stu_img_sent/'+<?=$class_no.'/'.date('Y-m-d', time()).'/'.$att_no?>", 'imgSent', $data);
Header("Location: photo.php");
