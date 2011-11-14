<?php

/*
$host = $_SERVER['HTTP_HOST'];
$path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$url = "http://$host$path/";
*/

define("APP", "inou");
define("COOKIE_90_DAYS", 60*60*24*90);
define("DATE_DESC", "F j<\s\u\p>S</\s\u\p>, Y \\a\\t g:i A");
define("DATE_BDAY", "F j<\s\u\p>S</\s\u\p>, Y");
define("SALT", "$2a$07\$terrasoftrulesyo");
define("URL", "http://174.50.6.35/inou/");

function checkReferrer($url = URL) {
	
	// GOTTA have the right referrer or you're FUCKED boi
	// this prevents assholes from trying to write custom scripts
	// to register accounts and abuse my database
	
	if ( empty($_SERVER['HTTP_REFERER']) )
		return false;
	
	$ref = $_SERVER['HTTP_REFERER'];
	
	if ( strpos($ref, $url) !== false )
		return true;
	elseif ( strpos($ref, "http://localhost/inou") !== false )
		return true;
	else
		return false;
	
}

function filter($data) {
	
	$data = trim( htmlentities( strip_tags($data) ) );
	
	if ( get_magic_quotes_gpc() )
		$data = stripslashes($data);
	
	$data = mysql_real_escape_string($data);
	
	return $data;
	
}

function getLocation($ip) {
	
	/*
		
		Formal List of Meta Tags Returned
		
		
		
	*/
	
	return get_meta_tags("http://www.geobytes.com/IpLocator.htm?GetLocation&template=php3.txt&IpAddress=$ip");
	
}

function tab($num=1) {
	
	// this is used to help make my source code look pretty :)
	
	$tabs = "";
	
	for($i = 0; $i < $num; $i++)
		$tabs .= "\t";
	
	return $tabs;
		
}

?>