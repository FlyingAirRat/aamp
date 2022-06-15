<?php
echo("
<script>
var photoBase64 = 0;

(function() {
    var width = 320;
    var height = 320;

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
        context.fillStyle = '#AAA';
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
        document.getElementById('img_base64').value = data;
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
");