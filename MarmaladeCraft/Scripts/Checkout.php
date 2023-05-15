<?php
	if (!isset($_SESSION)){ 
		session_start(); 
	}

	include "../scripts/dbconnect.php";
	include "../scripts/DBFunctions.php";
	include "../scripts/sendMail.php";

	if(!isset($_POST["CheckOut"])){
		echo '<script type="text/javascript">
					alert("Invalid entry, return to cart");
					location="http://localhost/marmaladeCraft/markupdocuments/ShoppingCart.php?p=1";
					</script>'; 
	}else if (!isset($_SESSION["Email"])){
			echo '<script type="text/javascript">
					alert("Please login or sign up before making an order");
					location="http://localhost/marmaladeCraft/markupdocuments/LoginPage.php";
					</script>'; 
	}else{
		$beginOrder = true;
	}

	if ($beginOrder){
		//Finds record of address
		$aRead = ["AddressLine","ZipCode","Town"];
		$aTable = "users";
		$uColumn = "UserID";
		$Address = GatherFromDB($aTable,$aRead,1,$uColumn,$_SESSION["UserID"]);

		if(empty($Address[0]) or empty($Address[1]) or empty($Address[2])){
			echo '<script type="text/javascript">
		 				alert("Incomplete Address, please update information");
						location="http://localhost/marmaladeCraft/markupdocuments/MyAccountMenu.php";
		 				</script>'; 
		 	$uploadOrder = False;
		}else{
			//final check to make sure there is enough stock to continue order
			$qCheck = ["Stock","Title"];
			$qTable = "product";
			for ($i = 0;$i < sizeof($_SESSION["sCart"]);$i ++){
				//most up to date value of stock and title from database
				$Stock = GatherFromDB($qTable,$qCheck,1,"ProductID",$_SESSION["sCart"][$i][0]);
				//if statement confirms Quantity is not greater than current stock
				if ($Stock[0] < $_SESSION["sCart"][$i][4]){
					echo '<script type="text/javascript">
						alert("apologies item '.$_SESSION["sCart"][$i][1].' only has '.$Stock[0].' remaining, please reinput quantity.");
						location="http://localhost/marmaladeCraft/markupdocuments/ShoppingCart.php?p=1";
						</script>'; 
					$uploadOrder = False;
				}else{
					$uploadOrder = True;
				}
			}	
		}
		
	}
	if ($uploadOrder){
		//inserts user information attached with the order
		$UserID = $_SESSION["UserID"];
		$Email = $_SESSION["Email"];
		$FullName = $_SESSION["fullName"];
		$AddressLine = $Address[0];
		$ZipCode = $Address[1];
		$Town = $Address[2];
		$date = date("Y/m/d");
		$oInput = "INSERT INTO orders (UserID, Email, FullName, AddressLine, ZipCode, Town, OrderDate) VALUES ('{$UserID}','{$Email}','{$FullName}','{$AddressLine}','{$ZipCode}','{$Town}','{$date}')";
		$success = mysqli_query($con,$oInput);
		if (!$success){
			echo ($con -> error);
		}
		//Finds BundleID to allocate to items however I'm gonna do that
		//calls most recent order from the user which is the current order being processed
		$bInput = "SELECT MAX(BundleID) FROM orders WHERE UserID = ".$UserID;
		$bundleSearch = mysqli_query($con,$bInput);
		if (!$bundleSearch){
			echo ($con -> error);
		}
		$row = mysqli_fetch_row($bundleSearch);
		$BundleID = $row[0];

		//loop for inserting items in cart to database
		for ($x = 0;$x < sizeof($_SESSION["sCart"]);$x++){
			//Updates stock record in database and increases total purchases by total quantity bought
			$sUpdate = "UPDATE Product SET Stock=Stock-".$_SESSION["sCart"][$x][4].",TotalPurchases = TotalPurchases + ".$_SESSION["sCart"][$x][4]." WHERE ProductID = ".$_SESSION["sCart"][$x][0];
			$success = mysqli_query($con,$sUpdate);
			$ProductID = $_SESSION["sCart"][$x][0];
			//Total cost of a given item in the order
			$Price = $_SESSION["sCart"][$x][2] * $_SESSION["sCart"][$x][4]; 
			$Quantity = $_SESSION["sCart"][$x][4];
			$oInput = "INSERT INTO order_details (BundleID, UserID ,ProductID, Price, Quantity) VALUES ('{$BundleID}','{$UserID}','{$ProductID}','{$Price}','{$Quantity}')";
				$success = mysqli_query($con,$oInput);
				if (!$success){
					echo ($con -> error);
				}
		}
		$from = "marmaladecraftautoresponse@gmail.com";
		$from_acc = "MarmaladeCraftTeam";
		$to = $Email;
		$subject = "Order BundleID[".$BundleID."] Confirmed!"; 
		$Torders = 
		//email template from src: https://www.nutshell.com/blog/welcome-email-templates/
		$body = "Hi ".$FullName.",
				<br>
				<br>
				Thank you very much for shopping with MarmaladeCraft, we hope our product meets all your expectations.
				<br>
				<br>
				Transcript of order: <br>
				Bundle ID: ".$BundleID."
				<br>
				<br>
				Have a great day!<br>
				Marmalade Craft Team";
		sendMail($from,$from_acc,$to,$subject,$body);
		//reinstates shopping cart
		$_SESSION["sCart"] = [];
		echo '<script type="text/javascript">
				alert("Thank you for your purchase, The order has been processed, please check your email for further order confirmation.");
			location="http://localhost/marmaladeCraft/markupdocuments/ShoppingCart.php?p=1";
				</script>'; 

	}
	
	

?>