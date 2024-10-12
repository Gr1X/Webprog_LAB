<?php

// ini edit progress doang
$progress = $_POST['progress'];
$id_todo = $_POST['id_todo'];  

$query14 = "UPDATE itemlist
            SET progress = 'Selesai'
            WHERE id_todo = ?";

$result8 = $db->prepare($query14);
$result8->execute([$id_todo]);

header('location: showTask.php');