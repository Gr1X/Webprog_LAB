<?php
    require_once('db.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repass'];
    $email = $_POST['email'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    
    $query0 = "SELECT * FROM account WHERE email = ?";
    $stmt0 = $db->prepare($query0);
    $stmt0->execute([$email]);
    $email_ada = $stmt0->fetch(PDO::FETCH_ASSOC);

    if($email_ada){
      echo "Email sudah ada
            <a href='inputLogin.php' class='btn btn-primary me-2'>Login</a>";
      // alert kalau email sudah ada
    }
    else{
      $query1 = "SELECT * FROM account WHERE username = ?";
      $stmt1 = $db->prepare($query1);
      $stmt1->execute([$username]);
      $username_ada = $stmt1->fetch(PDO::FETCH_ASSOC);

      if($username_ada){
        echo "Username sudah ada
              <a href='inputLogin.php' class='btn btn-primary me-2'>Login</a>";
        // alert kalau username sudah ada
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
    }
?>