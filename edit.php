<?php
require_once 'getCate.php';
if(isset($_GET['id'])){
    $ma = $_GET['id'];
    $sql = "SELECT * FROM tours WHERE id_tours = $ma";
$stmt = $conn->prepare($sql);
$stmt->execute();
$tour = $stmt->fetch(PDO::FETCH_ASSOC);
//
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $intro = $_POST['intro'];
    $mota = $_POST['des'];
    $price = $_POST['price'];
    $date = $_POST['number_date'];
    $cate = $_POST['cate'];
    $anh = $_POST['anh'];
    $size = $file['size'];
    $img = ['jpg','png'];
    $ext = pathinfo($anh,PATHINFO_EXTENSION);
    if(empty($errors)){
            move_uploaded_file($file['tmp_name'],"images/".$anh);
        $sql = "UPDATE tours Set name ='$name',intro='$intro',description='$mota',number_date=$date,price = $price,cate_id ='$cate',image='$anh' WHERE id_tours = $ma";
        $conn->exec($sql);
        header('location:showTour.php?message=BẠn đã thêm thành công');
        die;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Thêm tour</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">Nhập tên</label><br>
        <input type="text" name="name" id="" value="<?=$tour['name']?>"><br>
        <label for="">Nhập intro</label><br>
        <input type="text" name="intro" id="" value="<?=$tour['intro']?>"><br>
        <label for="">Nhập mô tả chi tiết</label><br>
        <textarea name="des" id="" cols="30" rows="10">
            <?=$tour['description']?>
        </textarea><br>
        <label for="">Nhập giá</label><br>
        <input type="number" name="price" id="" value="<?=$tour['price']?>"><br>
        <label for="">Nhập số  ngày</label><br>
        <input type="number" name="number_date" id="" value="<?=$tour['number_date']?>"><br>
        <label for="">Chọn loại tour</label>
        <select name="cate" id="">
            <?php foreach($cates as $cate):?>
                <option value="<?=$cate['id_cate']?>" <?=(isset($cate) && $cate == $cate['id_cate'])? "selected" :''?>><?=$cate['name']?></option>
            <?php endforeach?>
        </select><br>
        <img src="images/<?=$tour['image']?>" alt="" width="200px" height="250px"><br>
        <input type="hidden" name="anh" value="<?=$tour['image']?>" id="">
        <button type="submit">Gửi</button>
    </form>
</body>
</html>