<?php
	include("config.php");
	include("login_session.php");
	if (!isset($_SESSION['bk'])) {
        header("Location:search.php");
    } else {
        unset($_SESSION['bk']);
    }
	$did = "'".$_SESSION['did']."'";
    $aID = $_SESSION['aid'];
    $title = $_SESSION['book'];
    $coachid = $_GET['coachid'];
    $who = 0;
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $who = $_SESSION['lid'];
    }
    $sql = "SELECT * FROM users WHERE id = '$coachid'";
    $result = mysqli_query($db, $sql);
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Website | Shop Design</title>
	<link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/accountPage.css">
    <link rel="stylesheet" href="css/media.css">
	<link rel="stylesheet" href="css/coachpage.css">
	<link rel="stylesheet" href="css/bookingpage.css">
	<script src="javabois/coachW.js"></script>
	<script type="text/javascript">	var DAY = 0; </script>
</head>
<body onload="giveTable(<?php echo $did ?>,DAY,<?php echo $who ?>,<?php echo $aID ?>,<?php echo $coachid ?>)">
	<div class="header">
		<div class="container"  style="padding-bottom:16em;">
			<div class="navbar">
				<div class="logo">
					<a href="index.php"><img src="images/logo1.png" height="150"></a>
				</div>
				<nav>
                	<ul class="MenuItems" id="MenuItems">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="search.php">Book</a></li>
						<li><a href ="<?php echo $drop_url;?>"><?php echo $drop_name;?></a></li>
                        <li><a href ="<?php echo $drop_profile_url;?>"><?php echo $drop_profile;?></a></li>
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
                            <h3>Rank <?php echo $row["playrank"];?></h3>
                        </div>    
                    </div>
                    <div class = "box2">
                        <div class =" child1">
                            <h2> <?php echo $row["firstname"] ." ". $row["lastname"];?></h2>
                        </div>  
                        <div class =" child2">
                            <h3> Tränare </h3>
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
						<h2> Info </h2>
					</div>
					<div class= "content">
						<p><?php echo $row["info"];?></p>
					</div>
				</div>
				<div class ="book-cont" style="width:100%;">
					<div class="arenaname">
						<p> <?php echo $title ?> </p>
					</div>
					<div class="date-box">
						<div class ="date-choise">
							<div>
								<button onclick="giveTable(<?php echo $did ?>,(--DAY),<?php echo $who ?>,<?php echo $aID ?>,<?php echo $coachid ?>)" class="btn next round" class="previous round" style="padding: 8px 16px;  text-decoration: none; display: inline-block;">&#8249;</button>
							</div>
							<div class ="date" id="dboi"></div>
							<div>
								<button onclick="giveTable(<?php echo $did ?>,(++DAY),<?php echo $who ?>,<?php echo $aID ?>,<?php echo $coachid ?>)" class="btn next round" style="padding: 8px 16px;  text-decoration: none; display: inline-block;">&#8250;</button>
							</div>
						</div>
					</div>
					<div class="book-item" id="booker">
					</div>
				</div>
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
</body>
</html>
