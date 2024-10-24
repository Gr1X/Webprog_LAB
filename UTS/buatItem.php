<?php
require_once('db.php');

$id_tabel = $_POST['id_tabel'];
$nama_item = $_POST['nama_item'];
$opsi = isset($_POST['opsi']) ? trim($_POST['opsi']) : 'showtask';
  
$query8 = "INSERT INTO itemlist(id_tabel, nama_item)
            VALUES(?, ?)";

$result2 = $db->prepare($query8);
$result2->execute([$id_tabel, $nama_item]);

if($opsi == 'showtask'){
  header('location: showTask.php');
}
else if($opsi == 'dashboard'){
  header('location: dashboard.php');
}