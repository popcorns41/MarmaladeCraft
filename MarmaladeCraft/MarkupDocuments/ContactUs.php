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
	<link rel="stylesheet" href="http://localhost/MarmaladeCraft//StyleSheets/CpageStyle.css?ts=<?=time()?>">
	<link rel="stylesheet" href="http://localhost/MarmaladeCraft//StyleSheets/ContactBox.css?ts=<?=time()?>">
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
		<div class = "content">
			<div class = "filler"></div>
			<div class="container">
					
					<h1>Contact us</h1>
					<br>		
					<p>Please contact us by completing the form below.</p>
					<br>
					<form method="post" action="../scripts/ContactScript.php">

						<div class="col3">

							<p><label for="formname">Name:</label><br>
							<input name="name" id="formname" type="text" value="" class="textbox"></p>
							
						</div>
						
						<div class="col3">

							<p><label for="formtel">BundleID (optional)</label><br>
							<input name="ID" id="formtel" type="text" value="" class="textbox"></p>

						</div>

						<div class="col3 last">
						
							<p><label for="formemail">Email address:</label><br>
							<input name="email" id="formemail" type="text" value="" class="textbox"></p>

						</div>
						
						<p class="clear"><label for="formmessage">Message:</label><br>
						<!-- <pre> saves user line breaks-->	
						<pre><textarea name="message" id="formmessage" rows="10" cols="10"></textarea></pre></p>
						<br>
						<div class="textright">		
											
							<p><input type="submit" name="form_submitted" value="Submit" class="button"></p>

						</div>

					</form>
				</div>
			</div>
		<div class="sidebar">	
		</div>
		<div class ="footer"><p>footer</p></div>
	</div>
</body>
</html>
