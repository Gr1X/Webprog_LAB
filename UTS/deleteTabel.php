<?php
session_start();
require_once('db.php');

$username = $_SESSION['username'];
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
            WHERE username = ?";

$result5 = $db->prepare($query11);
$result5->execute([$username]);

header('location: showTask.php');