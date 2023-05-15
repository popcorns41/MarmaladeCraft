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
	<link rel="stylesheet" type="text/css" href="http://localhost/MarmaladeCraft//StyleSheets/CatalogueStyle.css?ts=<?=time()?>" />
	<link rel="stylesheet" type="text/css" href="http://localhost/MarmaladeCraft/StyleSheets/GridStyle.css?ts=<?=time()?>" />
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
			<div class ="Welcome"></div>
		</div>
		<div class ="content">
			<?php
				//functions for reading DB accessed through included file
				include "../Scripts/DBFunctions.php";
				//Amount of cells per page limit of upto 9 for design reasons
				$cellTotal = 9;
				//specific column titles and table name needed from database
				$cInfo = ["ProductID","Title","Price","TotalPurchases","Stock"];
				$tInfo = "product";
				//2D array of specific information desired to be displayed
				$ItemList = GatherFromDB($tInfo,$cInfo,0,"","");
				$Column = $_GET["Column"];
				$Flip = $_GET["flip"];
				//Sorting function for ItemList, 
				$ItemList = SortProduct($ItemList,$Column,$Flip);
				print_r($ItemList);
				$iLength = sizeof($ItemList);
				//ceil is a built in php function that rounds a value to the nearest whole interger, this is used to determine the quantity of pages for the catalogue
				$pTotal = ceil($iLength / $cellTotal);
				$pNumbers = [];
				//for loop to store page numbers into an array 
				for ($p = 1;$p <= $pTotal; $p++){
					array_push($pNumbers,$p);
				}
			?>
			<div class = "GridBorder">
				<div class = "header">
					<div class = "SortBy">
						<div class ="sInput">
							<form id="sForm" action="../scripts/SortCatalogue.php" method="post">
								<label for="Sort">Sort By:</label>
								<select name="Sort" id="SortSelect">
								  <option value="MostBought">Most popular</option>
								  <option value="PriceL">Price: low -> high</option>
								  <option value="PriceH">Price: high -> low</option>
								  <option value="NewP">Newest Product</option>
								  <option value="OldP">Oldest Product</option>
								</select> 
								<input type="submit" name ="Submit" value="Submit">
							</form>
							<div class = "Pages">
					            <ul>
					                <li>pages:</li>
					                <?php
					                	for ($i = 0;$i < $pTotal; $i++){
					                		echo("<li><a href ='http://localhost/marmaladeCraft/markupdocuments/Catalogue.php?p=".$pNumbers[$i]."&Column=".$_GET["Column"]."&flip=".$_GET["flip"]."'>".$pNumbers[$i]."</a></li>");
					                		//only add a slash if not at the final page
					                		if ($i != ($pTotal-1)){
					                			echo("<li> / </li>");
					                		}
					                	}
					                ?> 
						        </ul>
							</div>
						</div>
					</div>
				</div>
				<div class = "catalogue">
					<?php
					//Products change depending on page number following this arithmetic sequence 
					$cellTotal = 9;
					//$_GET["p"] is the page number a user is on, this will be displayed in the url of the page
					$iAddon = $cellTotal * ($_GET["p"]-1);
					$i=0;
					//creating of grid is governed by two conditions 1. squares do not go over length of ItemList array 2. does not go over 9 squares
					while(($i<sizeof($ItemList)-$iAddon) and $i<$cellTotal){
						$pAdd = $i + $iAddon;
						//specific details needed from ItemList coresponding their index as var i
						$photo = "<div class = 'CataPhoto'><img src='../StaticImages/ProductPictures/ProductID".$ItemList[$pAdd][0]."/IconImage.jpg'></div>"; //picture information yet to be added will be implemented shortly
						$ProductName = "<h5 class = 'ProductName'><b>".$ItemList[$pAdd][1]."</b></h5>";
						$Price = "<h4 class = 'Price'>Price: ".$ItemList[$pAdd][2]."</h4>";
						//if item is out of stock the button will change display and won't provide a link to that item's item page
						if ($ItemList[$pAdd][4] == 0){
							$buyButton = "<div class = 'buyButton'><p style='color:gray;'>item out of stock</p></div>";
						}else{
							$buyButton = "<a href='http://localhost/marmaladecraft/markupdocuments/ItemDesign.php?ProductID=".$ItemList[$pAdd][0]."'><div class = 'buyButton' id='interactButton'><p>Press here to view</p></div></a>";
						}
						//output <div id="GridDiv" style="grid-area: var i + grid" class="var i + grid">var photo var ProductName var buyButton</div>
						echo "<div id='GridDiv' style='grid-area: ".$i."grid'"." class = "."'".$i."grid'".">".$photo.$ProductName.$Price.$buyButton."</div>";
						//increment var i by 1
						$i++;
					}
					?>
				</div>
		
			</div>
		</div>
		<div class ="footer"><p>footer</p></div>
	</div>
</body>
</html>
