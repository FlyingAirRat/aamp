<?php
    include_once "./header.php";
  include_once "db/db_class.php";
  
  if(isset($_SESSION['login_user'])){
    $login_user = $_SESSION['login_user'];
    $u_no = $login_user['u_no'];
    $u_lv = $login_user['u_lv'];
    $uid = $login_user['uid'];
    $upw = $login_user['upw'];
    $user_nm = $login_user['user_nm'];
    $class_no = $login_user['class_no'];
  }else{
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
  foreach($att_container as $item){
    $current_time = date("H:i:s");
      if($item['start_time'] <= $current_time &&
      $current_time <= $item['end_time']){
        $att_no = $item['att_no'];
        break;
      }
  }
  if($att_no === 0){
      $att_time = "현재 출석체크 시간이 아닙니다.<br>";
  }else{
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
</head>
<body>
    <div class="class">
    <div class='text'>
            <h2>수강중인 강의</h2>
            <span><?=$class_nm?><br></span>
            <span class='text_s'><?=$teacher_nm?> 선생님<br></span>
            <span><?=$att_time?></span>
    </div>
    <div class="contentarea">
        <div class="camera">
            <video id="video">Video stream not available.</video>
        </div>
        <div><button id="startbutton">사진 찍기</button></div>
        <canvas id="canvas"></canvas>
        <div class="output">
            <img id="photo" alt="The screen capture will appear in this box.">
        </div>
        <form name="img" method="POST" action="imgFire.php">
            <button class='buttons' id='sendbutton' type="submit" onclick="submitScore()">전송</button>
            <input type="hidden" id="u_no" name="u_no">
            <input type="hidden" id="imgsrc" name="imgsrc">
            <input type="hidden" id="att_no" name="att_no">
            <input type="hidden" id="class_no" name="class_no">
        </form>
    </div>
    <script>
    //앞으로 더 추가될지도?
    var photoBase64 = 0;

    /* JS comes here */
    (function() {
        var width = document.body.clientWidth*0.7;
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
                    console.log("에러가 발생했습니다: " + err);
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
                context.drawImage(video, 0, 0, video.width, video.height);

                var data = canvas.toDataURL('image/png');
                photo.setAttribute('src', data);
                
            } else {
                clearphoto();
            }
            photoBase64 = data;
            document.getElementById('u_no').value = <?=$u_no?>;
            document.getElementById('imgsrc').value = data;
            document.getElementById('att_no').value = <?=$att_no?>;
            document.getElementById('class_no').value = <?=$class_no?>;
            console.log(data);


        }

        function sendpicture(){
          
        }

        window.addEventListener('load', startup, false);
    })();
    </script>
</body>

</html> 