<?php  
    session_start();
    require_once('db.php');
    
    $id = $_SESSION["id_account"];
    $newEmail = $_POST['newEmail'];

    $query22 = "SELECT * FROM Account
                WHERE id_account = ?";

    $stmt22 = $db->prepare($query22);
    $stmt22->execute([$id]);
    $row = $stmt22->fetch(PDO::FETCH_ASSOC);


    if(!$row){
        echo "Login Failed! Please Re-login";
        header("location: login.php");
      } else {
        $query23 = "UPDATE Account 
                    SET email = '$newEmail'
                    WHERE id_account = ?";

        $stmt23 = $db->prepare($query23);
        $stmt23->execute([$id]);
        $row = $stmt23->fetch(PDO::FETCH_ASSOC);

        $_SESSION['email'] = $newEmail;
        header('location: pageUser.php');
    } 
?>