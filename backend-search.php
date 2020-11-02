<?php
    /* Ajax search to get the arena results based on name, street, city or zipcode */
    session_start();
    include 'config.php';

    $q = "%" .$_GET['q']. "%";
    
    $sql = 'SELECT * from arenas WHERE "name" LIKE ? OR street LIKE ? OR city LIKE ? OR zip LIKE ? LIMIT 10';

    if($stmt = mysqli_prepare($db, $sql))
    {
        $stmt->bind_param("ssss", $q, $q, $q, $q);
        $stmt->execute();
        $result = $stmt->get_result();
            
        while($row = mysqli_fetch_array($result)){
            $_SESSION['fs'] = true;
            echo '<a href="book.php?book='.$row["name"].'&did='.$row["dbname"].'&aid='.$row["id"].'""><div>'.$row["name"].', '.$row["street"].', '.$row["city"].'</div></a>';
        }
    } else {
        echo "could not execute".mysqli_error($db);
    }
?>
