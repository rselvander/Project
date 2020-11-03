<?php
    include("config.php");
    include("login_session.php"); 
    if(!isset($_SESSION['prev'])) {
        $_SESSION['prev'] = '/project/index.php';
    }
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
</head>
<body>
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
                    </ul>
                </nav>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="images/img1.png" width="100%">
                </div>

                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="Indicator">
                        </div>

                        <?php if (isset($_SESSION['errors'])): ?>
                        <br>
                        <div class="form-errors">
                            <?php foreach($_SESSION['errors'] as $error): ?>
                            <p style="color: red;"><?php echo $error ?></p>
                            <?php endforeach; unset($_SESSION['errors']); ?>    
                        </div>
                        
                        <?php endif; ?>
                        <form id="LoginForm" action="logprocess.php" method="POST">
                            <input type="text" id ="loguser" name="loguser" placeholder="Email" required>
                            <input type="password" id ="logpass" name="logpass" placeholder="Password" required>
                            <button type="submit"  id="btn" value="login" class="btn">Login</button>
                        </form>

                        <form id="RegForm" action="regprocess.php" method="POST">
                            <input type="text" id ="regfname" name="regfname" placeholder="Firstname" required> 
                            <input type="text" id ="reglname" name="reglname" placeholder="Lastname" required>
                            <input type="text" id="regemail" name="regemail" placeholder="Email" required>
                            <input type="password" id ="regpass" name="regpass" placeholder="Password" required>
                            <button type="submit"  id="btn" value="register" class="btn">Register</button>
                        </form>
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

    <script>
    //js for toggle form
        var LoginForm = document.getElementById("LoginForm");
        var RegForm = document.getElementById("RegForm");
        var Indicator = document.getElementById("Indicator");

        function login(){
            LoginForm.style.transform = "translateX(0px)";
            RegForm.style.transform = "translateX(-300px)";
            Indicator.style.transform = "translateX(0px)";
        }

        function register(){
            LoginForm.style.transform = "translateX(300px)";
            RegForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(100px)";
        }
    </script>
</body>
</html>
