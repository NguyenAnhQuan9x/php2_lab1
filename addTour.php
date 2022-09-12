<?php
require_once 'getCate.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $intro = $_POST['intro'];
    $mota = $_POST['des'];
    $price = $_POST['price'];
    $date = $_POST['number_date'];
    $cate = $_POST['cate'];
    $file = $_FILES['anh'];
    $anh = $file['name'];
    $size = $file['size'];
    $img = ['jpg','png'];
    $ext = pathinfo($anh,PATHINFO_EXTENSION);
    if($name==''){
        $errors['name'] = "Bạn chưa nhập tên";
    }
    if($price <  0){
        $errors['price'] = "Bạn phải nhập số dương";
    }
    if($date <  0){
        $errors['date'] = "Bạn phải nhập số dương";
    }
    if($size <= 0 || $size >2000000){
        $errors['anh'] = "Bạn chưa tải ảnh hoặc ảnh không đúng kích cỡ";
    }
    if($size > 0 && !in_array($ext,$img)){
        $error['anh'] = "Bạn tải không phải ảnh";
    }
    if(empty($errors)){
        move_uploaded_file($file['tmp_name'],"images/".$anh);
        $sql = "INSERT INTO tours(name,intro,description,price,number_date,cate_id,image) VALUES('$name','$intro','$mota',$price,$date,$cate,'$anh')";
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
        <span><?=isset($errors['name'])? $errors['name']:''?></span><br>
        <input type="text" name="name" id=""><br>
        <label for="">Nhập intro</label><br>
        <input type="text" name="intro" id=""><br>
        <label for="">Nhập mô tả chi tiết</label><br>
        <textarea name="des" id="" cols="30" rows="10"></textarea><br>
        <label for="">Nhập giá</label><br>
        <input type="number" name="price" id=""><br>
        <span><?=isset($errors['price'])? $errors['price']:''?></span><br>
        <label for="">Nhập số  ngày</label><br>
        <input type="number" name="number_date" id=""><br>
        <span><?=isset($errors['date'])? $errors['date']:''?></span><br>
        <label for="">Chọn loại tour</label>
        <select name="cate" id="">
            <?php foreach($cates as $cate):?>
                <option value="<?=$cate['id_cate']?>" <?=(isset($cate) && $cate == $cate['id_cate'])? "selected" :''?>><?=$cate['name']?></option>
            <?php endforeach?>
        </select><br>
        <label for="">Tải ảnh lên</label><br>
        <input type="file" name="anh" id=""><br>
        <span><?=isset($errors['anh'])? $errors['anh']:''?></span><br>
        <button type="submit">Gửi</button>
    </form>
</body>
</html>