<?php include_once "header.inc.php"; ?>
		
        <?php if ( FILE == "index.php" ) { ?>
		
    	<form onSubmit="login(); return false;">
		<?php } ?>
        
        <table>
            
            <tbody>
                
                <tr>
                	
                    <td class="logo<?php if (FILE != "index.php") print "ext"; ?>" rowspan="2"><a class="noborder" href="<?php print URL; ?>"><img alt="<?php print APP; ?>"  src="<?php if (FILE == "error.php") print "../../../../../../inou/"; ?>img/logo.png" title="<?php print APP; ?>" /></a></td>
                    
                    <?php if ( FILE == "index.php" ) : ?>
                    
                    <td class="login"><input class="gray" id="email" maxlength="60" name="email" tabindex="1" type="text" value="Email" /></td>
                    
                    <td class="login"><input class="gray" id="pass" maxlength="20" name="pass" tabindex="2" type="password" value="Password" /></td>
                    
                    <td><input id="submit" type="submit" value="Login" <?php // onclick="alert(remember.checked)" ?> /></td>
                    
                </tr>
                
                <tr>
                    
                    <td align="left"><input id="remember" tabindex="3" name="remember" type="checkbox" /> <label for="remember">Remember me</label></td>
                    
                    <td align="left"><a onclick="window.open('forgot.php','forgot','width=575,height=300,directories=no,location=no,menubar=no,resizable=no,scrollbars=0,status=no,toolbar=no');" title="I Know Man, Sucks">Forgot your password?</a></td>
                    
                    
					<?php endif; ?>
                    
                </tr>
                
            </tbody>
            
        </table>
		<?php if ( FILE == "index.php" ) { ?>
        
        </form>
		<?php } ?>
    
    </div>
    
    <div id="middle" align="center">
    	