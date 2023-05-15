<?php session_start(); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://localhost/MarmaladeCraft//StyleSheets/ItemStyle.css?ts=<?=time()?>">
	<link rel="stylesheet" href="http://localhost/MarmaladeCraft//StyleSheets/ItemDisplayStyle.css?ts=<?=time()?>"> 
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
			<div class ="Welcome"><h5>All items are sent first class via royal mail (UK delivery only).</h5></div>
		</div>
		<div class ="content">
			<?php 
				//Importing information from the database about the current product a user is browsing
				include "../Scripts/DBFunctions.php";
				$pID = $_GET["ProductID"];
				$iInfo = ["Title","Description","Price","Stock","ProductType","Colour","Fabric","Adjustable","TotalPurchases"];
				$tInfo = "product";
				$ItemList = GatherFromDB($tInfo,$iInfo,1,"ProductID",$pID);
				//calculates quantity of this given item already in the shopping cart, preventing an order that goes over stock number. Error with multiple stocks
				if (isset($_SESSION["sCart"]) and (sizeof($_SESSION["sCart"]) > 0) and in_array($pID, array_column($_SESSION["sCart"],0))){
					$key = array_search($pID, array_column($_SESSION["sCart"],0));
					$QInCart = $_SESSION["sCart"][$key][4];
				}else{
					$QInCart = 0;
				}
			?>
			<div class ="displayGrid">
				<div class = "photoInfo">
					<div class="displayblock">
							<div class="wrapper">
								<div class="slides-container">
									<?php
									echo('<div class="slide-image">
										<img src="../StaticImages/ProductPictures/ProductID'.$pID.'/IconImage.jpg" alt = "1" height="450" width="100%">
									</div>
									<div class="slide-image">
										<img src="../StaticImages/ProductPictures/ProductID'.$pID.'/AddImage1.jpg" alt = "1" height="450">
									</div>
									<div class="slide-image">
										<img src="../StaticImages/ProductPictures/ProductID'.$pID.'/AddImage2.jpg" alt = "1" height="450">
									</div>
									<div class="slide-image">
										<img src="../StaticImages/ProductPictures/ProductID'.$pID.'/AddImage3.jpg" alt = "1" height="450">
									</div>')
									?>
								</div>
							</div>
						<div class="navigation-dots">
						</div>
					</div>
					<script src="../scripts/PhotoGalleryAnimation.js"></script>
					<div class="navigation-dots"></div>
				</div>
				<div class = "buyInfo">
					<div class = "adaptableText">
						<?php 
							$rStock = $ItemList[3]-$QInCart;
							//Information about the product taken from Itemlist
							echo "<br><h3>".$ItemList[0]."</h3><br><hr style='border: 1px solid black;width: 90%;margin: auto;'><br>";
							echo "<p>".$ItemList[1]."</p>";
							echo "<br><hr style='border: 1px solid black;width: 90%;margin: auto;'><br>";
							echo "<h3>Pricing: £".$ItemList[2]."</h3><br><hr style='border: 1px solid black;width: 90%;margin: auto;'><br>";
							if ($rStock == 0){
								echo"<p style='color: red;'>All avaliable stock is in your cart";
							}else if ($rStock < 5){
								echo"<p style='color: red;'>Hurry! Only ".($rStock)." left!</p>";
							}else if ($ItemList[3] == 0){
								echo '<script type="text/javascript">
					 				alert("Item is currently out of stock, please come back another time");
									location="http://localhost/marmaladeCraft/markupdocuments/Catalogue.php?p=1&Column=3&flip=0";
					 				</script>'; 
							}
						?>
						<h2>Quantity</h2><br>
						<script type="text/javascript">
							function QuantityCheck(){
								//function to make sure user isn't inputing a higher quantity than avaliable stock
								//var q accounts for the quantity of items matching the given ID number of currently viewed Item
								var Stock = <?php echo ($ItemList[3]-$QInCart) ?>;
								var a = document.forms["Insert"]["Quantity"].value;
								if (Stock < a){
									alert("appologies there are currently only " + Stock + " of this item remaining, please reinput quantity.");
									return false;
								}
								return true;
							}
						  function validateForm() {
						  	//Warning to the user if they purchase an input without filling in all the required fields
						    var a = document.forms["Insert"]["Quantity"].value;
						    if (a == null || a == "") {
						      alert("Please fill all required fields");
						      return false;
						    }
						    return true;
						  }
						</script>
						<form name = "Insert" onsubmit="return validateForm() && QuantityCheck()" action = "../scripts/AddToCart.php" method = "post">
							<input type="number" name="Quantity"><br><br><hr style='border: 1px solid black;width: 90%;margin: auto;'><br>
							<p class="submit"><input type="submit" name="aCart" value="Add to Cart"></p> 
							<input type="hidden" name="ProductID" value="<?php echo($pID)?>">
						</form>
						<div class = "AddCart"></div>
					</div>
				</div>
			</div>
		</div>
		<script src="PhotoGalleryAnimation.js"></script>
		<div class="sidebar">
			<hr style='border: 1px solid black;width: 100%;margin: auto;'>
			<div class="oDetails">
				<div class = "mDetails">
					<div class = "sOpinion"><h1>Product and Delivery details</h1></div>
				</div><br>
				<div class = "sDetails">
					<div class = "dContent"><h2>
						<?php
							$ProductType = $ItemList[4];
							$Colour = $ItemList[5];
							$Fabric = $ItemList[6];
							$Adjustable = $ItemList[7];
							if ($Adjustable == 1){
								$dAdjustable = "Yes";
							}else{
								$dAdjustable = "No";
							}

							echo "Product type: ".$ProductType."<br><br>";
							echo "Colour: ".$Colour."<br><br>";
							echo "Fabric: ".$Fabric."<br><br>";
							echo "Adjustable: ".$dAdjustable."<br><br>";
						?>
						<hr style='border: 0.5px solid black;width: 98%;'>
						<br>
						a non medical facial mask which will help with the relaxation of the social distancing advice for public transport etc.<br>
						<br>
						Soft and easy to wear.<br>
						<br>
						Only UK deliver.<br>
						Dispatched with Royal Mail 1st Class Large Letter.<br>
						<br>
						WASHING INSTRUCTIONS<br>
						Hand wash or machine wash gentle cycle (up to 40 degrees Celsius) . Hang dry.<br>
						Do not tumble dry.<br>
						Reshape whilst damp.<br>
						<br>
						Can be ironed at MEDIUM temperature.<br>
						<br>
						Do not iron elastics.<br>
						<br>
						Please wash before use. <br>
						</h2></div>
				</div>
			</div>
		</div>
		<div class ="footer"><p>footer</p></div>
	</div>
</body>
</html>
