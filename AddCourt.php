<?php
    include("config.php");
    $arena_id = $_GET['id'];
    $courtname = $_GET['name'];
    $intervall = $_GET['intervall'];

    $sql = "SELECT dbname, id FROM arenas WHERE id = '$arena_id'";
    $result = mysqli_query($db,$sql);
    $sqlresult = mysqli_fetch_row($result);

    $dbname = $sqlresult[0];
    $id = $sqlresult[1];
    
    if($intervall == 1){
        $time = '60';
        $string = "[{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]}]";
        $sql = "INSERT INTO $dbname (arena_id, court, timeInterval) VALUES ('$id', '$courtname', '$string')";
        $result = mysqli_query($db,$sql);
        header("Location:./admin.php");
    }

    else if($intervall == 1.5){
        $time = '90';
        $string = "[{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]}]";
        $sql = "INSERT INTO $dbname (arena_id, court, timeInterval) VALUES ('$id', '$courtname', '$string')";
        $result = mysqli_query($db,$sql);
        header("Location:./admin.php");
    }

    else{
        $time = '120';
        $string = "[{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]},{".'"'."day".'"'.":[$time]}]";
        $sql = "INSERT INTO $dbname (arena_id, court, timeInterval) VALUES ('$id', '$courtname', '$string')";
        $result = mysqli_query($db,$sql);
        header("Location:./admin.php");
    }
?>