<?php
$serverName = "localhost:3366";
$userName = "root";
$passWord = "";
$dbName = "php2_lab1";
try{
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName",$userName,$passWord);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo "Connect failed".$e->getMessage();
}
?>