<?php

define ("DB_HOST", "127.0.0.1"); // set database host
define ("DB_USER", "terrasoft"); // set database user
define ("DB_PASS","shitfuck1"); // set database password
define ("DB_NAME","inou"); // set database name

$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database.");

global $link;
global $db;

?>