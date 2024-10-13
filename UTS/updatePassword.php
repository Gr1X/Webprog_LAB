<?php  
    session_start();
    require_once('db.php');
    
    $oldPassword = $_POST['oldPassword'];
    $reOldPassword = $_POST['reOldPassword'];
    $newPassword = $_POST['passwordUpdate'];
    $email = $_POST['emailUpdate'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    $query16 = "SELECT * FROM account
           WHERE email = ?";

    $stmt16 = $db->prepare($query16);
    $stmt16->execute([$email]);
    $row = $stmt16->fetch(PDO::FETCH_ASSOC);

    if(!$row){
        
    } else {
        if();
    }

    header("location:pageUser.php");
?>