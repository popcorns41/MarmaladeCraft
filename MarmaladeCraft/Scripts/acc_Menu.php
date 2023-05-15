<?php
	if (!isset($_SESSION)) { 
		session_start(); 
	}
?>

<?php
	session_destroy(); 
	header("location: http://localhost/marmaladeCraft/markupdocuments/WebsiteDesign.php");
?>