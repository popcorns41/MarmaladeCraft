<?php
	if (!isset($_SESSION)) { 
		session_start(); 
	}
?>
<?php
	include "../scripts/dbconnect.php";
	include "../scripts/LoginFunctions.php";
	//MySqli query for User

	//and !empty($_POST["fName"]) and !empty($_POST["lName"]) and!!empty($_POST["addressLine"]) and !empty($_POST["Town"]) and !empty($_POST["ZipCode"])
	if(isset($_POST["finish"]) and !empty($_POST["addressLine"]) and !empty($_POST["Town"]) and !empty($_POST["ZipCode"])){
		$address = $_POST["addressLine"];
		$Town = $_POST["Town"];
		//Capitalizes and removes spaces for uniform zipcode format
		$ZipCode = strtoupper(str_replace(' ','',$_POST["ZipCode"]));
		if (IsPostcode($ZipCode) == 0){
			echo '<script type="text/javascript">
				alert("Please input a UK zipcode");
				location="http://localhost/marmaladeCraft/markupdocuments/MyAccountMenu.php";
				</script>'; 
		}else{
			$UserID = $_SESSION["UserID"];
			//Updates current NULL data with inputted user information
			$uInput = "UPDATE users SET AddressLine = '{$address}',Town = '{$Town}', ZipCode = '{$ZipCode}' WHERE UserID = '$UserID'";
			$success = mysqli_query($con,$uInput);
			if ($success){
				echo '<script type="text/javascript">
					alert("Address Updated");
					location="http://localhost/marmaladeCraft/markupdocuments/MyAccountMenu.php";
					</script>'; 
			}else{
				echo ($con -> error);
			}
		}
	}else{
		echo '<script type="text/javascript">
				alert("Please input complete information");
				location="http://localhost/marmaladeCraft/markupdocuments/MyAccountMenu.php";
				</script>'; 
	}
?>