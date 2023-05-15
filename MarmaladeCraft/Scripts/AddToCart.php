<?php
	session_start();
	include "../Scripts/DBFunctions.php";
	//Creating shopping cart if there currently isn't one
	if (empty($_SESSION["sCart"])){
		$_SESSION["sCart"] = [];
	}

	$Quantity = $_POST["Quantity"];
	$Cart = $_SESSION["sCart"];
	$pID = $_POST["ProductID"];
	//Calling of all information about product needed to be displayed in the shopping cart
	$iInfo = ["ProductID","Title","Price","Stock"];
	$tInfo = "product";
	$ItemList = GatherFromDB($tInfo,$iInfo,1,"ProductID",$pID);
	//Checks to make sure the user hasn't already added this item to prevent duplicates
	if (in_array($ItemList[0],array_column($Cart, 0))){
		//Linear search to discover matching ID to add further quantity of items
		for ($x = 0; $x < sizeof($Cart); $x++){
			//if ProductIDs match
			if ($ItemList[0] == $Cart[$x][0]){
				$qID = $x;
				break;
			}
		}
		//Quantity of given ProductID now sums with new Quantity
		$_SESSION["sCart"][$qID][4] += $Quantity;

	}else{
		//if the user is adding this item to cart for the first time, the ItemList will receive a quantity value and will then be pushed into the shopping cart
		array_push($ItemList,$Quantity);
		array_push($_SESSION["sCart"],$ItemList);
	}
	header("location: http://localhost/marmaladeCraft/markupdocuments/Catalogue.php?p=1&Column=3&flip=0");
?>