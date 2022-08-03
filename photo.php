<?php
include_once "header.php";
include_once "db/db_class.php";
include_once "photo_session_check.php";
?>

<head>
    <link rel="stylesheet" href="css/photo.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="class">
        <div class='text'>
            <span>수업명: <?= CLASS_NM ?><br></span>
            <span class='text_s'>과목 담당: <?= TEACHER_NM ?> 선생님<br></span>
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
                <input type="hidden" id="img_base64" name="img_base64">
                <input type="hidden" id="att_no" name="att_no">
                <input type="hidden" id="class_no" name="class_no">
            </form>
            <div><button id="resetbutton">초기화</button></div>
        </div>
        <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
        <script>
            //webRTC 소스
            let photoBase64 = 0;

            (function() {
                let width = 320;
                let height = 320;

                let streaming = false;
                let photoTaken = false;

                let video = null;
                let canvas = null;
                let photo = null;
                let startbutton = null;

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
                            let height = 320;
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
                    let context = canvas.getContext('2d');
                    context.fillStyle = '#AAA';
                    context.fillRect(0, 0, canvas.width, canvas.height);

                    let data = canvas.toDataURL('image/png');
                    photo.setAttribute('src', data);
                    photo.style.display = 'none';
                }

                function takepicture() {
                    let context = canvas.getContext('2d');
                    let data = ""; //추가함.

                    if (width && height) {
                        canvas.width = width;
                        canvas.height = height;
                        context.drawImage(video, 0, 0, width, height);

                        // let data = canvas.toDataURL('image/png');
                        data = canvas.toDataURL('image/png');
                        photo.setAttribute('src', data);
                    } else {
                        clearphoto();
                    }
                    photoBase64 = data;
                    // var를 let으로 바꾸는 작업 중, 위의 if문 안에서 처음 선언된 var까지
                    // let으로 바꿔버려서, if문 밖의 photoBase64에 data값을 넣어주지 못하는
                    // 상황을 이해 못하고 몇 시간이고 삽질했었다. 지금보면 바보같은 실수.

                    document.getElementById('u_no').value = <?= $u_no ?>;
                    document.getElementById('img_base64').value = data;
                    document.getElementById('att_no').value = <?= $att_no ?>;
                    document.getElementById('class_no').value = <?= $class_no ?>;
                    console.log(data);


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
                            console.log('에러가 발생했습니다: ' + err);
                        });
                }

                window.addEventListener('load', startup, false);
                document.addEventListener('visibilitychange', handleVisibilityChange, false);

                function handleVisibilityChange() {
                    if (document.hidden) {
                        stopStreamedVideo(video);
                    }
                }
            })();
        </script>
</body>

</html>