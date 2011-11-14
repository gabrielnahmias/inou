<?php

include_once "user.inc.php";

//print $_SERVER['HTTP_REFERER'];

// for some reason checkReferrer() isn't working right now..?
// going to disable all of these calls..?  possibly pass a variable along with
// the post command so it knows it's valid.

//if ( checkReferrer() ) {
	
	import_request_variables("p");
	
	$email = filter($email);
	$pass = filter($pass);
	
	if ($remember == "true")
		$remember = 1;
	else
		$remember = NULL;
	
	// this is for a little pause to show them the loading GIF.. hee hee
	
	//usleep(500000);
	
	User::Login($email, $pass, $remember);
	
//}

?>