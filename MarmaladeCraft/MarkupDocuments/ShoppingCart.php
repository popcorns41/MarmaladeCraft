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
	<link rel="stylesheet" type="text/css" href="http://localhost/MarmaladeCraft/StyleSheets/CStyle.css?ts=<?=time()?>" />
	<link rel="stylesheet" type="text/css" href="http://localhost/MarmaladeCraft/StyleSheets/CartStyle.css?ts=<?=time()?>" />
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
					echo "<h4>Please login before making an order</h4>";
				}
			?>
			</div>
		</div>
		<div class="header">
			<div class = "SortBy">
				<div class = "Pages">
		            <ul>
		                <li>pages:</li>
		                <?php
		                	$cellTotal = 4;
		                	if (isset($_SESSION["sCart"])){
		                		$iLength = sizeof($_SESSION["sCart"]);
								//ceil is a built in php function that rounds a value to the nearest whole interger, this is used to determine the quantity of pages for the catalogue
								$pTotal = ceil($iLength / $cellTotal);
								$pNumbers = [];
								//for loop to store page numbers into an array 
								for ($p = 1;$p <= $pTotal; $p++){
									array_push($pNumbers,$p);
								}
			                	for ($i = 0;$i < $pTotal; $i++){
			                		echo("<li><a href ='http://localhost/MarmaladeCraft/MarkupDocuments/ShoppingCart.php?p=".$pNumbers[$i]."'>".$pNumbers[$i]."</a></li>");
			                		//only add a slash if not at the final page
			                		if ($i != ($pTotal-1)){
			                			echo("<li> / </li>");
			                		}
			                	}
		                	}else{
		                		echo("<li> 1 </li>");
		                	}
		                ?> 
			        </ul>
				</div>
			</div>
		</div>
		<div class ="content">
			<div class="Cartcontainer">
				<h1>Shopping Cart</h1>
				<div class="cartDisplay">
					<div class="products">
						<?php
							if (isset($_SESSION["sCart"]) and sizeof($_SESSION["sCart"]) > 0){
								//Products change depending on page number following this linear sequence 
								$iAddon = $cellTotal * ($_GET["p"]-1);
								//Sorting products from lowest to highest prices
								//$SortedList = quicksort($SortedList);
								$i=0;
								//creating of grid is governed by two conditions 1. squares do not go over length of ItemList array 2. does not go over 4 squares
								while(($i<sizeof($_SESSION["sCart"])-$iAddon) and $i<$cellTotal){
									$pAdd = $i + $iAddon;
									//Price of item multiplied by inputted quantity
									$tPrice = $_SESSION["sCart"][$pAdd][2] * $_SESSION["sCart"][$pAdd][4];
									$photo = '../StaticImages/ProductPictures/ProductID'.$_SESSION["sCart"][$pAdd][0].'/IconImage.jpg';
									//script echoes html code with php variables to produce elements of the grid that make up the shopping cart
									echo '<div class="product">
											<img class = "SCphoto" src="'.$photo.'">
											<div class="product-info">
												<h3 class="product-name">'.$_SESSION["sCart"][$pAdd][1].'</h3>
												<h4 class="product-price">'.$tPrice." (Price of each item: ".$_SESSION["sCart"][$pAdd][2].')</h4>
												<p class="product-quantity">Qnt:  '.$_SESSION["sCart"][$pAdd][4].'</p>
												<form method="post" action="../scripts/RemoveItem.php">
													<input type="submit" class="product-remove" name="Remove" value="Remove">
													<input type="hidden" name="itemID" value="'.$_SESSION["sCart"][$pAdd][0].'">
												</form>
											</div>
										</div>';
									//increment var i by 1
									$i++;
								}
							}else{
								echo("<p>empty</p>");
							}
						?>
					</div>
					<div class="cart-total">
						<?php
							if (isset($_SESSION["sCart"])){
								//Variables of Total price and total Quantity
								$TotalQuantity = array_sum(array_column($_SESSION["sCart"], 4));
								$TotalPrice = array_sum(array_column($_SESSION["sCart"], 2))*$TotalQuantity;
							}else{
								$TotalPrice = 0;
								$TotalQuantity = 0;
							}
							echo("<p>
									<span>Total Price</span>
									<span>£".$TotalPrice."</span>
								</p>");
							echo("<p>
									<span>Number of Items</span>
									<span>".$TotalQuantity."</span>
								</p>");			
						?>
						<script type="text/javascript">
							function CartCheck(){
								//function to make sure user has items in cart
								var CartSize = <?php if(isset($_SESSION["sCart"])){
									echo (sizeof($_SESSION["sCart"])); 
								}else{
									echo (0);
								} 
								?>;

								if (CartSize < 1){
									alert("Cart is empty, please add items to cart");
									return false;
								}
								return true;
							}
						</script>
						<form method="post" onsubmit="return CartCheck()" action="../scripts/Checkout.php">
							<input type="submit" class="CheckOut" name="CheckOut" value="Proceed to Checkout">
						</form>

					</div>
				</div>
			</div>
		</div>
		<div class ="footer"><p>footer</p></div>
	</div>
</body>
</html>
