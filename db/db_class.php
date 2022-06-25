<?php
include_once "db.php";

//add_time_proc 추가
function ins_time(&$param)
{
    $start_time = $param['start_time'];
    $end_time = $param['end_time'];
    $class_no = $param['class_no'];

    $sql1 =
        " SELECT max(att_no) + 1 as new_att
      FROM class_timetable
      WHERE class_no = '$class_no'
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql1);
    $att_no = mysqli_fetch_assoc($result);
    $new_att = $att_no['new_att'];

    $sql2 =
        " INSERT INTO class_timetable
      (class_no, att_no, start_time, end_time)
      VALUES
      ('$class_no', $new_att, '$start_time', '$end_time')
    ";
    mysqli_query($conn, $sql2);
}

function sel_all_class()
{
    $sql =
        " SELECT class_no, class_nm
      FROM class
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function sel_class_list(&$param)
{
    $u_no = $param['u_no'];
    $sql =
        " SELECT class_nm, people, class_no
      FROM class
      WHERE u_no = $u_no
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}
//수정
function sel_timetable(&$param)
{
    $class_no = $param['class_no'];
    $sql =
        " SELECT start_time, end_time
      FROM class_timetable
      WHERE class_no = $class_no
      ORDER BY start_time
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function sel_stu_list(&$param)
{
    $sql =
        " SELECT user_nm, u_no
      FROM info_user
      WHERE class_no = {$param['class_no']}
      ORDER BY user_nm
    ";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function sel_att_img(&$param)
{
    $sql =
        " SELECT uploaded_time
      FROM stu_attended
      WHERE class_no = {$param['class_no']} 
        AND att_no = {$param['att_no']}
        AND u_no = {$param['u_no']}
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return mysqli_fetch_assoc($result);
}

function sel_class_set(&$param)
{
    $class_no = $param['class_no'];
    $sql =
        " SELECT A.class_nm, B.user_nm
      FROM class A
      INNER JOIN info_user B
      ON A.u_no = B.u_no
      WHERE A.class_no = $class_no";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return mysqli_fetch_assoc($result);
}

function get_att(&$param)
{
    $class_no = $param['class_no'];
    $sql =
        " SELECT A.class_no, A.att_no, A.start_time, A.end_time, B.class_nm
      FROM class_timetable A
      INNER JOIN class B
      ON A.class_no = B.class_no
      WHERE A.class_no = $class_no";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

//class_detail 추가
function sel_class_info(&$param)
{
    $class_no = $param['class_no'];
    $sql =
        " SELECT A.class_nm, A.class_no, A.people, B.class_no, B.att_no
      FROM class A LEFT OUTER JOIN stu_attended B
      ON A.class_no = B.class_no
      WHERE A.class_no = $class_no
    ";
    //stu_attended 테이블이 비어있을 때 INNER JOIN을 사용하면, class.people을 가져오지 못한다.
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return mysqli_fetch_assoc($result);
}

function sel_every_class_info()
{
    $sql = "SELECT class_no, class_nm, u_no, people, favor
    FROM class";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function count_attended_students(&$param_att, &$param2_clsno)
{
    $sql = "SELECT count(*) as attstu
    FROM stu_attended
    WHERE att_no = $param_att and class_no = $param2_clsno";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    //사진 안 올린 교시에 대한, 널 들어오면 어떻게 해야하는지를 구현하자.
    mysqli_close($conn);
    $return_value = json_encode(mysqli_fetch_assoc($result));
    return $return_value;
}