<?php
    include("config.php");

    $q = $_GET["q"];
    $d = $_GET["d"];
    $da = $_GET["da"];
    $co = $_GET["co"];
    $arr = [];
    $arr1 = [];
    $arr2 = [];
    $arr3 = [];
    $encoded;
    $da = "'".$da."'";
    $counter = 0;

    $query = "SELECT ".$q.".id, ".$q.".court, ".$q.".timeInterval, TIME_TO_SEC(openinghours.open), TIME_TO_SEC(openinghours.close) 
    FROM ".$q." 
    INNER JOIN openinghours ON ".$q.".arena_id=openinghours.arena_id AND openinghours.weekday=".$d.";";
    $query .= "SELECT ".$q.".id, TIME(booking.dateTimeStart) AS StartTime,
    TIME_TO_SEC(TIME(booking.dateTimeStart)) AS StartSec, userbooking.user_id
    FROM booking LEFT JOIN ".$q." ON booking.court_id = ".$q.".id 
    LEFT JOIN userbooking ON userbooking.booking_id=booking.id 
    WHERE booking.arena_id = ".$q.".arena_id AND DATE(booking.dateTimeStart) LIKE ".$da." ORDER BY ".$q.".id, StartTime;";
    $query .= "SELECT TIME_TO_SEC(TIME(coachbooking.dateTimeStart)) AS StartSec,
    TIME_TO_SEC(TIME(coachbooking.dateTimeEnd)) AS EndSec, coachbooking.book_id
    FROM coachbooking
    WHERE coachbooking.coach_id = ".$co." AND DATE(coachbooking.dateTimeStart) LIKE ".$da."
    ORDER BY  StartSec";

    if($db->multi_query($query)) {
        do {
            if($result = $db->store_result()){
                if ($counter == 0) {
                    $i = 0;
                    while($row = $result->fetch_row()) {
                        $arr1[$i++] = array("Id"=>$row[0],
                            "Name"=>$row[1],
                            "Interval"=>$row[2],
                            "Open"=>$row[3]/60,
                            "Close"=>$row[4]/60);
                    }
                    $counter++;
                } else if ($counter == 1) {
                    $i = 0;
                    while($row = $result->fetch_row()) {
                        $arr2[$i++] = array("Id"=>$row[0],
                            "StartTime"=>$row[1],
                            "StartMin"=>$row[2]/60,
                            "Booker"=>$row[3]);
                    }
                    $counter++;
                } else {
                    $i = 0;
                    while($row = mysqli_fetch_row($result)) {
                        $arr3[$i++] = array("Started"=>$row[0]/60,
                            "Ended"=>$row[1]/60,
                            "BookId"=>$row[2]);
                    }
                }
                $result->free();
            }
        } while ($db->more_results() && $db->next_result());
    }

    $arr = array("sched"=>json_encode($arr1),
            "book"=>json_encode($arr2),
            "coa"=>json_encode($arr3));
    $encoded = json_encode($arr);
    echo($encoded);
?>