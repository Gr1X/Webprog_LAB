<?php
session_start();
require_once('db.php');

// ini buat isi tabel doang
$judul_tabel = $_POST['judul_tabel']; // Ini nanti otomatis ketika pencet pada tabelnya
$nama_item = $_POST['nama_item']; 

$query5 = "INSERT INTO tabellist(judul_tabel, nama_item)
            VALUES(?, ?)";

$result2 = $db->prepare($query5);
$result2->execute([$judul_tabel, $nama_item]);

header('location: showTask.php');