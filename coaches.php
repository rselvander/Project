<?php
	function coaches()
	{
		include("config.php");

		$title = $_SESSION['book'];

		$arenafetch = "SELECT id FROM arenas WHERE name='$title'";

		$result = mysqli_query($db,$arenafetch) or die(mysqli_error($db));

		$arenaarray = [];
		$i=0;

		while($arenarow = mysqli_fetch_row($result)){
			$arenaarray[$i++] = array("id"=>$arenarow[0]);		
		}

		$id = $arenaarray[0]['id'];

		$sql = "SELECT * FROM users
		LEFT JOIN coaches
		ON coaches.user_id = users.id
		LEFT JOIN coachinarena
		ON coachinarena.coach_id = coaches.coach_id
		WHERE coachinarena.arena_id = ".$id;

		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
			
		$fullarray = [];
		$i = 0;

		$currentrow = 1;

		echo '<div class="rows">';

		/* read coaches dynamically onto the webpage from the database */

		while($row = mysqli_fetch_row($result)){
			$fullarray[$i] = array("firstname"=>$row[3], "lastname"=>$row[4], "imgurl"=>$row[9], "coach_id"=>$row[13], "arena_id"=>$row[15]);	

			$arraycount = count($fullarray);

			if($currentrow % 5 == 0){
				echo '</div><div class="rows">';
			}

			$imgurl = "imgurl";

			$fullname = $fullarray[$i]['firstname']." ".$fullarray[$i]['lastname'];

			echo '<div class="column"> <img src="';
			echo $fullarray[$i][$imgurl];
			echo '"  onclick="coachpage(';
			echo $fullarray[$i]['coach_id'];
			echo ')"> <div>';
			echo $fullarray[$i]['firstname']; 
			echo " "; 
			echo $fullarray[$i]['lastname'];
			echo '</div> </div>';

			$currentrow++;
			$i++;
		}
		echo '</div>';
	}
?>