<?php  
    session_start();
    require_once('db.php');
    
    $id = $_SESSION["id_account"];

    $fname = $_POST['fname'];

    $query24 = "SELECT * FROM Account
                WHERE id_account = ?";

    $stmt24 = $db->prepare($query24);
    $stmt24->execute([$id]);
    $row = $stmt24->fetch(PDO::FETCH_ASSOC);


    if(!$row){
        echo "Login Failed! Please Re-login";
        header("location: login.php");
      } else {
        $query25 = "UPDATE Account 
                    SET namaDepan = '$fname'
                    WHERE id_account = ?";

        $stmt25 = $db->prepare($query25);
        $stmt25->execute([$id]);
        $row = $stmt25->fetch(PDO::FETCH_ASSOC);

        header('location: pageUser.php');
    } 
?>