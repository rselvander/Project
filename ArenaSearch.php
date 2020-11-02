<?php
    function arenasearch(){
        include("config.php");
        $sql = "SELECT * FROM arenas";
        $result = mysqli_query($db,$sql);
        while($drop_2 = mysqli_fetch_array($result)){
            echo '<option value="'.$drop_2['id'].'">'.$drop_2['name'].'</option>';
        }
    }

    function dbnamesearch(){
        include("config.php");
        $sql = "SELECT * FROM arenas";
        $result = mysqli_query($db,$sql);
        while($drop_2 = mysqli_fetch_array($result)){
		echo '<option value="'.$drop_2['dbname'].'">'.$drop_2['name'].'</option>';
		}
    }
?>