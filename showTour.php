<?php
require_once 'getTour.php';
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
    <h2>Danh sách tour</h2>
    <table border="1">
        <tr>
            <th>Mã</th>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>Số ngày</th>
            <th>Loại tour</th>
            <th>ảnh</th>
            <th colspan="2">Lựa chọn</th>
        </tr>
        <?php foreach ($tours as $tour) : ?>
            <tr>
                <td><?= $tour['id_tours'] ?></td>
                <td><?= $tour['name'] ?></td>
                <td><?= $tour['description'] ?></td>
                <td><?= $tour['number_date'] ?></td>
                <td>
                    <?php
                    $tour_id = $tour['id_tours'];
                    $sql = "SELECT * FROM cate WHERE id_cate = $tour_id";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $cate = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo $cate['name'];
                    ?>
                </td>
                <td><img src="images/<?= $tour['image'] ?>" alt="" width="100px" height="150px"></td>
                <td><a href="edit.php?id=<?= $tour['id_tours'] ?>">Sửa</a></td>
                <td>
                    <a onclick="return confirm('Bạn có chắc chắn xóa không?')" href="delete.php?id=<?= $tour['id_tours'] ?>">Xóa</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <a href="addTour.php">Thêm tour</a>
</body>

</html>