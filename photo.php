<?php
  session_start();
  if(isset($_SESSION['login_user'])){
    $login_user = $_SESSION['login_user'];
    $u_no = $login_user['u_no'];
    $u_lv = $login_user['u_lv'];
    $uid = $login_user['uid'];
    $upw = $login_user['upw'];
    $user_nm = $login_user['user_nm'];
  }else{
    echo 
    " <script>
        alert('로그인 해주세요.');
        location.href='index.html';
      </script>
    ";
    exit;
  }
  echo "u_no: $u_no, u_lv: $u_lv, uid: $uid, upw: $upw, user_nm: $user_nm";
  ?>
  <head>
    <style>
    /* CSS comes here */
    #video {
        border: 1px solid black;
        width: 320px;
        height: 240px;
    }

    #photo {
        border: 1px solid black;
        width: 320px;
        height: 240px;
    }

    #canvas {
        display: none;
    }

    .camera {
        width: 340px;
        display: inline-block;
    }

    .output {
        width: 340px;
        display: inline-block;
    }

    #startbutton {
        display: block;
        position: relative;
        margin-left: auto;
        margin-right: auto;
        bottom: 36px;
        padding: 5px;
        background-color: #6a67ce;
        border: 1px solid rgba(255, 255, 255, 0.7);
        font-size: 14px;
        color: rgba(255, 255, 255, 1.0);
        cursor: pointer;
    }
    #sendbutton {
        display: block;
        position: relative;
        margin-left: auto;
        margin-right: auto;
        bottom: 36px;
        padding: 5px;
        background-color: #6a67ce;
        border: 1px solid rgba(255, 255, 255, 0.7);
        font-size: 14px;
        color: rgba(255, 255, 255, 1.0);
        cursor: pointer;
    }

    .contentarea {
        font-size: 16px;
        font-family: Arial;
        text-align: center;
    }
    </style>
    <title>My Favorite Sport</title>
</head>

<body>
    <div class="contentarea">
        <h1>
            자바스크립트로 사진 캡쳐하기
        </h1>
        <div class="camera">
            <video id="video">Video stream not available.</video>
        </div>
        <div><button id="startbutton">Take photo</button></div>
        <canvas id="canvas"></canvas>
        <div class="output">
            <img id="photo" alt="The screen capture will appear in this box.">
        </div>
        <form name="img" method="POST" action="imgFire.php">
      <button class='buttons' id='sendbutton' type="submit" onclick="submitScore()">SUBMIT</button>
      <input type="hidden" id="u_no" name="u_no">
      <input type="hidden" id="imgsrc" name="imgsrc">
    </form>
    <br><br>
    <form name="showImage" method="POST" action="showImage.php">
      <legend>조회할 이미지의 id를 입력하세요.</legend>
      <input type="number" name="img_id">
      <button type="submit">이미지 조회</button>
    </form>
    <form name="deleteImage" method="POST" action="deleteImage.php">
      <legend>삭제할 이미지의 id를 입력하세요.</legend>
      <input type="number" name="del_img_id">
      <button type="submit">이미지 삭제</button>
    </form>
    </div>
    
    
    

    <script>

    var photoBase64 = 0;

    /* JS comes here */
    (function() {

        var width = 320; // We will scale the photo width to this
        var height = 0; // This will be computed based on the input stream

        var streaming = false;

        var video = null;
        var canvas = null;
        var photo = null;
        var startbutton = null;

        function startup() {
            video = document.getElementById('video');
            canvas = document.getElementById('canvas');
            photo = document.getElementById('photo');
            startbutton = document.getElementById('startbutton');

            navigator.mediaDevices.getUserMedia({
                    video: true,
                    audio: false
                })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function(err) {
                    console.log("An error occurred: " + err);
                });

            video.addEventListener('canplay', function(ev) {
                if (!streaming) {
                    height = video.videoHeight / (video.videoWidth / width);

                    if (isNaN(height)) {
                        height = width / (4 / 3);
                    }

                    video.setAttribute('width', width);
                    video.setAttribute('height', height);
                    canvas.setAttribute('width', width);
                    canvas.setAttribute('height', height);
                    streaming = true;
                }
            }, false);

            startbutton.addEventListener('click', function(ev) {
                takepicture();
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
            document.getElementById('u_no').value = 1;
            document.getElementById('imgsrc').value = data;
            console.log(data);


        }

        function sendpicture(){
          
        }

        window.addEventListener('load', startup, false);
    })();
    console.log(photoBase64);
    </script>
</body>

</html> 