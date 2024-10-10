<?php
session_start();
require_once('db.php');

// 1 baris berarti menandakan 1 item yang dimiliki username dan pada judul
$judul = $_POST['judul'];
$username = $_SESSION['username'];
$nama_item = $_POST['nama_item'];

$en_password = password_hash($password, PASSWORD_BCRYPT);
  
$query4 = "INSERT INTO itemlist(username, title, nama_item)
            VALUES(?, ?, ?)";

$result1 = $db->prepare($query4);
$result1->execute([$username, $judul, $nama_item]);


header('location: showTask.php');