<?php
require_once('db.php');

$id_tabel = $_POST['id_tabel'];
$nama_item = $_POST['nama_item'];
  
$query8 = "INSERT INTO itemlist(id_tabel, nama_item)
            VALUES(?, ?)";

$result2 = $db->prepare($query8);
$result2->execute([$id_tabel, $nama_item]);

header('location: showTask.php');