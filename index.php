<?php
    function post($url, $fields)

    {
    
        $post_field_string = http_build_query($fields, '', '&');
    
        $ch = curl_init();                                                            // curl 초기화
    
        curl_setopt($ch, CURLOPT_URL, $url);                                 // url 지정하기
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);              // 요청결과를 문자열로 반환
    
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);               // connection timeout : 10초
    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                 // 원격 서버의 인증서가 유효한지 검사 여부
    
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);      // POST DATA
    
        curl_setopt($ch, CURLOPT_POST, true);                               // POST 전송 여부
    
        $response = curl_exec($ch);
    
        curl_close ($ch);
    
        return $response;
    
    }

    if(isset($_COOKIE['uid']) && isset($_COOKIE['upw'])){
        post('./login_proc.php', $_COOKIE['uid']);
        post('./login_proc.php', $_COOKIE['upw']);
        header("Location:./login_proc.php");
    }
    // if(isset($_SESSION['login_user']) && $_SESSION['login_user']['u_lv'] == 2){
    //     header("location: photo.php");
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>로그인</title>
</head>
<body>
    <div class="login_wrap">
        <h1>자동 출결 확인 시스템</h1>
        <div class="container">
            <h1>로그인</h1>
            <form action="login_proc.php" method="post">
                <div class="uid">
                    <h2>아이디</h2> 
                    <input type="text" name="uid" placeholder="아이디를 입력해주세요" maxlength="50"></div>
                <div class="upw">
                    <h2>비밀번호</h2>
                    <input type="password" name="upw" placeholder="비밀번호를 입력해주세요" minlength="8" maxlength="20"></div>
                <div class="auto_login">
                    <label><input type="checkbox" name="auto_login" value="1" checked>자동 로그인</label>
                </div>
                <div class="submit">
                    <input type="submit" value="로그인">
                </div>
            </form>
            <div class="join"><a href="join.php">회원가입</a></div>
        </div>
    </div>
</body>
</html>
