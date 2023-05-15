<?php 
	if (!isset($_SESSION)) { 
		session_start(); 
	}
?>

<?php
include "../scripts/dbconnect.php";
include "../scripts/LoginFunctions.php";


if(isset($_POST["login"])){
	$uname = validate($con,$_POST['email']);
	$pass = validate($con,$_POST['password']);
	//checks information is currently inputted and has not been previously inputted
	if (empty($uname) or empty($pass)) {
		echo '<script type="text/javascript">
				alert("Please input complete information");
				location="http://localhost/marmaladeCraft/markupdocuments/loginpage.php";
				</script>'; 
	    exit();
	}elseif (EmailSearch($con,$uname) == 0){
		echo '<script type="text/javascript">
				alert("Email not found, please reinput information");
				location="http://localhost/marmaladeCraft/markupdocuments/loginpage.php";
				</script>'; 
	    exit();
	}else{
		$sql = "SELECT UserID,Password,Email,fullName FROM users WHERE Email ='$uname'";
		//confirms sql query has been received by the database
		if ($result = $con -> query($sql)) {
			//stores desired information from the database as a list in this instance only one row was selected in the sql query
			$row = mysqli_fetch_assoc($result);
			//Outputs a boolean value to determine whether inputted password is valid per the hashed password in the database
			$verify = password_verify($pass, $row['Password']);
            if ($verify == 1) {
            	//superglobal variables used for displaying user and product information for the website
            	$_SESSION["Email"] = $row['Email'];	
				$_SESSION["fullName"] = $row['fullName'];
				$_SESSION["UserID"] = $row['UserID'];
				//redirect back to homepage
				header("location: http://localhost/marmaladeCraft/markupdocuments/WebsiteDesign.php");
            }else{
            	echo '<script type="text/javascript">
				alert("Incorrect password, please re-enter");
				location="http://localhost/marmaladeCraft/markupdocuments/loginpage.php";
				</script>'; 
            }
		}else{
			//error is displayed if connection fail
			echo ($con -> error);
		}
	}
	
}else{
	//warning to the user this page should not have been accessed if url is inserted
	echo("Please return back to homepage");
	exit();
}
?>