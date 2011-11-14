<?php

include_once "user.inc.php";

//if ( checkReferrer() ) {
	
	import_request_variables("p");
	
	$name = "$first $last";	
	
	// this is for a little pause to show them the loading GIF.. hee hee
	
	usleep(50000);
	
	User::Register($email, $password, $name, $gender, $birthday);
	
//}

?>