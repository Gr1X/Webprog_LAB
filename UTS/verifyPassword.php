<?php
session_start();
require_once('db.php');

// Data dari Form Login
$email = $_POST['email'];
$password = $_POST['password'];

// Check if user exists
$query3 = "SELECT * FROM account
           WHERE email = ?";

$stmt3 = $db->prepare($query3);
$stmt3->execute([$email]);
$row = $stmt3->fetch(PDO::FETCH_ASSOC);

if(!$row){
  echo "Email not found
        <a href='inputRegister.php' class='btn btn-primary me-2'>Register</a>";
}
else{
  // Check password
  if(!password_verify($password, $row['password_account'])){
    echo "Wrong Password
          <a href='inputLogin.php' class='btn btn-primary me-2'>Login</a>";
  }
  else{
    // Login Sukses
    $_SESSION['id_account'] = $row['id_account'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['filter'] = 'all';
    header('location: dashboard.php');
  }
}