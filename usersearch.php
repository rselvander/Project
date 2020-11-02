<?php
    function usersearch(){
        include("config.php");
        $sql = "SELECT * FROM users";
        $result = mysqli_query($db,$sql);
        while($drop_u = mysqli_fetch_array($result)){
            echo '<option value="'.$drop_u['id'].'"> '.$drop_u['id'].'.  '.$drop_u['firstname'].' '.$drop_u['lastname'].'</option>';
        }
    }
?>