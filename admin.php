<?php
	include("config.php");
	include("ArenaSearch.php");
	include("usersearch.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PadelBooker | Raise your rackets</title>
	<link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/media.css">
	<link rel="stylesheet" href="css/profile.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="navbar">
				<nav>
                	<ul class="MenuItems" id="MenuItems">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="search.php">Book</a></li>
                    </ul>
                </nav>
				<img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
			</div>
        </div>
        
		<p>Ta bort användare</p>
		<select name = "drop_2" id="drop_2">
			Användare
			<option selected="selected">Användare</option>
			<?php usersearch(); ?>
		</select>

		<button onclick="RemoveUser()">Ta bort</button>
		<br>
		<br>
		<br>
		<p> Lägg till coach </p>
		<select name = "drop_3" id="drop_3">
			<option value = " " selected="selected">Arena</option>
			<?php arenasearch(); ?>
		</select>

		<select name = "drop_4" id="drop_4">
			Användare
			<option value = " " selected="selected">Användare</option>
			<?php usersearch(); ?>
		</select>
		<button onclick="AddCoach()">Lägg till</button>
		<br>
		<br>
		<br>
		<form method="POST" action="AddArena.php">
			<p>Lägg till Arena</p>
			<input type="text" id="Arena" name="Arena" placeholder="Arenanamn" required>
			<input type="text" id="city" name="city" placeholder="Stad" required>
			<input type="text" id="street" name="street" placeholder="Adress" required>
			<input type="text" id="zip" name="zip" placeholder="Postnummer" required><br>
			Öppetider<br>
			Måndag <input type="time" id="open1" name="open1" required> - <input type="time" id="close1" name="close1" required><br>
			Tisdag <input type="time" id="open2" name="open2" required> - <input type="time" id="close2" name="close2" required><br>
			Onsdag <input type="time" id="open3" name="open3" required> - <input type="time" id="close3" name="close3" required><br>
			Torsdag <input type="time" id="open4" name="open4" required> - <input type="time" id="close4" name="close4" required><br>
			Fredag <input type="time" id="open5" name="open5" required> - <input type="time" id="close5" name="close5" required><br>
			Lördag <input type="time" id="open6" name="open6" required> - <input type="time" id="close6" name="close6" required><br>
			Söndag <input type="time" id="open0" name="open0" required> - <input type="time" id="close0" name="close0" required><br>
			<button type="submit">Lägg till</button>
		</form>
		<br>
		<br>
		<p>Lägg till bana</p>
		<select name = "arena_court" id="arena_court">
			<option value = " " selected="selected">Arena</option>
			<?php arenasearch(); ?>
		</select>
		<input id="courtname" name="courtname" placeholder="Namn på ny bana..."></input>
		Bokningsintervall i timmar
		<select  name="intervall" id="intervall">
			<option value="1">1</option>
			<option value="1.5">1.5</option>
			<option value="2">2</option>
		</select>
		<button onclick="AddCourt()">Lägg till</button>
		<br>
		<br>
		<br>
		Ta bort arena
		<select name = "arena_remove" id="arena_remove">
			<option value = " " selected="selected">Arena</option>
			<?php arenasearch(); ?>
		</select>
		<button onclick="RemoveArena()">Ta bort</button>

		<br>
		<br>
		<br>
		Ta bort bana
		<select name = "court_remove" id="court_remove" onchange="Findcourts()">
			<option value = " " selected="selected">Arena</option>
			<?php dbnamesearch(); ?>
		</select>
		
		<select name="removecourt" id="removecourt">

		</select>
		<button onclick="RemoveCourt()">Ta bort</button>
	
	<!---------- js for toggle menu------->
	<script>
		var MenuItems = document.getElementById("MenuItems");

		MenuItems.style.maxHeight = "0px";

		function menutoggle(){
			if(MenuItems.style.maxHeight == "0px"){
				MenuItems.style.maxHeight = "200px"
			}
			else{
				MenuItems.style.maxHeight = "0px"
			}
		}
    </script>
    
	<script>
		
		function RemoveUser(){
			if(confirm("Är du säker på att du vill ta bort denna användare?"))
			e = document.getElementById("drop_2");
			var id = e.options[e.selectedIndex].value;
			window.location.assign("./RemoveUser.php?id="+id);
		}
		
		function AddCoach(){
			if(confirm("Vill du lägga till denna coach?")){
				var e = document.getElementById("drop_3");
				var arena_id = e.options[e.selectedIndex].value;
				var i = document.getElementById("drop_4");
				var user_id = i.options[i.selectedIndex].value;
				window.location.assign("./AddCoach.php?id="+user_id+"&arena_id="+arena_id);
			}
		}

		function RemoveArena(){
			if(confirm("Vill du ta bort arenan?")){
				var e = document.getElementById("arena_remove");
				var arena_id = e.options[e.selectedIndex].value;
				window.location.assign("./RemoveArena.php?id="+arena_id);
			}
		}

		function AddCourt(){
			if(confirm("Vill du lägga till denna bana?")){
				var e = document.getElementById("arena_court");
				var id = e.options[e.selectedIndex].value;
				var court = document.getElementById("courtname").value;
				var i = document.getElementById("intervall");
				var intervall = i.options[i.selectedIndex].value;
				window.location.assign("./AddCourt.php?id="+id+"&name="+court+"&intervall="+intervall);
			}
		}

		function Findcourts(){
			var xmlhttp = new XMLHttpRequest();
			var dbname;
			xmlhttp.onreadystatechange=function(){
				document.getElementById("removecourt").innerHTML=this.responseText;
				console.log(this.responseText);
			}
			var e = document.getElementById("court_remove");
			dbname = e.options[e.selectedIndex].value;
			xmlhttp.open("GET", "SearchCourt.php?dbname="+dbname, true);
			xmlhttp.send();			
			console.log(dbname);
		}

		function RemoveCourt(){
			if(confirm("Vill du tha bort denna bana?")){
				var e = document.getElementById("court_remove");
				var dbname = e.options[e.selectedIndex].value;
				var i = document.getElementById("removecourt");
				var courtid = i.options[i.selectedIndex].value
				window.location.assign("./RemoveCourt.php?dbname="+dbname+"&courtid="+courtid);
			}
		}
	</script>
</body>
</html>