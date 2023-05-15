<?php session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://localhost/MarmaladeCraft//StyleSheets/LoginStyle.css?ts=<?=time()?>">
	<link rel="stylesheet" href="http://localhost/MarmaladeCraft//StyleSheets/LoginBox.css?ts=<?=time()?>">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	
</head>
<body>
	<div class = "grid1">
		<div class = "logo" onclick="location.href='http://localhost/MarmaladeCraft/markupdocuments/WebsiteDesign.php';">logo</div>
		<div class="searchBar">
		</div>
		<div class = "login">
			<div class="ToolBarholder">
				<?php 
					if (isset($_SESSION["Email"])){
						echo "<div class='login' onclick=\"location.href='http://localhost/MarmaladeCraft/MarkupDocuments/MyAccountMenu.php';\"><p>My Account</p></div>";
					}else{
						echo "<div class='login' onclick=\"location.href='http://localhost/MarmaladeCraft/MarkupDocuments/LoginPage.php';\"><p>LOG IN/SIGN UP</p></div>";
					}
				?>
				<!--<div class="login" onclick="location.href='http://localhost/MarmaladeCraft/MarkupDocuments/LoginPage.php';"><p>LOG IN/SIGN UP</p></div> -->
				<div class="cart" onclick="location.href='http://localhost/MarmaladeCraft/MarkupDocuments/ShoppingCart.php?p=1';">
					<i class='fas fa-cart-arrow-down' style='font-size:24px'></i>
					<?php
					if (isset($_SESSION["sCart"])){
						//total amount of items in cart
						echo(array_sum(array_column($_SESSION["sCart"], 4)));
					}
					?>
				</div>
			</div>
		</div>
		<!--<div class="hamburger"></div>)-->
		<div class = "subpage">
			<!--due to formatting issues two sets of menus were created, area to improve upon -->
			<div class ="navbar">
				<div class="subCont" onclick="location.href='http://localhost/MarmaladeCraft/markupdocuments/WebsiteDesign.php';"><p>homepage</p></div>
				<div class = "subCont" onclick="location.href='http://localhost/marmaladeCraft/markupdocuments/Catalogue.php?p=1&Column=3&flip=0';"><p>catalogue</p></div>
				<div class = "subCont"><p>About</p></div>
				<div class = "subCont" onclick="location.href='http://localhost/marmaladeCraft/markupdocuments/ContactUs.php';"><p>Contact Information</p></div>
			</div>
			<nav>
				<input type = "checkbox" id="check">
				<label for="check" class = "checkbtn">
					<i class = "hamburger"><h2>&#9776</h2></i>
				</label>
				<ul>
					<li><a class ="active" href = "http://localhost/MarmaladeCraft/MarkupDocuments/WebsiteDesign.php">homepage</a></li>
					<li><a href = "http://localhost/MarmaladeCraft/MarkupDocuments/Catalogue.php">Catalogue</a></li>
					<li><a href = "#">About</a></li>
					<li><a href = "#">Contact Information</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="grid2">
		<div class="title">
			<div class ="Welcome"></div>
		</div>
		<div class ="content">
			<script type="text/javascript">
				//function based off source code from src: https://www.w3schools.com/js/js_validation.asp
			  function LoginValidateForm() {
			  	//Ensures all information is properly inputted
			    var a = document.forms["lForm"]["email"].value;
			    var b = document.forms["lForm"]["password"].value;
			    if (a == null || a == "" || b == null || b == "") {
			      alert("Please Fill All Required Fields");
			      return false;
			    }
			    return true;
			  }
			</script>
			<div class = "lDivider">
				<br>
				<h1>Login</h1>
				<br>
				<hr class="titleSolid">
				<div class="loginBox">
				  <div class = "fAlign">
					  <form method="post" onsubmit="return LoginValidateForm()" name = "lForm" action="../scripts/signon.php">
					  	<br>
					  	<label for="email"><h2>email</h2></label>
					    <p><input type="email" name="email" value="" placeholder="Email"></p><br>
					    <label for="password"><h2>password</h2></label>
					    <p><input type="password" name="password" value="" placeholder="Password"></p>
					    <p class="submit"><input type="submit" name="login" value="Login"></p>
					  </form>
					</div>
				</div>
			</div>
			<hr class="solid">
			<div class = "lDivider">
				<script type="text/javascript">
					//function based off source code from src: https://www.w3schools.com/js/js_validation.asp
				  function SignUpValidateForm() {
				  	//Ensures all information is properly inputted
				  	var a = document.forms["sForm"]["Name"].value;
				    var b = document.forms["sForm"]["email"].value;
				    var c = document.forms["sForm"]["password"].value;
				    if (a == null || a == "" || b == null || b == "" || c == null || c == "") {
				      alert("Please Fill All Required Fields");
				      return false;
				    }
				    return true;
				  }
				</script>
				<br>
				<h1>Sign Up</h1>
				<br>
				<hr class="titleSolid">
				<div class="loginBox"> <!--css is identical so class loginBox is shared-->
				  <div class = "fAlign">
					  <form method="post" name="sForm" onsubmit="return SignUpValidateForm()" action="../scripts/process.php" method="post">
					  	<br>
					  	<label for="Name"><h2>full name</h2></label>
					    <p><input type="text" name="Name" value="" placeholder="FullName"></p>
					  	<br>
					  	<label for="email"><h2>email</h2></label>
					    <p><input type="email" name="email" value="" placeholder="Email"></p><br>
					    <label for="password"><h2>password</h2></label>
					    <p><input type="password" name="password" value="" placeholder="Password"></p>
					    <p class="submit"><input type="submit" name="signup" value="Register"></p>
					  </form>
					</div>
				</div>
			</div>
		</div>
		<div class="sidebar">	
		</div>
		<div class ="footer"><p>footer</p></div>
	</div>
</body>
</html>
