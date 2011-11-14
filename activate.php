<?php

include_once "user.inc.php";

import_request_variables("g");

if ( isset($uid, $key) ) {
	
	include_once "top.inc.php";
	
	$uid = filter($uid);
	$key = filter($key);
	
	print "\r\n";
	
	print '<script>$(document).ready(function(){$.colorbox({html:"';
	
	if ( !User::Activate($uid, $key) )
		print 'Sorry, no such account exists, the activation key is invalid,<br />or the account has already been activated.';
	else
		print 'Congratulations!  You are now activated.  You will be taken to the main page to login.';
	
	print '", title:"ACTIVATION MESSAGE", onClosed:function(){ window.location = "index.php"; }})});</script>';

} else
	header("Location: index.php");

include_once "footer.inc.php";

?>