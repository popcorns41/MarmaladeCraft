<?php
$con = mysqli_connect("localhost","root","","marmaladecraftweb");
//confirms connection to database is established
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL:" . mysqli_error();
	//terminates connection
	$con -> close();
}
?>