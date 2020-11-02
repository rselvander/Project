<?php
    session_start();
  	include("config.php");
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $street = $_POST['adress'];
    $zip = $_POST['zip'];
    $playrank = $_POST['playrank'];
    $bio = $_POST['info'];
    $id = $_GET['id']; 
    $file = $_FILES['file']['name'];

    if($file == ""){     
      $stmt = $db->prepare("UPDATE users SET firstname=?,lastname=?,email=?,phone=?,street=?,city=?,zip=?,playrank=?,info=? WHERE id=?");
      $stmt->bind_param("ssssssssss", $fname, $lname, $email, $phone, $street, $city, $zip, $playrank, $bio, $id);
      $stmt->execute();
      $_SESSION["username"] = $email;
      header("Location:./profile.php");
      echo "HEj";
    }
    else{
      $target_dir = "images/";
      $target_file = $target_dir . basename($_FILES["file"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $extension_array = array("jpg","jpeg","png","gif");

    if(in_array($imageFileType,$extension_array) ){
      move_uploaded_file($_FILES['file']['tmp_name'],$target_file);
    }     
      $stmt = $db->prepare("UPDATE users SET firstname=?,lastname=?,email=?,phone=?,street=?,city=?,zip=?,playrank=?,info=?,imgurl=? WHERE id=?");
      $stmt->bind_param("sssssssssss", $fname, $lname, $email, $phone, $street, $city, $zip, $playrank, $bio, $target_file, $id);
      $stmt->execute();
      $_SESSION["username"] = $email;
      header("Location:./profile.php");
  }
?>