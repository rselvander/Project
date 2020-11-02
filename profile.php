<?php
	include("config.php");
	include("login_session.php");
	if (! isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=  true){
		header("Location: index.php");
	}
	$username = $_SESSION["username"];
	$sql = "SELECT * FROM users WHERE email = '$username'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
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
	<?php if(isset($_SESSION['iscoach'])) {
		echo "<script src='javabois/coach.js'></script>";
		echo "<script type='text/javascript'> var DAY = 0; </script>";
	} ?>
</head>
<body  onload="start()">
	<div class="header">
		<div class="container">
			<div class="navbar">
				<div class="logo">
					<a href="index.php"><img src="images/logo1.png" height="150"></a>
				</div>
				<nav>
                	<ul class="MenuItems" id="MenuItems">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="search.php">Book</a></li>
						<li><a href="<?php echo $drop_url; ?>"><?php echo $drop_name; ?></a></li>
						<li><a href="<?php echo $drop_admin_url; ?>"><?php echo $drop_admin; ?></a></li>
                    </ul>
                </nav>
				<img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
			</div>

			<div class ="big-cont">
				<div class="prof-box">
                    <div class ="box1">
                        <div class="child1">
                            <img src=<?php echo $row["imgurl"];?> > 
                        </div>
					    <div class ="child2">
                            <p> Rank <?php echo $row["playrank"];?></p>
                        </div>    
                    </div>
                    <div class = "box2">
                        <div class =" child1">
                            <h2> <?php echo $row["firstname"] ." ". $row["lastname"];?></h2>
                        </div>  
                        <div class =" child3">
                            <p> <?php echo $row["email"];?></p>
                        </div> 
                        <div class =" child3">
                            <p><?php echo $row["phone"];?></p>
                        </div> 
                    </div>
				</div>

				<div class ="bio">
					<div class ="head">
						<h2>Info</h2>
					</div>
					<div class= "content">
						<p><?php echo $row["info"];?></p>
					</div>
				</div>
				<div class ="choice-box" >
					<div class =" choice first">
						<a href="search.php" class="btn">Boka nu</a>
					</div>
					<div class ="choice">
						<button class="btn" onclick="showform()">Redigera profil</button>
					</div>
				</div>
				<div class ="pinfo">
					<div class="phead">
						<p> Dina bokningar </p>
					</div>
					<div class="divider"></div>
					<div class="pbookings">
						<div class ="pcol">
							<div class ="pwhen">
								<p><?php 
									$qry = "SELECT users.email, booking.court_id, booking.courtname, TIME(booking.dateTimeStart) AS StartTime, 
									DATE(booking.dateTimeStart) AS StartDate, TIME(booking.dateTimeEnd) AS EndTime, 
									DATE(booking.dateTimeEnd) AS EndDate, arenas.name, userbooking.booking_id, users.id, coachbooking.coach_id FROM users 
									LEFT JOIN userbooking ON users.id = userbooking.user_id 
									LEFT JOIN booking ON userbooking.booking_id = booking.id
									LEFT JOIN arenas ON booking.arena_id = arenas.id 
									LEFT JOIN coachbooking ON coachbooking.book_id = booking.id
									WHERE users.email = '$username' AND booking.court_id IS NOT NULL AND booking.dateTimeStart >= NOW()
									ORDER BY booking.dateTimeStart ASC";
									if($res = mysqli_query($db, $qry)){
										if(mysqli_num_rows($res) > 0){
											echo "<table style='border-collapse: collapse;'>";
											echo "<tr>";
											echo "<th>Datum</th>";
											echo "<th>Tid</th>";
											echo "<th>Plats</th>";
											echo "<th>Bana</th>";
											echo "<th>Coach</th>";
											echo "<th></th>";
											echo "<th>Avboka</th>";
											echo "</tr>";
											while($lines = mysqli_fetch_array($res)){
												echo "<tr style='height: 10px;'>";
												echo "<td style='padding: 0 10px 0 0;'>" . $lines['StartDate'] . "</td>";
												echo "<td style='padding: 0 10px 0 0;'>" . substr($lines['StartTime'],0,-3) . " - ". substr($lines['EndTime'],0,-3). "</td>";
												echo "<td style='padding: 0 10px 0 0;'>" . $lines['name'] . "</td>";
												echo "<td style='padding: 0 10px 0 0;'>" . $lines['courtname'] . "</td>";
												if(!is_null($lines['coach_id'])){
													echo "<td style='padding: 0 10px 0 0;'>" . 'JA' . "</td>";
												}
												else{
													echo "<td style='padding: 0 10px 0 0;'>" . 'NEJ' . "</td>";
												}
												echo "<td style='padding: 0 10px 0 0;'>"."</td>";
												echo "<td style='padding: 0 10px 0 0;'>  <button type='button' class='btn' onclick='delbook(";
												echo $lines['id'];
												echo ",";
										 		echo $lines['booking_id'];
												echo ")'>X</button>";
												echo "</tr>";
											}
											echo "</table>";
											mysqli_free_result($res);
										}
										else{
											echo "Inga bokningar";
										}
									}
									else{
										echo "could not run $qry. " . mysqli_error($db);
									}
								?>
								<script>
									function delbook(id, bi)
									{
										if(confirm("Sure you want to delete booking?")){
											window.location.assign("deleteinfo.php?id="+ id + "&bi=" + bi);
										}	
									}
								</script>
 							</div>
						</div>
					</div>
					<div class="divider"></div>
				</div>
			</div>	
			<div class="big-cont" id="formcontainer">
				<form class="form-popup" enctype="multipart/form-data" action="updateinfo.php?id=<?php echo $row['id']?>" method="POST">
					<div class ="manage-box">
						<div class="row1">
							<div class="col1">
								<b>Namn</b>
								<b>Email</b>
								<b>Adress</b>
								<b>Rank</b>
							</div>
							<div class ="col1">
								<input class="child2" type="text" id="fname" name="fname" value="<?php echo $row["firstname"]; ?>" required>
								<input class="child2" type="text" id="email" name="email" value="<?php echo $row["email"]; ?>" required>
								<input class="child2" type="text" id="adress" name="adress" value="<?php echo $row["street"];?>" placeholder="Street">	
								<input class="child2" type="number" id="playrank" name="playrank" value="<?php echo $row["playrank"]; ?>" placeholder="Rank">
							</div>
							<div class ="col1">
								<b>Efternamn</b>
								<b>Telenfonnr</b>
								<b>Postnr</b>
							</div>
							<div class ="col1">
								<input class="child2" type="text" id="lname" name="lname" value="<?php echo $row["lastname"]; ?>" required>
								<input class="child2" type="text" id="phone" name="phone" value="<?php echo $row["phone"]; ?>" placeholder="Phone">
								<input class="child2" type="text" id="zip" name="zip" value="<?php echo $row["zip"]; ?>" placeholder="Zip">
							</div>
						</div>
						<div class="row2">
							<br><b>Info</b> <br><textarea class="contentform" class="bio" type="text" id="info" name="info" placeholder="Bio"> <?php echo $row["info"];?> </textarea>
						</div>
						<div class="row2">
							<p> Välj Profilbild </p>
							<input type="file" name="file">
						</div>
						<br>
						<button type="submit" class="btn">Spara</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="footer-col-1">
					<h3>Download Our App</h3>
					<p>This app is for Apple and Android</p>
					<div class="app-logo">
						<img src="images/download.png">
					</div>
				</div>
				<div class="footer-col-2">
					<img src="images/logo1.png">
				</div>
				<div class="footer-col-3">
					<h3>Useful Links</h3>
					<ul>
						<li><a href="<?php echo $url?>" style="color:gray;"><?php echo $menu_button?></a></li>
						<li><a href="./search.php" style="color:gray;">Book </a></li>
					</ul>
				</div>
				<div class="footer-col-4">
					<h3>Follow us</h3>
					<ul>
						<li>Facebook</li>
						<li>Twitter</li>
						<li>Instagram</li>
						<li>Youtube</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<script>
	//js for toggle menu
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
	<script type="text/javascript">
		function start(){
			document.getElementById("formcontainer").style.display = "none";
		}
		function showform(){
			document.getElementById("formcontainer").style.display = "block";
			scrollTo(0,document.getElementById("formcontainer").offsetTop);
		}
	</script>
</body>
</html>