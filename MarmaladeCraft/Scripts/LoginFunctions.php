<?php
//function that returns 1 or 0 depending on Email was inputted previously into Database
	function EmailSearch($con,$email){
		//Mysqli query to gather data from a particular column
		$esql = "SELECT Email FROM users";
		$eresult = mysqli_query($con,$esql);
		$flag = False;
		//Checks whether table is empty or not
		if (mysqli_num_rows($eresult) > 0){
			//linear search of database to check whether email was previously inputted
			while($row = mysqli_fetch_assoc($eresult) and $flag != True){
				if ($email == $row["Email"]){
					$flag = True;
				}else{
					//pass
				}
			}
		}else{
			//database empty
		}
		if($flag == True){
			return 1;
		}else{
			return 0;
		}
	}
	function encrypt($input){
		//intergrated php function to hash an input in SHA256, password_hash is constantly updated to use the most up to date hashing function, hence better security
		return $hasedPwdInDb = password_hash($input, PASSWORD_DEFAULT);
	}

	function validate($con,$data){
		//input sanitation to prevent SQL injection 
	       $data = trim($data);
		   $data = stripslashes($data);
		   $data = htmlspecialchars($data);
		   $data = mysqli_real_escape_string($con, $data);
		   return $data;
		}

		//Validation function used from src = https://stackoverflow.com/questions/17966788/validate-uk-short-postcode
	function IsPostcode($postcode){
	    if(preg_match("/(^[A-Z]{1,2}[0-9R][0-9A-Z]?[\s]?[0-9][ABD-HJLNP-UW-Z]{2}$)/i",$postcode) || preg_match("/(^[A-Z]{1,2}[0-9R][0-9A-Z]$)/i",$postcode))
	    {    
	        return 1;
	    }
	    else
	    {
	        return 0;
	    }
	}
?>