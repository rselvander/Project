<?php
    session_start();
    //databas connection
    include("config.php");
    //Variabler som innehåller coach och admin id om det finns
    $_SESSION["coachid"] = "";
    $_SESSION["admin"] = "";
?>
<?php 
    //Kollar om vi lyckats koppla till databasen.
    if($db->connect_error) {
		die("Connection failed ".$db->connect_error);
    }

    //get value from post
    $username = $_POST['loguser'];
    $password = $_POST['logpass'];

    //Get values from db
    $result = $db->query("SELECT * FROM users WHERE email = '$username'
    AND password = password('$password')") or die(mysqli_error("Failed to query database" ));
    $row = $result -> fetch_array(MYSQLI_NUM);
    $count = mysqli_num_rows($result);
    $level = $row[0];
    $sql = "SELECT coach_id FROM coaches WHERE user_id = '$level'";
    $result = mysqli_query($db, $sql);
    $sqlresult = mysqli_num_rows($result);

    //Kolla om det finns ett coach eller admin id kopplat till användaren
    if($sqlresult == 1){
        $_SESSION['iscoach'] = true;
    }

    $sqlAdmin = "SELECT admin_id FROM admin WHERE user_id = '$level'";
    $resultAdmin = mysqli_query($db, $sqlAdmin);
    $sqlresultAdmin = mysqli_num_rows($resultAdmin);

    if($sqlresultAdmin == 1){
        $_SESSION['admin'] = true;
    }

    //control equal values
    if ($count == 1){
        $_SESSION['username'] = $_POST['loguser'];
        $_SESSION['loggedin'] = true;
        $_SESSION['lid'] = $row[0];

        header("Location:".$_SESSION['prev']);
    }
    else{   
        $_SESSION['errors'] = array("Your username or password was incorrect.");
        header("Location:account.php");
    }
?>