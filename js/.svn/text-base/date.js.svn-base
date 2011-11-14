Date.prototype.numDays = function() {

  var d = new Date(this.getFullYear(), this.getMonth() + 1, 0);

  return d.getDate();

};

Date.prototype.age = function() {
	
	var birthday = new Date( this.getFullYear(), this.getMonth(), this.getDate() );
	
	var today = new Date();
	
	birthday = birthday.getTime();
	today = today.getTime();
	
	var msYear = 1000*60*60*24*365.25;
	
	return Math.floor( (today - birthday) / msYear );
	
}

//var d = new Date(2008, 1);
//alert(d.numDays());