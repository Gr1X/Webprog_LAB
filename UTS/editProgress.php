<?php
require_once('db.php');
// ini edit progress doang
$progress = $_POST['progress'];
$id_todo = $_POST['id_todo'];  
$opsi = isset($_POST['opsi']) ? trim($_POST['opsi']) : 'showtask';

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

if($opsi == 'showtask'){
  header('location: showTask.php');
}
else if($opsi == 'dashboard'){
  header(header: 'location: dashboard.php');
}