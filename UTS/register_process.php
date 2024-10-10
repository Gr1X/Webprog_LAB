<?php
    require_once('db.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repass'];
    $email = $_POST['email'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];

    if($password == $repassword){
        $en_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT"
    }
    
?>