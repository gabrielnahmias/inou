<?php

include_once "user.inc.php";

User::ProtectPage();

include_once "toolbar.inc.php";

if ( !isset($_GET['p']) )
	$uid = $_SESSION['uid'];
else
	$uid = $_GET['p'];

$info = User::Info($uid);

$image = "img/users/$uid/main.jpg";

print "<div id=\"lpane\">";

if ( $uid == $_SESSION['uid'] )
	print "<div class=\"uploadPic\">\r\n\r\n";

print "<a href=\"#\" class=\"noborder\"><img id=\"profImg\" src=\"";

if ( file_exists($image) )
	print $image;
else
	print "img/unknown ".$info['gender'].".png";

print "\" width=\"200\" /></a>";

if ( $uid == $_SESSION['uid'] )
	print "<div class=\"uploadText\"><a href=\"upload.php\" rel=\"upload\">Upload Profile Picture</a></div>";

if ( $uid == $_SESSION['uid'] )
	print "</div>";

print "</div>";

print "<span class=\"name\">{$info['name']}</span>";

?>

<ul class="tabs">
	<li><a class="s" href="#">Board</a></li>
	<li><a class="s" href="#" >Info</a></li>
	<li><a class="s" href="#">Pics</a></li>
</ul>

<!-- tab "panes" -->
<div class="panes">

	<div><?php for($i=0;$i<=100;$i++) print "Testing the display of this with a large amount of text.  "; ?></div>

	<div>
    	
        <table cellspacing="10">
            
            <tr>
            	
            	<td><strong>Sex:</strong></td>
				<td><?php print ucfirst($info['gender']); ?></td>
            
            </tr>
            
            <tr>
            	
            	<td><strong>Birthday:</strong></td>
				<td><?php print $info['birthday']; ?></td>
            
            </tr>
            
            <tr>
            	
            	<td><strong>Member Since:</strong></td>
				<td><?php print $info['regdate']; ?></td>
            
            </tr>
            
        </table>
        
    </div>

	<div>
    
    	<?php include "gallery.php"; ?>
        
    </div>

</div>

<script>

$(function() {

	$("ul.tabs").tabs("div.panes > div");
	
	$("a[rel='upload']").colorbox( {
		
		height: '230px',
		
		title:'UPLOAD PROFILE PICTURE',
		
		width: '500px'/*,
		onClosed: function() {
			
		}*/
		
	} );

});

</script>

<?php include_once "footer.inc.php"; ?>