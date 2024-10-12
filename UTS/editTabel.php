<?php
session_start();
require_once('db.php');

// ini edit nama tabel list doang
$username = $_SESSION['username'];
$judul_tabel = $_POST['judul_tabel'];
$id_tabel = $_POST['id_tabel'];  

$query9 = "UPDATE tabellist
           SET judul_tabel = ?
           WHERE username = ? AND id_tabel = ?";

$result3 = $db->prepare($query9);
$result3->execute([$judul_tabel, $username, $id_tabel]);

header('location: showTask.php');