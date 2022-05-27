<?php
include_once "./header.php";
include_once "db/db_class.php";

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
        alert('로그인 해주세요.');
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
$class_nm = $result['class_nm'];
$teacher_nm = $result['user_nm'];
?>

<head>
    <link rel="stylesheet" href="./photo.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="class">
        <div class='text'>
            <span>수업명: <?= $class_nm ?><br></span>
            <span class='text_s'>과목 담당: <?= $teacher_nm ?> 선생님<br></span>
            <span><?= $att_time ?></span>
        </div>
        <div class="contentarea">
            <div id="camera">
                <video id="video">Video stream not available.</video>
            </div>
            <div><button id="startbutton">사진 찍기</button></div>

            <canvas id="canvas"></canvas>
            <div id="output">
                <img id="photo" alt="The screen capture will appear in this box.">
            </div>
            <form name="img" method="POST" action="imgFire.php">
                <button class='buttons' id='sendbutton' type="submit" onclick="submitScore()">전송</button>
                <input type="hidden" id="u_no" name="u_no">
                <input type="hidden" id="imgsrc" name="imgsrc">
                <input type="hidden" id="att_no" name="att_no">
                <input type="hidden" id="class_no" name="class_no">
            </form>
            <div><button id="resetbutton">초기화</button></div>
        </div>
        <script>
            //앞으로 더 추가될지도?
            var photoBase64 = 0;

            (function() {
                var width = 320;
                var height = 320; // This will be computed based on the input stream

                var streaming = false;
                var photoTaken = false;

                var video = null;
                var canvas = null;
                var photo = null;
                var startbutton = null;

                function startup() {
                    video = document.getElementById('video');
                    canvas = document.getElementById('canvas');
                    photo = document.getElementById('photo');
                    startbutton = document.getElementById('startbutton');
                    sendbutton = document.getElementById('sendbutton');

                    photoTaken = true;
                    switchStreamMode();

                    videoStreamStart();

                    video.addEventListener('canplay', function(ev) {
                        if (!streaming) {
                            // height = video.videoHeight / (video.videoWidth / width);
                            var height = 320;
                            video.setAttribute('width', width);
                            video.setAttribute('height', height);
                            canvas.setAttribute('width', width);
                            canvas.setAttribute('height', height);
                            streaming = true;
                        }
                    }, false);

                    startbutton.addEventListener('click', function(ev) {
                        takepicture();
                        switchStreamMode();
                        ev.preventDefault();
                    }, false);
                    resetbutton.addEventListener('click', function(ev) {
                        switchStreamMode();
                        ev.preventDefault();
                    }, false);

                    clearphoto();
                }


                function clearphoto() {
                    var context = canvas.getContext('2d');
                    context.fillStyle = "#AAA";
                    context.fillRect(0, 0, canvas.width, canvas.height);

                    var data = canvas.toDataURL('image/png');
                    photo.setAttribute('src', data);
                    photo.style.display = 'none';
                }

                function takepicture() {
                    var context = canvas.getContext('2d');
                    if (width && height) {
                        canvas.width = width;
                        canvas.height = height;
                        context.drawImage(video, 0, 0, width, height);

                        var data = canvas.toDataURL('image/png');
                        photo.setAttribute('src', data);


                    } else {
                        clearphoto();
                    }
                    photoBase64 = data;
                    document.getElementById('u_no').value = <?= $u_no ?>;
                    document.getElementById('imgsrc').value = data;
                    document.getElementById('att_no').value = <?= $att_no ?>;
                    document.getElementById('class_no').value = <?= $class_no ?>;
                    console.log(data);


                }

                function sendpicture() {

                }

                function switchStreamMode() {
                    if (!photoTaken) {
                        photoTaken = true;
                        document.getElementById('camera').style.display = 'none';
                        startbutton.style.display = 'none';
                        sendbutton.style.display = 'inline-block';
                        photo.style.display = 'inline-block';
                        resetbutton.style.display = 'inline-block';
                        document.getElementById('output').style.display = 'inline-block';
                        stopStreamedVideo(video);
                    } else {
                        document.getElementById('camera').style.display = 'inline-block';
                        startbutton.style.display = 'block';
                        sendbutton.style.display = 'none';
                        photo.style.display = 'none';
                        resetbutton.style.display = 'none';
                        document.getElementById('output').style.display = 'none';
                        photoTaken = false;
                        videoStreamStart();
                    }
                }

                function stopStreamedVideo(video) {
                    const stream = video.srcObject;
                    const tracks = stream.getTracks();
                    tracks.forEach(function(track) {
                        track.stop();
                    });
                    video.srcObject = null;
                }

                function videoStreamStart() {
                    navigator.mediaDevices.getUserMedia({
                            video: {
                                width: 320,
                                height: 320
                            },
                            audio: false
                        })
                        .then(function(stream) {
                            video.srcObject = stream;
                            video.play();
                        })
                        .catch(function(err) {
                            console.log("에러가 발생했습니다: " + err);
                        });
                }

                window.addEventListener('load', startup, false);
                document.addEventListener("visibilitychange", handleVisibilityChange, false);

                function handleVisibilityChange() {
                    if (document.hidden) {
                        stopStreamedVideo(video);
                    }
                }
            })();
        </script>
</body>

</html>