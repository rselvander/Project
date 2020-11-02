<?php
    include("login_session.php");
    if (!isset($_SESSION['fs'])) {
        header("Location:search.php");
    } else {
        $_SESSION['book'] = $_GET['book'];
        $_SESSION['did'] = $_GET['did'];
        $_SESSION['aid'] = $_GET['aid'];
        unset($_SESSION['fs']);
        $_SESSION['bk'] = true;
    }
    $title = $_SESSION['book'];
    include ("coaches.php");
    $did = "'".$_SESSION['did']."'";
    $aID = $_SESSION['aid'];
    $who = 0;
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $who = $_SESSION['lid'];
    }
    $_SESSION['prev'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PadelBooker | Raise your rackets</title>
	<link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/accountPage.css">
    <link rel="stylesheet" href="css/media.css">
	<link rel="stylesheet" href="css/brands.css">
	<link rel="stylesheet" href="css/bookingpage.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="javabois/gitTableW.js"></script>
	<script type="text/javascript">	var DAY = 0; </script>
</head>
<body onload="giveTable(<?php echo $did ?>,DAY,<?php echo $who ?>,<?php echo $aID ?>)">
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
						<li><a href ="<?php echo $drop_profile_url;?>"><?php echo $drop_profile;?></a></li>
                    </ul>
                </nav>
				<img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
			</div>

			<div class ="big-cont">
				<div class="book-cont">
					<div class="arenaname">
						<p> <?php echo $title ?> </p>
					</div>
					<div class="date-box">
						<div class ="date-choise">
							<div>
								<button onclick="giveTable(<?php echo $did ?>,(--DAY),<?php echo $who ?>,<?php echo $aID ?>)" class="btn next round" class="previous round" style="padding: 8px 16px;  text-decoration: none; display: inline-block;">&#8249;</button>
							</div>
							<div class ="date" id="dboi"></div>
							<div>
								<button onclick="giveTable(<?php echo $did ?>,(++DAY),<?php echo $who ?>,<?php echo $aID ?>)" class="btn next round" style="padding: 8px 16px;  text-decoration: none; display: inline-block;">&#8250;</button>
							</div>
						</div>
					</div>
					<div class="book-item">
						<div class="bigboi" id="bigboi"></div>
					</div>
				</div>
				<div class="coaches">
					<div class="mini-container">
						<h3 style="text-align: center;">Tränare</h3>
						<?php coaches(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="brands">
		<div class="small-container">
			<div class="rows">
				<div class="col-5">
					<img src="images/klarna.png">
				</div>
				<div class="col-5">
					<img src="images/visa.png">
				</div>
				<div class="col-5">
					<img src="images/mastercard.png">
				</div>
				<div class="col-5">
					<img src="images/bankid-logo.png">
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
	<script>
		function coachpage(coachid){
			window.location.assign("./coachpage.php?coachid="+coachid);
		}
	</script>
</body>
</html>