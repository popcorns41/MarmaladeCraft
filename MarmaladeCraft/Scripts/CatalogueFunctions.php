<?php
	function GatherFromDB($table,$List){
		//linked file to connect to database
		include "../Scripts/dbconnect.php";
		//implode is a function that converts elements of a list into a string 
		$sInput = implode(",",$List);
		//sql inquiry to take information from database
		$sql = ("SELECT ".$sInput." FROM ".$table);
		//multidimension to be outputted
		$TotalArray = [];
		//confirms query has returned not empty or without errors 
		if ($result = $con -> query($sql)) {
			//While there are still rows fetch information in given row
			while ($row = $result -> fetch_row()) {
				//1D array to be pushed into $TotalArray
				$alist=[];
				//for loop going through as many iterations as columns listed
			    for ($i = 0; $i < sizeof($List); $i++){
			    	//content pushed into alist
			    	array_push($alist,$row[$i]);
			    }
			    //alist pushed into TotalArray to form a 2D array
			    array_push($TotalArray,$alist);
		  }
		  //clears the memory used for the sql inquiry.
		  $result -> free_result();
		}
		//terminates connection
		$con -> close();
		//output
		return $TotalArray;
	}
?>