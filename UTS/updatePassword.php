<?php  
    session_start();
    require_once('db.php');
    
    $id = $_SESSION["id_account"];

    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    $query16 = "SELECT * FROM Account
                WHERE id_account = ?";

    $stmt16 = $db->prepare($query16);
    $stmt16->execute([$id]);
    $row = $stmt16->fetch(PDO::FETCH_ASSOC);


    if(!$row){
        echo "Login Failed! Please Re-login";
        header("location: login.php");
      } else {
        if(!password_verify($oldPassword, $row['password_account'])){
          echo "Wrong Password
                <a href='inputLogin.php' class='btn btn-primary me-2'>Login</a>";
        } else {
            $enc_password = password_hash($newPassword, PASSWORD_BCRYPT);
            $query19 = "UPDATE Account 
                        SET password_account = '$enc_password'
                        WHERE id_account = ?";

            $stmt19 = $db->prepare($query19);
            $stmt19->execute([$id]);
            $row = $stmt19->fetch(PDO::FETCH_ASSOC);
            header('location: pageUser.php');
        }
    } 
?>