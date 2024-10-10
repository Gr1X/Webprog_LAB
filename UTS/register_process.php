<?php
    require_once('db.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repass'];
    $email = $_POST['email'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    
    $query1 = "SELECT * FROM account WHERE username = ?";
    $stmt = $db->prepare($query1);
    $stmt->execute([$username]);
    $username_ada = $stmt->fetch(PDO::FETCH_ASSOC);

    if($username_ada){
      echo "Username sudah ada";
      header('location: inputregister.php');
      // tambahin alert kalau username udah ada
    }
    else{
      if($password == $repassword){
        $en_password = password_hash($password, PASSWORD_BCRYPT);
        
        $query2 = "INSERT INTO Account(email, username, namaDepan, namaBelakang, password_account)
                  VALUES(?, ?, ?, ?, ?)";

        $result = $db->prepare($query2);
        $result->execute([$email, $username, $fName, $lName, $en_password]);

        header('location: inputlogin.php');
      }
      else{
          header('location: inputregister.php');
          // tambahin alert kalau password beda sama repassword
      }
    }
?>