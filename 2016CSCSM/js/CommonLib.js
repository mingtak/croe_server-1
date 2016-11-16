<!--
/********************************************************************************************/
function TdColor(obj, objColor) {
	obj.style.backgroundColor = objColor;
}
/********************************************************************************************/
function TopBottom(obj, objType) {
	if (objType == 1) {
		obj.style.borderTopColor = '#FFFFFF';
		obj.style.borderLeftColor = '#FFFFFF';
		obj.style.borderBottomColor = '#AAAAAA';
		obj.style.borderRightColor = '#AAAAAA';
	}
	else if (objType == 2) {
		obj.style.borderColor = '#FFFFFF';
	}
	else if (objType == 3) {
		obj.style.borderTopColor = '#808080';
		obj.style.borderLeftColor = '#808080';
		obj.style.borderBottomColor = '#FFFFFF';
		obj.style.borderRightColor = '#FFFFFF';
	}
}
/********************************************************************************************/
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
		day = (year) ? 29 : 28;
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
/********************************************************************************************/
function PicShow(publicPath, objNo, objTable, objNum) {
	window.open(publicPath + "picshow.php?no=" + objNo + "&table=" + objTable + "&num=" + objNum, "picshow", "width=800,height=600,toolbar=no,menubar=no");
}
/********************************************************************************************/
function PicExist(chk,num) {
	if (chk) {
		document.all("Unexist" + num).style.display = "none";
		document.all("Exist" + num).style.display = "";
	}
	else {
		document.all("Unexist" + num).style.display = "";
		document.all("Exist" + num).style.display = "none";
	}
}
/********************************************************************************************/
//-->