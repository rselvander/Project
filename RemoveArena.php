<?php
    include("config.php");
    
    $arenaid = $_GET['id'];

    $sql = "SELECT dbname FROM arenas WHERE id = '$arenaid'";
    $result = mysqli_query($db,$sql);
    $sqlresult = mysqli_fetch_row($result);
    $dbname = $sqlresult[0];
    $sql = "DELETE FROM openinghours WHERE arena_id = '$arenaid'";
    $result = mysqli_query($db,$sql);
    $sql = "DELETE FROM arenas WHERE id = '$arenaid'";
    $result = mysqli_query($db,$sql);
    $sql = "DROP TABLE $dbname";
    $result = mysqli_query($db,$sql);
    header("Location:./admin.php");
?>