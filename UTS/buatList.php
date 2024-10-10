<?php
session_start();
require_once('db.php');

// ini buat tabel list doang
$username = $_SESSION['username'];
$judul_tabel = $_POST['judul_tabel'];
  
$query4 = "INSERT INTO tabellist(username, judul_tabel)
            VALUES(?, ?)";

$result1 = $db->prepare($query4);
$result1->execute([$username, $judul_tabel]);

header('location: showTask.php');