<html>
<head>
<title></title>

<script src="js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	
	extensions = new Array("jpg","jpeg","gif","png");
	
	$("#loading")
	.ajaxStart(function(){
		$(this).css('visibility', 'visible');
	})
	.ajaxComplete(function(){
		$(this).css('visibility', 'hidden');
	});
	
	$('#upload').submit(function() {
		
		$('#msg').hide().val('');
		
		$(this).ajaxSubmit({
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       'upload4jquery.php',
			dataType:  'json'
		});
		
		//alert($("input[name='ufile']").fieldValue());
		
		return false;
		
	});
	
}); 

function showRequest(formData, jqForm, options) {
	
	var ufileValue = $("input[name='ufile']").val();
	
	if ( !ufileValue[0] ) {
	
		$('#msg').hide();
		$('#error').hide().slideDown().html("Please select a file.");
	
		return false;
	
	} else if ( !in_array( ext(ufileValue), extensions ) ) {
		
		$('#msg').hide();
		$('#error').hide().slideDown().html("Please select a valid picture.");
	
		return false;
		
	}

	return true;
} 

function showResponse(data, statusText)  {
	
	if (statusText == 'success') {
		
		//if (data.img != '') {
			//document.getElementById('result').innerHTML = '<img src="/upload/thumb/'+data.img+'" />';
			
			$('#error').hide();
			$('#msg').hide().slideDown().html('Your file has been uploaded!');
			
			setTimeout("window.location.reload()", 1000);
			
			/*
			^^^^^^^^^
			this seems to be the only way to refresh the picture.  i had another idea that seemed to be working and
			should, but for some reason fizzled out.. it automatically updated the profile image without the need for refresh
			and it is as follows (with possible $_SESSION usage instead of $uid which isn't declared in this file):
			
			document.getElementById("profImg").src = "./img/users/<?php print $uid; ?>/main.jpg";
			
			*/
		
		//} else {
		//	document.getElementById('msg').innerHTML = "Error: "+data.error;
		//}
		
	} else {
		
		$('#msg').hide();
		$('#error').slideDown().html('Unknown error!');
		
	}
	
} 

</script>

</head>

<center>

You can select a file of the following formats: <strong>JPG (JPEG)</strong>, <strong>GIF</strong>, or <strong>PNG</strong>.

<br />
<br /><form enctype="multipart/form-data" id="upload" method="POST" name="upload">

<input id="ufile" name="ufile" style=";" type="file">
<input style="margin-left: 10px;" type="submit" value="Upload" />

<img id="loading" src="img/load.gif" style="margin-left: 20px; visibility: hidden" />

</form>

<br><div id="msg" style="display: none; width: 300px"></div>
<div id="error" style="display: none; width: 300px"></div>

</center>

</html>