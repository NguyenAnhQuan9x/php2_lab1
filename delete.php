<?php
require_once 'connect.php';
if(isset($_GET['id'])){
    $ma = $_GET['id'];
    $sql = "DELETE FROM tours WHERE id_tours = $ma";
    $conn->exec($sql);
    header('location:showTour.php');
    die;
}
?>