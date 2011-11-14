<?php include_once "top.inc.php"; ?>

<?php

$error = $_SERVER['QUERY_STRING'];
$file = str_replace( "?" . $error , "", basename( $_SERVER['REQUEST_URI'] ) );

switch($error) {
	
	case 403:
		$message = "That request is <b>FORBIDDEN</b>, my friend.";
	break;
	
	case 404:
		$message = "That URL <i>\"%s\" </i> ain't <b>here</b>, yo.";
	break;
	
	case "500":
		$message = "<i>Man</i>, the server is fucking up.";
	break;

		
}

if ( $file == "error.php" ) {
	
	$error = "Wow";
	$message = "You sure are weird.";
	
}

?>
	
	<font style="font-size: 150pt; font-weight: bold;"><?php print $error; ?></font>
	
	<br />
	<br /><h2><?php printf($message, $file); ?></h2>
	
<?php include_once "footer.inc.php"; ?>