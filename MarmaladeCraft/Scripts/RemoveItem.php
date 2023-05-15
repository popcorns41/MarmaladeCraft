<?php
	if (!isset($_SESSION)){ 
		session_start(); 
	}
	if(isset($_POST["Remove"])){
		//upon clicking remove button item matching product ID will be removed from shopping cart 
		$ItemID = $_POST["itemID"];
		$RemoveKey = array_search($ItemID,array_column($_SESSION["sCart"],0));
		//removes item from cart
		unset($_SESSION["sCart"][$RemoveKey]);  
		//ReIndexing cart's items
		$_SESSION["sCart"]=array_values($_SESSION["sCart"]);	
		//user alert
		echo '<script type="text/javascript">
					alert("Item removed!");
					location="http://localhost/marmaladeCraft/markupdocuments/ShoppingCart.php?p=1";
					</script>'; 
	}
	
?>