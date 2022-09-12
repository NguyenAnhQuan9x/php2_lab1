<?php
require_once 'connect.php';
$sql = "SELECT * FROM cate";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cates = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>