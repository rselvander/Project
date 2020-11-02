<?php
    include("config.php");

    $id = $_GET['id']; 

    $sql = "SELECT coach_id FROM coaches WHERE user_id = '$id'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_row($result);
    $coachid = $row[0];

    $sql = "DELETE FROM coachinarena WHERE coach_id = '$coachid'";
    $result = mysqli_query($db,$sql);

    $sql = "DELETE FROM coaches WHERE coach_id = '$coachid'";
    $result = mysqli_query($db,$sql);

    $sql = "DELETE FROM userbooking WHERE user_id = '$id'";
    $result = mysqli_query($db,$sql);

    $sql = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($db,$sql);

    header("Location:./admin.php");
?>