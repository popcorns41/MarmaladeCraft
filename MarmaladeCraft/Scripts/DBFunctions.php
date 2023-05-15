<?php
	function GatherFromDB($table,$List,$condition,$Location,$cStatement){
		//linked file to connect to database
		include "../Scripts/dbconnect.php";
		//implode is a function that converts elements of a list into a string 
		$sInput = implode(",",$List);
		//sql query to take information from database, in order to increase reading speed if a condition is applicable this if statement will determine whether to read the whole table or just a specific row determined by index of table ($Location)
		if ($condition == 1){
			$sql = ("SELECT ".$sInput." FROM ".$table." WHERE ".$Location."=".$cStatement);
		}else{
			$sql = ("SELECT ".$sInput." FROM ".$table);
		}
		
		//multidimension to be outputted
		$TotalArray = [];
		//confirms query has returned not empty or without errors 
		if ($result = $con -> query($sql)) {
			//While there are still rows fetch information in given row
			while ($row = $result -> fetch_row()){
				//Function can either return a 2D or 1D array
				if ($condition == 1){
					for ($i = 0; $i < sizeof($List); $i++){
			    	//content pushed into alist
			    		array_push($TotalArray,$row[$i]);
			    	}
				}else{
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
		  }
		  //clears the memory used for the sql inquiry.
		  $result -> free_result();
		}else{
			echo ($con -> error);
		}
		//terminates connection
		$con -> close();
		//output
		return $TotalArray;
	}
	//PHP's intergrated quicksort function allows lists to be ordered with given specifications
	function SortProduct($ItemList,$column,$ASC){
		//variable ASC determines whether the list should be sorted in ascending order or descending order
		if ($ASC == 1){
			array_multisort(array_column($ItemList, $column), SORT_ASC, $ItemList);
		}elseif ($ASC == 0){
			array_multisort(array_column($ItemList, $column), SORT_DESC, $ItemList);
		}
		//stores new record of stock values
		$Stock = array_column($ItemList, 4);
		//items are split into two different arrays depending on their stock value
		$dHold = [];
		$sHold = [];
		//for loop to run through items to check whether their stock is above 0
		for ($x = 0;$x < sizeof($ItemList); $x ++){
			if ($Stock[$x] == 0){
   				array_push($dHold,$ItemList[$x]);
			}else{
				array_push($sHold,$ItemList[$x]);
			}
		}
		//arrays are remerged
		$ItemList = array_merge($sHold,$dHold);
		return $ItemList;
	}
?>

