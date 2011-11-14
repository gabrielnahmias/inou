<?php

include_once "user.inc.php";

User::ProtectPage();

include_once "toolbar.inc.php";

print "<center>List of members:\r\n<br />\r\n<br />";

$sql = mysql_query("SELECT `uid` FROM `users`");

while ( $uid = mysql_fetch_row($sql) ) {
	
	$uid = $uid[0];
	
	$user = User::Info($uid);
	
	print "<strong><a href=\"profile.php?p=$uid\">".(($uid == $_SESSION['uid'])?"You":$user['name'])."</a></strong> <br />";
	
}

print "</center>";

include_once "footer.inc.php";

?>