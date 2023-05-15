<?php 
	if (!isset($_SESSION)) { 
		session_start(); 
	}
 ?>

<?php
	//linking other php pages
	include "../scripts/dbconnect.php";
	include "../scripts/LoginFunctions.php";
	include "../scripts/SendMail.php";
	//confirms register button has been pressed and information inputted isn't blank  
	if(isset($_POST["signup"]) and !empty($_POST["email"]) and !empty($_POST["password"]) and !empty($_POST["Name"])){
		//confirms email address hasn't already been inputted into the database
		$DupCheck = EmailSearch($con,$_POST["email"]);
		if ($DupCheck == 1){
			echo '<script type="text/javascript">
					alert("Email found in database, please input new information");
					location="http://localhost/marmaladeCraft/markupdocuments/loginpage.php";
					</script>'; 
			//header("Location: http://localhost/marmaladeCraft/markupdocuments/loginpage.php");
		}else{
			$fullName = validate($con, strval($_POST["Name"]));
			$email = validate($con, strval($_POST["email"]));
			$password = validate($con, strval(encrypt($_POST["password"])));
			$_SESSION["Email"] = $email;	
			$_SESSION["fullName"] = $fullName;
			$uInput = "INSERT INTO users (Email, Password,FullName) VALUES ('{$email}','{$password}','{$fullName}')";
			$success = mysqli_query($con,$uInput);
			if ($success){
				//Confirms UserID created by the database to be used when the user wants to make an order
				$result = mysqli_query($con,"SELECT UserID FROM users WHERE Email = '{$email}'");
				if (!$result) {
				    echo 'Could not run query: ' . mysqli_error();
				    exit;
				}
				$row = mysqli_fetch_row($result);
				$_SESSION["UserID"] = $row[0];
				//send an email to the user via phpmailer
				$from = "marmaladecraftautoresponse@gmail.com";
				$from_acc = "MarmaladeCraftTeam";
				$to = $email;
				$subject = "New Account Confirmed"; 
				//email template from src: https://www.nutshell.com/blog/welcome-email-templates/
				$body = "Hi ".$fullName.",
						<br>
						<br>
						We can’t wait for you to start using browsing our handmade products!
						<br>
						<br>
						Simply go here: localhost/marmaladeCraft/markupDocuments/websiteDesign.php to get started. If you have any questions, please feel free to use our contact page and a response will be sent as soon as possible.
						<br>
						<br>
						Have a great day!<br>
						Marmalade Craft Team";
				sendMail($from,$from_acc,$to,$subject,$body);
				echo '<script type="text/javascript">
					alert("Account registered! please check your email for a confirmation the account has been created");
					location="http://localhost/marmaladeCraft/markupdocuments/websiteDesign.php";
					</script>'; 
			}else{
				echo ($con -> error);
			}
		}
	}else{
	}
	//terminates DB connection 
	$con -> close();
?>