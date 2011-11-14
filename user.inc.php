<?php

include_once "db.inc.php";		
include_once "functions.inc.php";

/*
	I'm beginning to feel as though my route of using AJAX is a little strange..
	although it does yield a beautiful result, no?
*/

ini_set("memory_limit","100M"); // im risky.. this is for all my dirty arrays

//set_time_limit();

define("FILE", basename($_SERVER['PHP_SELF']) );

$sql_users = mysql_query("SELECT * FROM `users`");

$users = array();

while ( $result = mysql_fetch_assoc($sql_users) ) {
	
	// this creates a multidemsional array with the contents of the user table
	// so that i dont query the database everytime i look up a user's info.
	// this method has greatly increased the speed of situations where many references
	// to user information are needed.
	
	$uid = $result['uid'];	// uid as user's key in array
	
	array_shift($result);	// get rid of uid.. even though this works associatively, it would be redundant	
	
	$users[$uid] = $result;	// boom

}

class User {
	
	public $err;
	
	public static function Activate($uid, $key) {
		
		//global $err;
		
		// check if activation key and user is valid
		$rs_check = mysql_query("select `uid` from users where `uid` = '$uid' and `key` = '$key' and `active` = 0") or die ( mysql_error() ); 
		
		$num = mysql_num_rows($rs_check);
		
		if ( $num <= 0 )
			return false;
		
		$rs_activ = mysql_query("update users set `active` = 1 WHERE `uid` = '$uid' AND `key` = '$key'") or die( mysql_error() );
		$rs_activ = mysql_query("update users set `key` = '' WHERE `uid` = '$uid' AND `key` = '$key'") or die( mysql_error() );
		
		return true;
		
	}
	
	public static function Info($uid) {
		
		/*$sql = "SELECT * FROM users WHERE `uid` = $uid";
		
		$user = mysql_query($sql);
		*/
		
		global $users; // gotta have access
		
		$info = $users[$uid];
		
		$newinfo['email'] = $info['email'];
		$newinfo['name'] = $info['name'];
		$newinfo['gender'] = ( $info['gender'] == 0 ) ? "male" : "female";
		$newinfo['birthday'] = date(DATE_BDAY, $info['birthday'] );
		$newinfo['regdate'] = date(DATE_BDAY, $info['regdate'] );
		$newinfo['active'] = ( $info['active'] == 0 ) ? false : true;
		$newinfo['banned'] = ( $info['banned'] == 0 ) ? false : true;
		
		return $newinfo;
		
	}
	
	public static function Login($email, $password, $remember) {
		
		global $err;
		
		$password = crypt($password, SALT);
		
		$result = mysql_query("SELECT `uid`,`password`,`name`,`key`,`active` FROM users WHERE
							   `email`='$email' AND `banned` = '0'") or die ( mysql_error() ); 
		
		$num = mysql_num_rows($result);
	
		if ( $num > 0 ) { 
			
			list($uid, $pw, $name, $key, $active) = mysql_fetch_row($result);
				
			if ($password == $pw) { 
				
				if ( /*!$active ||*/ $key != '' ) // i'll be using $active for ...
					$err = "not activated";
				
				if( empty($err) ) {
					
					session_start();
					
					session_regenerate_id(true); // prevent against session fixation attacks
					
					// this sets variables in the session 
					
					$_SESSION['uid'] = $uid;
					$_SESSION['name'] = $name;
					
					if ($remember == 1) {
						
						// update the timestamp and code for cookie
						
						$ctime = time();
						$ccode = md5( sha1( rand() ) );
						
						mysql_query("update users set `ctime` = $ctime, `ccode` = '$ccode' where uid='$uid'") or die( mysql_error() );
						
						setcookie("uid", $_SESSION['uid'], time() + COOKIE_90_DAYS);
						setcookie("ccode", crypt($ccode, SALT), time() + COOKIE_90_DAYS);
						setcookie("name", $_SESSION['name'], time() + COOKIE_90_DAYS);
						
					} else {
						
						setcookie("uid", "", time() - COOKIE_90_DAYS);
						setcookie("ccode", "", time() - COOKIE_90_DAYS);
						setcookie("name", "", time() - COOKIE_90_DAYS);
						
					}
					
				}
					 
			} else
				$err = "bad pw";
			
		} else
			$err = "no such user";
	
		print $err;
		
	}
	
	public static function Logout() {
		
		session_start();
		
		if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id']))
			mysql_query("update `users` 
					set `ckey`= '', `ctime`= '' 
					where `uid`='".$_SESSION['uid']."' OR  `uid` = '".$_COOKIE['uid']."'") or die(mysql_error());
		
		unset($_SESSION['uid']);
		unset($_SESSION['name']);
		session_unset();
		session_destroy(); 
		
		setcookie("uid", "", time() - COOKIE_90_DAYS);
		setcookie("ccode", "", time() - COOKIE_90_DAYS);
		setcookie("name", "", time() - COOKIE_90_DAYS);
		
		header("Location: index.php");
		
	}
	
	public static function ProtectPage() {
		
		error_reporting(0);
		
		session_start();
		
		// before we allow sessions, we need to check authentication key - ckey and ctime stored in database
		
		/* If session not set, check for cookies set by Remember me */
		if ( !isset($_SESSION['uid']) && !isset($_SESSION['name']) ) {
			
			if ( isset($_COOKIE['uid']) && isset($_COOKIE['ccode']) ) {
				
				$uid  = filter($_COOKIE['uid']);
				
				$rs_ctime = mysql_query("select `ccode`, `ctime` from users where `uid` ='$uid'") or die(mysql_error());
				
				list($ccode, $ctime) = mysql_fetch_row($rs_ctime);
				
				if( ( time() - $ctime ) > COOKIE_90_DAYS )
					User::Logout();
				
				if( !empty($ccode) && $_COOKIE['ccode'] == crypt($ccode, SALT) ) {
					
					session_regenerate_id();
					
					$_SESSION['uid'] = $_COOKIE['uid'];
					$_SESSION['name'] = $_COOKIE['name'];
					
				} else
					User::Logout();
				
			}
			
		}
		
		if($_SESSION['name'] && FILE == "index.php")
			header("Location: home.php");
		elseif (!$_SESSION['name'] && FILE != "index.php")
			header("Location: index.php");
		
	}
	
	public static function Exists() {
		
		// err...
		
	}
	
	public static function Register($email, $password, $name, $gender, $birthday) {
		
		global $err;
		
		$key = md5( sha1( rand() ) );
		
		$regdate = time();
		
		$email = mysql_real_escape_string($email);
		$password = mysql_real_escape_string($password);
		$name = mysql_real_escape_string($name);
		
		$pw = crypt($password, SALT);
		
		$sql_duplicate = mysql_query("select count(*) as total from users where email='$email'") or die( mysql_error() );
		
		list($total) = mysql_fetch_row($sql_duplicate);
		
		if ($total > 0)
			$err = "exists";
		
		if ( isset($err) ) {
		
			print $err;
			
			exit;
		
		}
		
		$sql_insert = "INSERT into users (`email`,`password`,`name`,`gender`,`birthday`,`regdate`,`key`,`active`,`banned`,`ctime`,`ccode`)
					   VALUES ('$email','$pw','$name',$gender,$birthday,$regdate,'$key',0,0,0,'')";
			
		mysql_query($sql_insert) or die( mysql_error() );
		
		$uid = mysql_insert_id();
		
		mkdir("img/users/$uid/");	// pictures directory
		
		$a_link = URL . "activate.php?uid=$uid&key=$key";
		
		$subject = "Welcome to " . APP . "!";
		
		$message = 
		"<html><body>" .
		"Thanks for signing up with <a href=\"".URL."\">" . APP . "</a>!" .
		"<br /><br />For your records, your login credentials are as follows:" .
		"<br /><br /><b>Email:</b> $email" .
		"<br /><b>Password:</b> $password" .
		"<br /><br /><i>Here is the link to activate your account:</i>" .
		"<br />$a_link" .
		"</body></html>";
		
		$headers =
		"From: " . APP . "@" . APP . ".co" . "\r\n" .
		"Content-type: text/html; charset=iso-8859-1";
		
		mail($email, $subject, $message, $headers);
		
		mysql_close();
		
	}
	
}

?>