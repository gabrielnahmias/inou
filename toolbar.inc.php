<?php include_once "header.inc.php"; ?>
	
    <link href="css/dropdown.css" rel="stylesheet">
	
	<script src="js/dropdown.js"></script>
    
    	<a href="<?php print URL; ?>"><img id="logo" src="img/logosmall.png" /></a>
    	
        <!-- <div id="tools"><strong>Welcome, <em><?php //print $_SESSION['name']; ?></em></strong> | <a href="home.php">Home</a> | <a href="sandbox.php">Sandbox</a> | <a href="logout.php">Logout</a></div> -->
	
    <div id="tools">
    
    <ul id="jsddm">
        
        <li><a href="home.php">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="#" style="border-right: none;">Account ▼</a>
            <ul>
            	<li><a href="sandbox.php">Sandbox</a></li>
            	<li><a href="members.php">Member List</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
        
    </ul>
    
    </div>
            
    </div>
    
    <div id="middle" align="center">
    	