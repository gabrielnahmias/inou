$(document).ready(function(){
	
	$(document).pngFix();
	
	$(":submit").click(function(){ $(":submit").blur(); }); // this achieves facebook-like submits, with no inside border on firefox

});


function ext(path) {

	var dotP = path.lastIndexOf('.') + 1;
	
	return path.substr(dotP);

}

function in_array(needle, haystack, argStrict) {
	
    var key = '', strict = !!argStrict;

    if (strict) {
        for (key in haystack) {
            if (haystack[key] === needle) {
                return true;
            }
        }
    } else {
        for (key in haystack) {
            if (haystack[key] == needle) {
                return true;
            }
        }
    }

    return false;

}