<?php
	include "../Scripts/DBFunctions.php";
	$cInfo = ["ProductID","Title","Description","Price","Stock","ProductType","Colour","Adjustable","TotalPurchases"];
	$tInfo = "product";
	//2D array of selected information of all current items in inventory
	$ItemList = GatherFromDB($tInfo,$cInfo);
?>