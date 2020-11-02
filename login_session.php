<?php session_start();
    if (! isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=  true){
        $menu_button = "Sign in";
        $url = "account.php";
        $drop_name = "Sign in";
        $drop_url = "account.php";
        $drop_profile = "";
        $drop_profile_url = "";
        $drop_admin = "";
        $drop_admin_url = "";
    }
    else{
        $menu_button = "My Profile";
        $url = "profile.php";
        $drop_profile = "Profile";
        $drop_profile_url = "profile.php";
        $drop_name = "Log out";
        $drop_url = "logout.php";
        if($_SESSION['admin'] == true){
            $drop_admin = "Admin";
            $drop_admin_url = "admin.php";
        }
        else{
            $drop_admin = "";
            $drop_admin_url = "";
        }
    }
?>