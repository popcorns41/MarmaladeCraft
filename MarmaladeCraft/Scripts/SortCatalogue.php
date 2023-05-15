<?php
	//functions for reading DB accessed through included file
	include "../Scripts/DBFunctions.php";
	//specific column titles and table name needed from database
		if (isset($_POST["Submit"])){
			$sInput = $_POST["Sort"];
			switch ($sInput){
				case "MostBought":
					header("location: http://localhost/marmaladeCraft/markupdocuments/Catalogue.php?p=1&Column=3&flip=0");
					break;
				case "PriceL":
					header("location: http://localhost/marmaladeCraft/markupdocuments/Catalogue.php?p=1&Column=2&flip=1");
					break;
				case "PriceH":
					header("location: http://localhost/marmaladeCraft/markupdocuments/Catalogue.php?p=1&Column=2&flip=0");
					break;
				case "NewP":
					header("location: http://localhost/marmaladeCraft/markupdocuments/Catalogue.php?p=1&Column=0&flip=0");
					break;
				case "OldP":
					header("location: http://localhost/marmaladeCraft/markupdocuments/Catalogue.php?p=1&Column=0&flip=1");
					break;
				default:
					echo("not detected");
					break;
			}
		}else{

		}
?>