<?php  
    session_start();
    require_once('db.php');
    
    $id = $_SESSION["id_account"];
    $newUsername = $_POST['newUsername'];

    $query20 = "SELECT * FROM Account WHERE id_account = ?";
    $stmt20 = $db->prepare($query20);
    $stmt20->execute([$id]);
    $row = $stmt20->fetch(PDO::FETCH_ASSOC);

    if(!$row){
        echo "Login Failed! Please Re-login";
        header("location: login.php");
        exit;
    } else {
        try {
            $db->beginTransaction();
            
            $db->exec("SET FOREIGN_KEY_CHECKS = 0");
            
            $query21 = "UPDATE Account SET username = ? WHERE id_account = ?";
            $stmt21 = $db->prepare($query21);
            $stmt21->execute([$newUsername, $id]);
          
            $query22 = "UPDATE tabellist SET username = ? WHERE username = ?";
            $stmt22 = $db->prepare($query22);
            $stmt22->execute([$newUsername, $row['username']]);
            
            $db->exec("SET FOREIGN_KEY_CHECKS = 1");
            
            $db->commit();
            $_SESSION['username'] = $newUsername;
            header('location: pageUser.php');
        } catch (Exception $e) {
            $db->rollBack();
            echo "Failed to update username: " . $error->getMessage();
        }
    }
?>
