<?php 
	include "../scripts/SendMail.php";
	//
	if (isset($_POST["form_submitted"]) and !empty($_POST["name"]) and !empty($_POST["email"]) and !empty($_POST["message"])){
		$from = $_POST["email"];
		$from_acc = $_POST["name"];
		$to =  "marmaladecraftautoresponse@gmail.com";
		if (!empty($_POST["ID"])){
			$subject = "inquiry from ".$_POST['name']." about order ID:".$_POST["ID"];
		}else{
			$subject = "general inquiry from ".$_POST['name']; 
		}
		$body = $_POST["message"];
	sendMail($from,$from_acc,$to,$subject,$body);
	echo '<script type="text/javascript">
					alert("message sent, we will get in touch as soon as possible");
					location="http://localhost/marmaladeCraft/markupdocuments/ContactUs.php";
					</script>'; 
	}else{
		echo '<script type="text/javascript">
					alert("Please fill all needed boxes");
					location="http://localhost/marmaladeCraft/markupdocuments/ContactUs.php";
					</script>'; 
	}
	
?>