<?php 
	if (!isset($_SESSION)) { 
		session_start(); 
	}
	
	include "../scripts/process.php"; 
	include "../scripts/DBFunctions.php";
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="http://localhost/MarmaladeCraft/StyleSheets/HPStyle.css?ts=<?=time()?>" />
	<link rel="stylesheet" type="text/css" href="http://localhost/MarmaladeCraft/StyleSheets/ItemDisplay.css?ts=<?=time()?>" />
	<link rel="stylesheet" type="text/css" href="http://localhost/MarmaladeCraft/StyleSheets/aStyle.css?ts=<?=time()?>" />
	<!-- Icons from src: https://www.w3schools.com/icons/fontawesome5_icons_payment_shopping.asp-->
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
					echo "<h4>Welcome ".$_SESSION["fullName"]."</h4>";
				}else{
					echo "<h4>Welcome User</h4>";
				}
			?>
			</div>
		</div>
		<div class="header"> <!--divider div??? it'll look nice doe-->
			<div class="social">
				<!--grids will used as a formatting for this section, currently just based off the template provided by dreamweaver, gotta have that flexibility-->
    			<p class="social_icon"><img src="file:///C|/Users/Oliver/AppData/Roaming/Adobe/Dreamweaver 2020/en_US/Configuration/Temp/Assets/eam71CB.tmp/images/bkg_06.jpg" width="100" alt="" class="thumbnail"/></p>
    			<p class="social_icon"><img src="file:///C|/Users/Oliver/AppData/Roaming/Adobe/Dreamweaver 2020/en_US/Configuration/Temp/Assets/eam71CB.tmp/images/bkg_06.jpg" width="100" alt="" class="thumbnail"/></p>
    			<p class="social_icon"><img src="file:///C|/Users/Oliver/AppData/Roaming/Adobe/Dreamweaver 2020/en_US/Configuration/Temp/Assets/eam71CB.tmp/images/bkg_06.jpg" width="100" alt="" class="thumbnail"/></p>
    			<p class="social_icon"><img src="file:///C|/Users/Oliver/AppData/Roaming/Adobe/Dreamweaver 2020/en_US/Configuration/Temp/Assets/eam71CB.tmp/images/bkg_06.jpg" width="100" alt="" class="thumbnail"/></p>
  			</div>
		</div>
		<div class ="content">
			<div class="ItemShowcase">
				<div class ="PreviewGrid">
					<div class="textDisplay">
						<?php
							$bInfo = ["Title","Description"];
							$tInfo = "product";
							$hList = GatherFromDB($tInfo,$bInfo,1,"ProductID",1);
							echo '<div class = "itemSelection"><p>Gallery of FaceMasks</p></div>'; 
							echo '<div class = "Comments"><p>'.$hList[1].'</p></div>';
						?>
				</div>
					<div class="PhotoDisplay">
						<div class="navigation-dots">
							</div>
						<div class="wrapper">
							<div class="slides-container">
								<div class="slide-image">
									<img src="../StaticImages/ProductPictures/ProductID1/IconImage.jpg" alt = "IconImage" height="400" width="450">
								</div>
								<div class="slide-image">
									<img src="../StaticImages/ProductPictures/ProductID5/IconImage.jpg" alt = "IconImage1" height="400"  width="450">
									<!--<img src="https://cdn.drawception.com/images/panels/2015/3-25/jS9K2PwcQE-2.png" alt = "monkey" height="400">-->
								</div>
								<div class="slide-image">
									<img src="../StaticImages/ProductPictures/ProductID3/IconImage.jpg" alt = "IconImage2" height="400"  width="450">
									<!--<img src="https://cdn.drawception.com/images/panels/2017/12-21/y8SCGwCrmx-12.png" alt = "monkey" height="400">-->
								</div>
								<div class="slide-image">
									<img src="../StaticImages/ProductPictures/ProductID4/IconImage.jpg" alt = "IconImage3" height="400"  width="450">
								</div>
							</div>
						</div>
					</div>
					<script src="../Scripts/Slideshow.js"></script>
				</div>
			</div>
		</div>
		<div class="sidebar">
			<div class="aBoard">
				<div class="aTitle"><h1>ACCOUNCEMENTS</h1></div>
				<div class="aInfo">
					<div class="announcement">a</div>
					<div class="announcement">b</div>
					<div class="announcement">c</div>
					<div class="announcement">d</div>
					<div class="announcement">e</div>
				</div>
			</div>
		</div>
		<div class ="footer"><p>footer</p></div>
	</div>
</body>
</html>
