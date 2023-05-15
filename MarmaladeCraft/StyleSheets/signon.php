<?php
session_start();
include "../scripts/dbconnect.php";

function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

if(isset($_POST["login"])){
	

	$uname = validate($_POST['email']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT UserID,Password,Email FROM user WHERE Email ='$uname'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			//Outputs a boolean value to determine whether inputted password is valid per the hashed password in the database
			$verify = password_verify($pass, $row['password']);
            if ($row['user_name'] === $uname &&  $verify === 1) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	//header("Location: home.php");
            	echo ("match");
		        exit();
            }else{
				header("Location: login.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: login.php?error=Incorect User name or password");
	       	exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}