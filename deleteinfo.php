<?php
    session_start();
  	include("config.php");
    $id = $_GET['id'];
    $bi = $_GET['bi']; 

    $stmt = $db->prepare("DELETE FROM coachbooking WHERE book_id LIKE ?");
    $stmt->bind_param("s", $bi);
    $stmt->execute();

    $stmt = $db->prepare("DELETE FROM userbooking WHERE user_id LIKE ? AND booking_id LIKE ?");
    $stmt->bind_param("ss", $id, $bi);
    $stmt->execute();

    $stmt = $db->prepare("DELETE FROM booking WHERE id LIKE ?");
    $stmt->bind_param("s", $bi);
    $stmt->execute();

    header("Location:./profile.php");
?>