<?php
require_once 'connect.php';
$sql = "SELECT * FROM tours";
$stmt = $conn->prepare($sql);
$stmt->execute();
$tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>