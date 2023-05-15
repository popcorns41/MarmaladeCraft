<?php
	//BIG NOTE: I don't need to perform another linear search of passwords, I'll just need to match up user ids and confirm whether hashed password matches.

	//establishes link to database
	require "../dbconnect.php";
	
	//Validates whether an inputted password by a user matches
	function eValid($input,$hasedPwdInDb){
		$verify = password_verify($input, $hasedPwdInDb);
		if ($verify == 1){
			return 1;
		}else{
			return 0;
		}
	}

	//something could be wrong with my search method need to test
	function PasswordSearch($con,$password){
		//Mysqli query to gather data from a particular column
		$psql = "SELECT Password FROM passwords";
		$presult = mysqli_query($con,$psql);
		$flag = False;
		if ($presult = $con -> query($psql)){
			while($row = $presult -> fetch_row() or $flag == True){
				if (eValid($password,$row["Password"])==1){
					$flag = True;
				}else{
					//pass
				}
			}
		}
		if($flag == True){
			echo "password found";
			return 1;
		}else{
			echo "password not in database";
			return 0;
		}
	}
	//confirms whether user's inputted password and email match based upon UserID
	function UserMatch($con,$password)
?>