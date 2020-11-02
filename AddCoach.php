<?php
    session_start();
    include("config.php");
    $user_id = $_GET['id'];
    $arena = $_GET['arena_id'];
    
    $sql = "INSERT INTO coaches(user_id) VALUES('$user_id')";

    $result = mysqli_query($db, $sql) or die (mysqli_error($db));

    $coach = "SELECT coach_id FROM coaches WHERE user_id = '$user_id'";
    $result = mysqli_query($db, $coach) or die (mysqli_error($db));

    $sqlresult = mysqli_fetch_row($result);
    $coach_id = $sqlresult[0];

    $arenacoach = "INSERT INTO coachinarena (coach_id, arena_id) VALUES ('$coach_id', '$arena')";
    $arenaresult = mysqli_query($db, $arenacoach) or die(mysqli_error($db));

    header("Location:./admin.php");
?>