<?php
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['loggedin']);
    if (isset($_SESSION['iscoach'])) {
    	unset($_SESSION['iscoach']);
    }
    if (isset($_SESSION['admin'])) {
    	unset($_SESSION['admin']);
    }
    header("Location:index.php");
?>