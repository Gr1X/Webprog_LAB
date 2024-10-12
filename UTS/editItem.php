<?php
require_once('db.php');

// ini edit nama item doang
$nama_item = $_POST['nama_item'];
$id_todo = $_POST['id_todo'];  

$query12 = "UPDATE itemlist
            SET nama_item = ?
            WHERE id_todo = ?";

$result6 = $db->prepare($query12);
$result6->execute([$nama_item, $id_todo]);

header('location: showTask.php');