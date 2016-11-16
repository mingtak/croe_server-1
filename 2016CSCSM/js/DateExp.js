<!--
function DateExp(objYear,objMon,objDay,chk) {
	var xchk = (chk) ? 1911 : 0;
	for (var j = objDay.length - 1; j >= 0 ; j--) {
		objDay.options[j] = null;
	}
	var day,mon = objMon.selectedIndex;
	var years = eval(objYear.options[objYear.selectedIndex].value) + xchk;
	var year = (years % 4) ? 0 : 1;
	if (mon == 3 || mon == 5 || mon == 8 || mon == 10) {
		day = 30;
	}
	else if (mon == 1) {
		day = (year) ? 29:28;
	}
	else {
		day = 31;
	}
	for (var i = 0; i < day; i++) {
		k = (i+1);
		sprintf = (k < 10) ? "0"+k : k;
		objDay.options[i] = new Option(sprintf, sprintf);
	}
}

//-->