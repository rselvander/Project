<?php
    session_start();
    include("config.php");

    $fname = $_POST['regfname'];
    $lname = $_POST['reglname'];
    $email = $_POST['regemail'];
    $password = $_POST['regpass'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $sqlresult = mysqli_query($db, $sql) or die (mysqli_error($db));
    $result = mysqli_num_rows($sqlresult);
        
     if($result == 1){
        $_SESSION['errors'] = array("Kontot existerar redan");
        header("Location:account.php");
      }
     else{
        $sql = "INSERT INTO users (email, password, firstname, lastname) VALUES ('$email', password('$password'), '$fname', '$lname')";
        $result = mysqli_query($db, $sql) or die (mysqli_error($db));
        header("Location:./index.php");
     }
?>