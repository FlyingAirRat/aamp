
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>메인화면</title>
  <link rel="stylesheet" href="./class.css">
</head>
<body>
  <?php include_once "header.php";?> 
  <main>
    <div id="list_head">
      강의목록
      <hr>
    </div>

    <div id="list_body">
      <div class="list_box">
        <img src="./img/hambg.png" class="hambg">
        <div class="text">
          <span>ABCD EFGHIJK LMNOP 취업반<br></span>
          <span class="text_s">총 인원수 NN명</span>
        </div>
        <img src="./img/star.jpeg" class="star">
      </div>
      <div class="list_box">
        <img src="./img/hambg.png" class="hambg">
        <div class="text">
          <span>ABCD EFGHIJK LMNOP 취업반<br></span>
          <span class="text_s">총 인원수 NN명</span>
        </div>
        <img src="./img/star.jpeg" class="star">
      </div>
      <div class="list_box">
        <img src="./img/hambg.png" class="hambg">
        <div class="text">
          <span>ABCD EFGHIJK LMNOP 취업반<br></span>
          <span class="text_s">총 인원수 NN명</span>
        </div>
        <img src="./img/star.jpeg" class="star">
      </div>
    </div>

    <div id="req">
      <button>새로운 수업 추가 요청</button>
    </div>
  </main>
  
</body>
</html>