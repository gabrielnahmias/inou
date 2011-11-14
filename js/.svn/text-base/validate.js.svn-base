//$(document).ready(declare())

String.prototype.empty = function() {
	
	var filter = /\s/g;
	
	var str = this.replace(filter, "");
	
	if (str.length == 0)
		return true;
	else
		return false;
	
}

function declare() {
	
	// i had to make all of these global names unique because of fucking IE
	// making my life easier when referencing a DOM element and assuming that
	// some variables with the same name as objects on the page are the same
	
	firstname = $('#first').val();
	lastname = $('#last').val();
	email = $('#reg_email').val();
	email2 = $('#reg_email2').val();
	pw = $('#password').val();
	gen = $('#gender').val();
	month = $('#bday_mon').val();
	day = $('#bday_day').val();
	year = $('#bday_year').val();
	
	// division by 1000 is necessary because I use PHP as a backend which works
	// with seconds, and Javascript uses milliseconds
	
	birthday = ( ( new Date(year, month, day) ).getTime() ) / 1000;
	
}

function login() {
	
	LOGIN_ERROR = "Login Error";
	
	var gray = "rgb(170, 170, 170)";
	
	email = $('#email');
	pw = $('#pass');
	remember = $("#remember").is(':checked');
	
	var domain = email.val().split("@");
	domain = domain[1];
	
	if ( email.val().empty() || pw.val().empty() )
		$.colorbox( { html: 'Enter your login credentials.', title: LOGIN_ERROR, onClosed: function() { email.focus(); } } );
		
	else {
	
		$.post(
	
				"login.php",
	
				{ email: email.val(),
				  pass: pw.val(),
				  remember: remember },
	
				function(data) {
					//alert(data);
					// decypher login output
					
					if (data == "bad pw")
						$.colorbox( { html: 'Incorrect password.', title: LOGIN_ERROR, onClosed: function() { pw.focus(); } } );
					else if (data == "not activated")
						$.colorbox( { html: 'You have not yet activated your account.  <a href=\"http://'+domain+'\">Check your email</a>!', title: LOGIN_ERROR } );
					else if (data == "no such user")
						$.colorbox( { html: 'There is no user with that email.', title: LOGIN_ERROR, onClosed: function() { email.focus(); } } );
					else
						window.location = "home.php";
					
				}
			
			)
		
	}
	
}

function register() {
	
	if ( validate() ) {
		
		var domain = email.split("@");
		
		domain = domain[1];
		
		$("#error").slideUp(300, function() {});
		
		$("#msg").slideUp(300, function() {});
		
		$("#load").show();
		
		$.post(

			"register.php",

			{ email: email,
			  password: pw,
			  first: firstname,
			  last: lastname,
			  gender: gen,
			  birthday: birthday },

			function(data) {
				
				// decypher registration output
				
				$("#error").hide();
				$("#load").hide();
				$("#msg").hide();
				
				if (data == "exists")
					$("#error").slideDown(300, function() {}).html("It looks like that email has already been registered.");
				else
					$("#msg").hide().html("<b>Success!</b>  <a href=\"http://"+domain+"\">Check your email</a> to activate your account!").slideDown(300);
				
			}
		
		)
		
	}
	
}

function validate() {

	// This is the almighty form validation function written from scratch
	// by none other than Gabriel Nahmias.
	
	declare();
	
	var age = ( new Date(year, month, day) ).age();
	
	var filter = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	
	var invalid = "!@#$%^&*()+=[]\\\;,./{}|\":<>?";
		
	var error = "";
	
	var empty = 0;
	
	var valid = true;
	
	if (year == -1 || day == -1 || month == -1) {
		
		error = "Please select a valid birthday.";
		
		empty++;
		
	} else if (age < 13)
		error = "You must be at least 13 years old to join <b>inou</b>.";
	
	if (gen == -1) {
		
		error = "Please select a gender.";
		
		empty++;
		
	}
	
	if ( pw.empty() ) {
		
		error = "Please enter a password.";
		
		empty++;
	
	} else if (pw.length < 6)
		error = "Your password must be at least 6 characters.";
	
	if ( email.empty() || email2.empty() ) {
		
		error = "Please fill in both email fields.";
		
		empty++;
	
	} else if (email != email2)
		error = "Emails do not match.";
	else if ( !filter.test(email) )
		error = "Please enter a valid email address."
	
	for (var i = 0; i < firstname.length; i++) {
		
		if ( invalid.indexOf( firstname.charAt(i) ) != -1)
			error = "Name contains invalid characters.";
		
	}
	
	for (var i = 0; i < lastname.length; i++) {
		
		if ( invalid.indexOf( lastname.charAt(i) ) != -1)
			error = "Name contains invalid characters.";
		
	}
		
	if ( firstname.empty() || lastname.empty() ) {
		
		error = "Please enter your full name.";
		
		empty++;
		
	}
	
	if (empty > 1)
		error = "You must complete every field.";
	
	if (error != "") {
		
		valid = false;
		
		$("#msg").hide();
		
		$("#error").hide().html(error).slideDown(300, function() {});
		
	}
	
	return valid;
	
}