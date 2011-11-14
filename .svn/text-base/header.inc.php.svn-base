<?php

include_once "user.inc.php";

//define("FILE", basename($_SERVER['PHP_SELF']) );

$main = array("index.php", "activate.php", "error.php", "forgot.php");

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta http-equiv="X-Frame-Options" content="deny" />

<title><?php if (FILE == "index.php") print "Welcome to " . APP; else print APP . " | " . ucwords( basename(FILE, ".php") ) . ( (FILE == "forgot.php") ? "ten Password" : ""); ?></title>

<link rel="shortcut icon" href="img/fav.ico" />
<link rel="apple-touch-icon" href="img/fav.png"/>

<link href="<?php if (FILE == "error.php") print "../../../../../../inou/"; // that oughtta get it up there.. ?>css/styles.css" rel="stylesheet" type="text/css" />
<link href="colorbox/colorbox.css" rel="stylesheet" type="text/css" />
<?php if ( !in_array(FILE, $main) ): ?><link href="css/styles2.css" rel="stylesheet" type="text/css" />
<link href="css/dropdown.css" rel="stylesheet" type="text/css" />
<link href="css/tabs.css" rel="stylesheet" type="text/css" />
<link href="css/uploadPic.css" rel="stylesheet" type="text/css" /><?php endif; ?>


<!--[if lte IE 6]>
<link href="colorbox/ie.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" language="javascript" type="text/javascript"></script>
<script src="js/pngFix.js" language="javascript" type="text/javascript"></script>
<script src="js/placeholder.js" language="javascript" type="text/javascript"></script>
<script src="js/date.js" language="javascript" type="text/javascript"></script>
<script src="js/dynDays.js" language="javascript" type="text/javascript"></script>
<script src="js/validate.js" language="javascript" type="text/javascript"></script>
<script src="js/other.js" language="javascript" type="text/javascript"></script>
<?php if ( !in_array(FILE, $main) ): ?><script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js" language="javascript"></script>
<script src="js/toolbar.js" language="javascript" type="text/javascript"></script><?php endif; ?>
<script src="colorbox/colorbox.js" language="javascript" type="text/javascript"></script>

</head>

<body>

<div id="main">

	<div id="header" align="center">