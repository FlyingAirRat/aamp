<?php
include_once "db/db.php";
function del_img(&$param)
{
    // $uuid = $param["uuid"];
    $del_img_id = $param["del_img_id"];

    $conn = get_conn();
    $sql =
        "DELETE from stu_img WHERE img_id = '$del_img_id';
    ";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}


session_start();
$del_img_id = $_POST["del_img_id"];

$param = [
    "del_img_id" => $del_img_id
];

$result = del_img($param);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    삭제완료
</body>

</html>