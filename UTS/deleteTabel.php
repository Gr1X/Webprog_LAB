<?php
require_once('db.php');

$id_tabel = $_POST['id_tabel'];
$opsi = isset($_POST['opsi']) ? trim($_POST['opsi']) : 'showtask';

// delete semua item pada list dulu
$query10 = "DELETE
            FROM itemlist
            WHERE id_tabel = ?";

$result4 = $db->prepare($query10);
$result4->execute([$id_tabel]);

// delete list
$query11 = "DELETE
            FROM tabellist
            WHERE id_tabel = ?";

$result5 = $db->prepare($query11);
$result5->execute([$id_tabel]);

if($opsi == 'showtask'){
  header('location: showTask.php');
}
else if($opsi == 'dashboard'){
  header( 'location: dashboard.php');
}
