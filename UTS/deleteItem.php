<?php
require_once('db.php');

$id_todo = $_POST['id_todo'];

// delete semua item pada list dulu
$query13 = "DELETE
            FROM itemlist
            WHERE id_todo = ?";

$result7 = $db->prepare($query13);
$result7->execute([$id_todo]);

header('location: showTask.php');