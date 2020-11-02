<?php
    include("config.php");
    $arenaname = $_POST['Arena'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $zip = $_POST['zip'];
    $open1 = $_POST['open1'];
    $close1 = $_POST['close1'];

    $open2 = $_POST['open2'];
    $close2 = $_POST['close2'];

    $open3 = $_POST['open3'];
    $close3 = $_POST['close3'];

    $open4 = $_POST['open4'];
    $close4 = $_POST['close4'];

    $open5 = $_POST['open5'];
    $close5 = $_POST['close5'];

    $open6 = $_POST['open6'];
    $close6 = $_POST['close6'];

    $open0 = $_POST['open0'];
    $close0 = $_POST['close0'];

    $dbname = preg_replace("/\s+/","", $arenaname);
    $dbname = preg_replace("/ä/","a", $dbname);
    $dbname = preg_replace("/å/","a", $dbname);
    $dbname = preg_replace("/ö/","o", $dbname);
    
    $stmt = $db->prepare("INSERT INTO arenas (name, street, city, zip, dbname) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $arenaname, $city, $street, $zip, $dbname);
    $stmt->execute();
    $stmt2 = "create TABLE $dbname (
        id INT AUTO_INCREMENT PRIMARY KEY,
        arena_id INT,
        court VARCHAR(50),
        timeInterval Longtext,
        FOREIGN KEY (arena_id) REFERENCES arenas(id)
        )";

    $result = mysqli_query($db,$stmt2);
    
    $sql = "SELECT id FROM arenas WHERE name = '$arenaname'";
    $result = mysqli_query($db,$sql);
    $sqlresult = mysqli_fetch_row($result);
    $sql = $sqlresult[0];

    $time = "INSERT INTO openinghours (arena_id, weekday, open, close) VALUES('$sql',0, '$open0', '$close0')";
    $time1 = "INSERT INTO openinghours (arena_id, weekday, open, close) VALUES('$sql',1, '$open6', '$close6')";
    $time2 = "INSERT INTO openinghours (arena_id, weekday, open, close) VALUES('$sql',2, '$open5', '$close5')";
    $time3 = "INSERT INTO openinghours (arena_id, weekday, open, close) VALUES('$sql',3, '$open4', '$close4')";
    $time4 = "INSERT INTO openinghours (arena_id, weekday, open, close) VALUES('$sql',4, '$open3', '$close3')";
    $time5 = "INSERT INTO openinghours (arena_id, weekday, open, close) VALUES('$sql',5, '$open2', '$close2')";
    $time6 = "INSERT INTO openinghours (arena_id, weekday, open, close) VALUES('$sql',6, '$open1', '$close1')";
    
    $result = mysqli_query($db, $time);
    $result = mysqli_query($db, $time1);
    $result = mysqli_query($db, $time2);
    $result = mysqli_query($db, $time3);
    $result = mysqli_query($db, $time4);
    $result = mysqli_query($db, $time5);
    $result = mysqli_query($db, $time6);
    
    header("Location:./admin.php");
?>