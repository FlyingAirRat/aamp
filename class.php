<?php
  include_once "./db/db_class.php";
  session_start();
  $login_user = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : "";
  $u_no = $login_user['u_no'];
  $param = [
    'u_no' => $u_no
  ];
  $result = sel_class_list($param);
?>
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
  <?php include_once "./header.php";?> 
  <main>
    <div id="list_head">
      강의목록
      <hr>
    </div>
    <div id="list_body">
      <?php
        while($row = mysqli_fetch_assoc($result)){
          $class_nm = $row['class_nm'];
          $people = $row['people'];
          echo 
          " <div class='list_box'>
              <img src='./img/hambg.png' class='hambg'>
              <div class='text'>
                <a href='./class_detail.php'>
                  <span>$class_nm<br></span>
                  <span class='text_s'>총 인원수 ${people}명</span>
                </a>
              </div>
              <img src='./img/star_b.png' class='star' onclick='chg_img()'>
            </div>
          ";
        }
      ?>
    </div>
    <div id="req">
      <a href=""><button>새로운 수업 추가 요청</button></a>
    </div>
  </main>
  <script>
    function chg_img(e){
      e.src = './img/star_y.png';
    }
  </script>
</body>
</html>