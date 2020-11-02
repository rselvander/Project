<?php
    include("config.php");

    $dbname = $_GET['dbname'];
    echo $dbname;
    $sql = "SELECT * FROM $dbname";

    $result = mysqli_query($db,$sql);

    echo "<option value = ' '  selected='selected'>Bana</option>";
    while($court = mysqli_fetch_array($result)){
    echo '<option value="'.$court['id'].'">'.$court['id'].'  '.$court['court'].'</option>';
    }
?>