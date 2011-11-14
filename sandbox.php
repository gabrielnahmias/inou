<?php

include_once "user.inc.php";

User::ProtectPage();

include_once "toolbar.inc.php"; ?>
    	
        <center>
        
        <h2>HTML Allowed</h2>
        <h3>don't make me filter() you</h3>
        
        <br /><form action="<?php print FILE; ?>" method="post">
            
            <textarea class="gray" name="text">Enter something here</textarea>
            
            <br />
            <br /><input type="submit" value="Write It" style="width:200px;">
            
        </form>
        
<?php
	
	define("LIMIT", 5);
	
	$first = 0;
	
	if (isset($_GET['p']))
		$first = $_GET['p'];
	
	$sb = "sandbox.txt";
	$text = $_POST['text'];
	$stamp = time();
	
	$text = str_replace("\n", "", $text);
	$text = str_replace("|", "", $text);
	
	if ( isset($text) && !empty($text) )
		file_put_contents($sb,"$text|{$_SERVER['REMOTE_ADDR']}|{$_SESSION['uid']}|$stamp\r\n", FILE_APPEND);
	
	if ( file_exists($sb) ) {
		
		$lines = array_reverse( file($sb) );
		
		if ( $first < 0 )
			$first = 0;
		if ( $first >= count($lines) )
			$first = count($lines) - LIMIT;
			
		$previous = ( $first - (LIMIT + 1) );
		$next = ( $first + (LIMIT + 1) );
		
		if ( $next >= count($lines) )
			$next = count($lines);
		if ( $next < 0 )
			$next = 0;
		if ( $previous < 0 )
			$previous = -1;
		
		$nav = "<div id=\"tinynav\">";
		
		$nav .= ( ( $previous < 0 ) ? "" : "<a href=\"sandbox.php?p=0\" title=\"First Page\">" ) . "&lt;&lt;</a> ";
		
		$nav .= "\r\n".tab(1)."<span class=\"previous\">" . ( ( $previous < 0 ) ? "" : "<a href=\"sandbox.php?p=$previous\" title=\"Previous Page\">") . "&lt;" . ( ($previous < 0) ? "" : "</a>" ) ."</span>";
		
		$nav .= ( ( $next >= count($lines) )? "" : "<a href=\"sandbox.php?p=$next\" title=\"Next Page\">" ) . "&gt;" .
			  ( ($next >= count($lines)) ? "" : "</a>" ) ."</span> ";
		
		$nav .= ( ( $next >= count($lines) ) ? "" : "<a href=\"sandbox.php?p=".(count($lines)-LIMIT)."\" title=\"Last Page\">" ) . "&gt;&gt;</a> ";
		
		$nav .= "</div>";
		
		print $nav;
		
		print tab(1)."<div id=\"sandbox\">\r\n".tab(1);
				
		for ($i = $first; $i <= $first+LIMIT; $i++) {
			
			$info = explode("|", $lines[$i]);
			
			$text = $info[0];
			$ip = $info[1];
			$uid = $info[2];;
			$stamp = $info[3];
			
			$name = User::Info($uid);
			$name = $name['name'];
			
			// curse -- so that didn't work out...
			/* 
			$curse = array("fuck", " nig", " nigger ", " shit ", " bitch ", " cunt ", " piss ", " ass ");
			
			foreach ($curse as $word) {
				
				$stars = " ";
				
				for ($i = 0; $i < strlen($word)-2; $i++)
					$stars .= "*";
				
				$text = str_replace($curse, $stars . " ", $text);
				
			}
			*/
			// links
			
			$text = preg_replace("(\[link\](mailto\:|(news|(ht|f)tp(s?))\://){1}\S+\[/link\])", "<a href=\"\\0\">\\0</a>", $text);
			$text = str_replace("[link]", "", $text);
			$text = str_replace("[/link]", "", $text);
			
			// smilies
			
			$path = "img/smilies";
			
			$text = str_replace(" :? ", " <img src=\"$path/confused.png\" /> ", $text);
			$text = str_replace(" :'( ", " <img src=\"$path/crying.png\" /> ", $text);
			$text = str_replace(" :. ", " <img src=\"$path/curious.png\" /> ", $text);
			$text = str_replace(" :D ", " <img src=\"$path/ecstatic.png\" /> ", $text);
			$text = str_replace(" :o ", " <img src=\"$path/embarassed.png\" /> ", $text);
			$text = str_replace(" :( ", " <img src=\"$path/frown.png\" /> ", $text);
			$text = str_replace(" >( ", " <img src=\"$path/mad.png\" /> ", $text);
			$text = str_replace(" >:( ", " <img src=\"$path/mad.png\" /> ", $text);
			$text = str_replace(" :O ", " <img src=\"$path/omg.png\" /> ", $text);
			$text = str_replace(" B) ", " <img src=\"$path/shades.png\" /> ", $text);
			$text = str_replace(" 8) ", " <img src=\"$path/shades.png\" /> ", $text);
			$text = str_replace(" :) ", " <img src=\"$path/smile.png\" /> ", $text);
			$text = str_replace(" :I ", " <img src=\"$path/solemn.png\" /> ", $text);
			$text = str_replace(" o_O ", " <img src=\"$path/surprise.png\" /> ", $text);
			$text = str_replace(" :P ", " <img src=\"$path/tongue.png\" /> ", $text);
			$text = str_replace(" ;) ", " <img src=\"$path/wink.png\" /> ", $text);
			
			//$location = getLocation($ip);
			//$city = $location['city'];
			
			if ( empty($text) || $text == "\r\n" )
				print "";
			else
				print tab(1)."<span class=\"post\">$text</span>".
				  "\r\n".tab(1)."<span class=\"time\">by <a href=\"profile.php?p=$uid\">$name</a> ($ip) on ".
				  date(DATE_DESC, $stamp)." CST</span>\r\n".tab(1);
		
		}
		
		print "</div>";
		
		print $nav;
		
	}
		
	?>
    	
        </center>
        
<?php include_once "footer.inc.php"; ?>