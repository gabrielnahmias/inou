<?php

include_once "user.inc.php";

?><html>
<head>
<title><?php print APP; ?> | Forgotten Password</title>
<script src="js/placeholder.js" type="text/javascript"></script>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/styles2.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/fav.ico" />
</head>

<body>

<div id="main">

    </div>
    
    <div id="middle" align="center">
    
<?php

if ( isset($_POST['submit']) ) {
	
	if ( !empty($_POST['email']) ) {
		
		$err = "";
		$msg = "";
		
		foreach($_POST as $key => $value)
			$data[$key] = filter($value);
		
		$email = $data['email'];
		
		//check if activ code and user is valid as precaution
		$rs_check = mysql_query("select `uid` from users where `email`='$email'") or die ( mysql_error() ); 
		
		$num = mysql_num_rows($rs_check);
		// Match row found with more than 1 results  - the user is authenticated. 
		if ( $num <= 0 )
			$err = "No such email registered.";
		
		if( empty($err) ) {
			
			$new_pwd = rand().rand();
			$pwd_reset = crypt($new_pwd, SALT);
			//file_put_contents("pw.txt",$new_pwd);
			$rs_activ = mysql_query("update users set `password` = '$pwd_reset' WHERE 
						 email='$email'") or die( mysql_error() );
						 
			//send email
			
			$message = 
			"<html><body>" .
			"Thanks for using <a href=\"".URL."\">" . APP . "</a>!" .
			"<br /><br />For your records, your login credentials are now as follows:" .
			"<br /><br /><b>Email:</b> $email" .
			"<br /><b>Password:</b> $new_pwd" .
			"<br /><br />Simply copy that bad boy into your password field on the home page.".
			"</body></html>";
			
			$headers =
			"From: " . APP . "@" . APP . ".co" . "\r\n" .
			"Content-type: text/html; charset=iso-8859-1";
			
			if ( mail($email, "New Password", $message, $headers) ) {						 
				
				$domain = strtok($email, "@");
				$domain = strtok("");
				
				$msg = "New password has been sent to your <a href=\"http://$domain\">email address</a>.";
			
			} else
			
				$err = "Fuck, mail's out.";
		
		}
		
	} else
		$err = "Enter an email.";
	
}

		?><div style="width: 400px;">
        
        <h1><u>Forgotten Password</u></h1>
        
         <br /><?php
        
        if( !empty($err) )
            print "<div id=\"error\" style=\"width: 300px\">$err</div>\r\n<br />";
        if( !empty($msg) )
            print "<div id=\"msg\" style=\"width: 300px\">$msg</div>\r\n<br />";
        
        ?>
        
        If you have forgotten your account password, you can have a
        <br><strong>new password</strong> sent to your email address.
        
        <br />
        <br /><form action="forgot.php" method="post" name="actForm" id="actForm" >
        
        <input class="gray" name="email" type="text" value="Email"><input name="submit" type="submit" value="Reset">
        
        </form>
        
        </div>
