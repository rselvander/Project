<?php
    include("config.php");

    $dbname = $_GET['dbname'];
    $courtid = $_GET['courtid'];

    $sql = "DELETE FROM $dbname WHERE id = '$courtid'";
    $result = mysqli_query($db,$sql);

    header("Location:./admin.php");
?>