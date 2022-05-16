<?php
    include_once "db/db_img.php";
    $list = sel_list();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>목록</title>
</head>
<body>
    <div>
        <?php
            foreach($list as $item){
        ?>
            <ul>
                <li><img src="<?=$item['imgsrc']?>"></li>
                <li><?=$item['user_nm']?></li>
            </ul>
        <?php } ?>
    </div>
</body>
</html>