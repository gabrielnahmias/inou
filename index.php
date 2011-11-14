<?php

include_once "user.inc.php";

User::ProtectPage();

include_once "top.inc.php"; ?>

        <table>
        	
            <tbody>
                
                <tr>
                    
                    <td id="info">
                        
                        <h1><?php print APP; ?> is a tool for making mass communication fun and effortless. <noscript>  Unfortunately, you need JavaScript to do anything here.  Peace.</noscript></h1>
                        
                        <br />
                        <br /><div id="world">&nbsp;</div>
                        
                    </td>
                    
                    <td id="signup">
                        
                        <h1>Sign Up</h1>
                        
                        <br /><h2>It's a free investment.</h2>
                        
                        <br />
                        
                        <!-- form is only here so that the submit button works when you hit enter. -->
                        
                        <form onSubmit="register(); return false">
                            
                            <table align="center">
                                
                                <tbody>
                                    
                                    <tr>
                                        
                                        <td><label for="first">First Name:</label></td>
                                        
                                        <td><input id="first" maxlength="50" name="first" type="text" /></td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td><label for="last">Last Name:</label></td>
                                        
                                        <td><input id="last" maxlength="50" name="last" type="text"/></td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td><label for="reg_email">Your Email:</label></td>
                                        
                                        <td><input id="reg_email" maxlength="60" name="reg_email" type="text"/></td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td><label for="reg_email2">Re-enter Email:</label></td>
                                        
                                        <td><input id="reg_email2" maxlength="60" name="reg_email2" type="text"/></td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td><label for="password">Password:</label></td>
                                        
                                        <td class="right"><input id="password" maxlength="20" name="password" type="password"/></td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td><label for="gender">Gender:</label></td>
                                        
                                        <td class="right">
                                        
                                        	<select id="gender" name="gender">
                                            	<option value="-1">Select</option>
                                            	<option value="0">Male</option>
                                            	<option value="1">Female</option>
                                            </select>
                                        
                                        </td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td><label for="bday_mon">Birthday:</label></td>
                                        
                                        <td class="right">
                                        	
                                            <select id="bday_mon" name="bday_mon">
                                            	<option value="-1">Month</option>
<?php // ugly, I know, but necessary to make source look nice on the browser end
                                                
												$months = array("January","February","March","April","May","June",
																"July","August","September","October","November","December");
												
												for ($i = 0; $i <= 11; $i++)
													print tab(6) . "<option value=\"$i\">" . substr($months[$i], 0, 3) . "</option>\r\n";
													
												?>
                                            </select>
                                            
                                            <select id="bday_day" name="bday_day">
                                            	<option value="-1">Day</option>
<?php
												
                                                for ($i = 1; $i <= 31; $i++)
													print tab(6) . "<option value=\"$i\">$i</option>\r\n";
													
												?>
                                            </select>
                                        
                                            <select id="bday_year" name="bday_year">
                                            	<option value="-1">Year</option>
<?php
                                                
												for ($i = date("Y"); $i >= 1905; $i--)
													print tab(6) . "<option value=\"$i\">$i</option>\r\n";
												
												?>
                                            </select>
                                        
                                        </td>
                                        
                                    </tr>
                                    
                                    <tr>
                                    	
                                        <td><br /><img id="load" src="img/load.gif" /></td>
                                        
                                        <td class="right">
                                        	
                                            <br /><input type="submit" value="Sign Up" />
                                        	
                                        </td>
                                        
                                    </tr>
                                	
                                </tbody>
                                
                            </table>
                            
                            </form>
                        
                        <br /><div id="error"></div><div id="msg"></div>
                    
                    </td>
                    
                </tr>
            	
            </tbody>
            
        </table>
        
        <script>
		
		// if i want to use certain CSS styles on any other page I gotta do this.
		
		document.getElementById('error').style.display = 'none';
		document.getElementById('msg').style.display = 'none';
		$(document).ready(function(){ $("#error").css("display","none");$("#msg").css("display","none"); });
        
        </script>
        
<?php include_once "footer.inc.php"; ?>