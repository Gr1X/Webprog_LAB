<?php
require_once('db.php');

$id_todo = $_POST['id_todo'];
$opsi = isset($_POST['opsi']) ? trim($_POST['opsi']) : 'showtask';

$query13 = "DELETE
            FROM itemlist
            WHERE id_todo = ?";

$result7 = $db->prepare($query13);
$result7->execute([$id_todo]);


if($opsi == 'showtask'){
  header('location: showTask.php');
}
else if($opsi == 'dashboard'){
  
  header( 'location: dashboard.php');
}



