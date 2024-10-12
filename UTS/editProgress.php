<?php
require_once('db.php');
// ini edit progress doang
$progress = $_POST['progress'];
$id_todo = $_POST['id_todo'];  

if($progress === "Belum"){
  $query14 = "UPDATE itemlist
              SET progress = 'Selesai'
              WHERE id_todo = ?";

  $result8 = $db->prepare($query14);
  $result8->execute([$id_todo]); 
}
else{
  $query15 = "UPDATE itemlist
              SET progress = 'Belum'
              WHERE id_todo = ?";
  
  $result9 = $db->prepare($query15);
  $result9->execute([$id_todo]); 
}

header('location: showTask.php');