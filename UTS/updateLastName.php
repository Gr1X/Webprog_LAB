<?php  
    session_start();
    require_once('db.php');
    
    $id = $_SESSION["id_account"];

    $lname = $_POST['lname'];

    $query26 = "SELECT * FROM Account
                WHERE id_account = ?";

    $stmt26 = $db->prepare($query26);
    $stmt26->execute([$id]);
    $row = $stmt26->fetch(PDO::FETCH_ASSOC);


    if(!$row){
        echo "Login Failed! Please Re-login";
        header("location: login.php");
      } else {
        $query27 = "UPDATE Account 
                    SET namaBelakang = '$lname'
                    WHERE id_account = ?";

        $stmt27 = $db->prepare($query27);
        $stmt27->execute([$id]);
        $row = $stmt27->fetch(PDO::FETCH_ASSOC);

        header('location: pageUser.php');
    } 
?>