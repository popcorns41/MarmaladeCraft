<?php 
	if (!isset($_SESSION)) { 
			session_start(); 
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://localhost/MarmaladeCraft//StyleSheets/LoginStyle.css?ts=<?=time()?>">
	<link rel="stylesheet" href="http://localhost/MarmaladeCraft//StyleSheets/MyAccStyle.css?ts=<?=time()?>">
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
					<li><a href = "http://localhost/marmaladeCraft/markupdocuments/Catalogue.php?p=1&Column=3&flip=0">Catalogue</a></li>
					<li><a href = "#">About</a></li>
					<li><a href = "http://localhost/marmaladeCraft/markupdocuments/ContactUs.php">Contact Information</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="grid2">
		<div class="title">
			<div class ="Welcome">
				<?php 
					if (isset($_SESSION["fullName"])){
						echo "<h4>Account of ".$_SESSION["fullName"]."</h4>";
					}else{
						header("location: http://localhost/marmaladeCraft/markupdocuments/WebsiteDesign.php");
					}
				?>
				<div class ="Logout">
					<form action="../scripts/acc_Menu.php" method="post">
					    <input type="submit" name = "logout" value="logout">
					</form>
				</div>
			</div>
		</div>
		<div class ="content">
			<div class = "ATitle"><h1>Address Information</h1>
			<br>
			<hr class="titleSolid">
			</div>
			<div class ="Address">
				<form action="../scripts/aUpload.php" method="post">
					<label for="addressLine"><h2>Address line</h2></label>
					<input type="text" name="addressLine" require><br>
					<label for="Town"><h2>Town/City</h2></label>
				    <input type="text" name="Town" require><br>
				    <label for="ZipCode"><h2>zipcode</h2></label>
				    <input type="text" name="ZipCode" require><br>
				    <p class = "submit"><input type="submit" name = "finish" value="Update"></p>
				</form>
			</div>
		</div>
		<div class="sidebar">	
		</div>
		<div class ="footer"><p>footer</p></div>
	</div>
</body>
</html>
