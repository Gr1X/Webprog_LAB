<?php
require_once('db.php');

$id_tabel = $_POST['id_tabel'];

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

header('location: showTask.php');