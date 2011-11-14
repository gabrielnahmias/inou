addEvent(window, 'load', start, false);

function start() {
	
	var monField = document.getElementById('bday_mon');
	var yearField = document.getElementById('bday_year');
	
	addEvent(monField, 'change', changeDays, false);
	addEvent(yearField, 'change', changeDays, false);
	
}

function changeDays() {
	
	var dayField = document.getElementById('bday_day');
	var monField = document.getElementById('bday_mon');
	var yearField = document.getElementById('bday_year');
	
	var month = monField.options[monField.selectedIndex].value;
	var year = yearField.options[yearField.selectedIndex].value;
	
	var d = new Date(year, month);
	var days = d.numDays();
	
	var sel = dayField.selectedIndex;
	
	for (var i = 1; i <= 30; i++)
		dayField.remove(i);
		
	for (var i = 1; i <= days; i++)
		dayField.options[i] = new Option(i, i, false, ( (i == sel) ? true : false ) );
	
}