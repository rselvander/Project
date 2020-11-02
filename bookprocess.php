<?php
    session_start();
    if (! isset($_SESSION['loggedin']) ||  $_SESSION['loggedin'] != true) {
        header("Location:account.php");
    } 
    else {
        include 'config.php';

        $aid = $_GET['aid'];
        $cid = $_GET['cid'];
        $cname = $_GET['cname'];
        $dts = $_GET['dts'];
        $dte = $_GET['dte'];
        $uid = $_GET['uid'];
        
        $sql = "INSERT INTO booking (arena_id, court_id, courtname, dateTimeStart, dateTimeEnd) VALUES ('$aid', '$cid', '$cname', '$dts','$dte')";
        $result = mysqli_query($db, $sql) or die (mysqli_error($db));

        $sql= "SELECT id FROM booking WHERE arena_id='$aid' AND court_id='$cid' AND dateTimeStart='$dts'";
        $result = $db->query("SELECT id FROM booking WHERE arena_id='$aid' AND court_id='$cid' AND dateTimeStart='$dts'");

        $sqlresult = mysqli_fetch_row($result);
        $bookid = $sqlresult[0];

        $sql = "INSERT INTO userbooking (user_id, booking_id) VALUES ('$uid', '$bookid')";
        $result = mysqli_query($db,$sql);
        
        if (isset($_SESSION['iscoach'])) {
        $sql = "INSERT INTO coachbooking (book_id, coach_id, dateTimeStart, dateTimeEnd)
                VALUES ('$bookid', '$uid', '$dts', '$dte')";
        }
        $result = mysqli_query($db,$sql);
        
        $sqlm = "SELECT name FROM arenas WHERE id = '$aid'";
        $resultm = mysqli_query($db,$sqlm);
        $rowm = mysqli_fetch_row($resultm);
        $name = $rowm[0]; 
        $message = "Din bokning för $dts till $dte på bana $cname i $name är nu konfirmerad, välkommen till $name";
        $email = $_SESSION['username'];
        mail($email, "bokning",$message);

        header("location: profile.php");
    }
?>