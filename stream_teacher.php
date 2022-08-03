<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>스트림</title>
    
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <script src="./stream_teacher.js"></script>
    <script src="videopipe.js"></script>
</head>

<body>
    <div id="app">
        <span id="myid"> </span>
        <video id="selfview"></video>
        <video id="remoteview"></video>
        <button id="endCall" style="display: none;" onclick="endCurrentCall()">End Call </button>
        <div id="list">
            <ul id="users">

            </ul>
        </div>
    </div>
    
</body>

</html>