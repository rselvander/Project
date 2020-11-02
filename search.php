<?php
	include("config.php");
	include("login_session.php");
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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="header">
		<div class="container" style="padding-bottom:16em;">
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
						<li><a href="<?php echo $drop_admin_url; ?>"><?php echo $drop_admin; ?></a></li>
                	</ul>
                </nav>
				<img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
			</div>
			<div class="row col-2">
				<div class="col-2">
                    <h1>Hitta anläggningar och boka tid</h1>  
                    <div class="search-box">
						<input type="text" placeholder="Search" onkeyup="showResult(this.value)">
						<div id="livesearch"></div>
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
	<script type="text/javascript">
	//livesearch with the help of javascript
		function showResult(str) {
		if (str.length==0) {
			document.getElementById("livesearch").innerHTML="";
			document.getElementById("livesearch").style.border="0px";
			return;
		}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
			if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="1px solid #A5ACB2";
			}
		}
			xmlhttp.open("GET","backend-search.php?q="+str,true);
			xmlhttp.send();
		}
	</script>
</body>
</html>