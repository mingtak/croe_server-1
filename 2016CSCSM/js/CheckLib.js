<!--
/**********************************************************************************************/
// 檢查欄位是否為空白
/**********************************************************************************************/
function CheckEmpty(obj, field, max, min) {
	// 檢查欄位空白
	if (isEmpty(obj.value)==false) {
		alert("請確實輸入"+ field +"，或至少選擇一個項目，謝謝！");
		obj.focus();
		return false;
	}
	else if (max != null && obj.value.length > max) {
		alert("您輸入的「"+ field +"」資料長度過長，請輸入" + max + "個位元內之資料！");
		obj.focus();
		obj.select();
	}
	else if (min != null && obj.value.length < min) {
		alert("您輸入的「"+ field +"」資料長度過短，請輸入超過" + min + "個位元之資料！");
		obj.focus();
		obj.select();
	}
	else {
		return true;
	}
}

function CheckRadio(obj, field) {
	var count = 0;
	for (var i =0; i < obj.length; i++) {
		if (obj[i].checked == true) {
			count++;
		}
	}
	if (count) {
		return true;
	}
	else {
		alert("您至少必須選擇一樣「" + field + "」中的項目");
		obj[0].focus();
		obj[0].select();
	}
}

/**********************************************************************************************/
// 檢查電子郵件信箱
/**********************************************************************************************/
function CheckEmail(obj) {
	if (isEmpty(obj.value) != false) {
		if (isEmail(obj) == false) {
			alert("您填寫的 E-mail 信箱不正確；請重新確認，謝謝！");
			obj.focus();
			obj.select();
			return false;
		}
		else {
			return true;
		}
	}
	else {
		alert("您未填寫 E-mail 欄位；請重新確認，謝謝！");
		obj.focus();
		obj.select();
		return false;
	}
}

/**********************************************************************************************/
// 檢查網址
/**********************************************************************************************/
function CheckHttp(obj) {
	if (isEmpty(obj.value) != false) {
		if (isHttp(obj) == false) {
			alert("您的 WWW 網址不正確；請重新確認，謝謝！");
			obj.focus();
			obj.select();
			return false;
		}
		else {
			return true;
		}
	}
	else {
		alert("您未填寫 WWW 網址 ；請重新確認，謝謝！");
		obj.focus();
		obj.select();
		return false;
	}
}

/**********************************************************************************************/
// 檢查身份證字號
/**********************************************************************************************/
function checkIDNum(obj)
{
	var acc = 0;
	var idx = obj.value;

	if (idx != "")
	{
		idz = idx.split("");
		if ((idz[0] == "A") || (idz[0] == "a")) { acc = 10; }
		else if ((idz[0] == "B") || (idz[0] == "b")) { acc = 11; }
		else if ((idz[0] == "C") || (idz[0] == "c")) { acc = 12; }
		else if ((idz[0] == "D") || (idz[0] == "d")) { acc = 13; }
		else if ((idz[0] == "E") || (idz[0] == "e")) { acc = 14; }
		else if ((idz[0] == "F") || (idz[0] == "f")) { acc = 15; }
		else if ((idz[0] == "G") || (idz[0] == "g")) { acc = 16; }
		else if ((idz[0] == "H") || (idz[0] == "h")) { acc = 17; }
		else if ((idz[0] == "J") || (idz[0] == "j")) { acc = 18; }
		else if ((idz[0] == "K") || (idz[0] == "k")) { acc = 19; }
		else if ((idz[0] == "L") || (idz[0] == "l")) { acc = 20; }
		else if ((idz[0] == "M") || (idz[0] == "m")) { acc = 21; }
		else if ((idz[0] == "N") || (idz[0] == "n")) { acc = 22; }
		else if ((idz[0] == "P") || (idz[0] == "p")) { acc = 23; }
		else if ((idz[0] == "Q") || (idz[0] == "q")) { acc = 24; }
		else if ((idz[0] == "R") || (idz[0] == "r")) { acc = 25; }
		else if ((idz[0] == "S") || (idz[0] == "s")) { acc = 26; }
		else if ((idz[0] == "T") || (idz[0] == "t")) { acc = 27; }
		else if ((idz[0] == "U") || (idz[0] == "u")) { acc = 28; }
		else if ((idz[0] == "V") || (idz[0] == "v")) { acc = 29; }
		else if ((idz[0] == "W") || (idz[0] == "w")) { acc = 30; }
		else if ((idz[0] == "X") || (idz[0] == "x")) { acc = 31; }
		else if ((idz[0] == "Y") || (idz[0] == "y")) { acc = 32; }
		else if ((idz[0] == "Z") || (idz[0] == "z")) { acc = 33; }
		else if ((idz[0] == "I") || (idz[0] == "i")) { acc = 34; }
		else if ((idz[0] == "O") || (idz[0] == "o")) { acc = 35; }

		if (acc == 0)
		{
			alert("身份證字號的第一個位元必須是英文字母！");
			obj.select();
			obj.focus();
			return false;
		}
		else
		{
			accstr = new String(acc);
			acc_1 = (accstr).charAt(0);
			acc_2 = (accstr).charAt(1);
			certSum = (1 * acc_1) + (9 * acc_2) + (8 * idz[1]) + (7 * idz[2]) + (6 * idz[3]) + (5 * idz[4]) + (4 * idz[5]) + (3 * idz[6]) + (2 * idz[7]) + (1 * idz[8]);
			certSum_2 = parseInt(certSum % 10);
			certSum_3 = (10 - certSum_2);
			
			if (idz[9] != certSum_3)
			{
				alert("請檢查『身份證號碼』是否輸入錯誤！");
				obj.select();
				obj.focus();
				return false;
			}			
			else
			{
				return true;
			}
		}
	}
	else
	{
		alert("請輸入身份證號碼");
	}
}

/**********************************************************************************************/
// 檢查是否相同
/**********************************************************************************************/
function CheckEQ(obj, toobj, name, toname) {
	if (obj.value != toobj.value) {
		alert("您輸入的" + name + "的內容與" + toname + "不一樣，請重新確認，謝謝！");
		toobj.focus();
		toobj.select();
		return false;
	}
	return true;
}

/**********************************************************************************************/
// 檢查是否為空白之模組
/**********************************************************************************************/
function isEmpty(text) {
	if (text.length==0) {
		return false;
	}
	var i=0;
	while (i<text.length) {
		if (text.substring(i,i+1)!="") {
			return true;
		}
		i=i+1;
	}
	return false;
}

/**********************************************************************************************/
// 檢查電子郵件帳號之模組
/**********************************************************************************************/
function isEmail(address) {
	if (address.value.indexOf("@") != "-1" &&
		address.value.indexOf(".") != "-1" &&
		address.value != "" &&
		address.value.indexOf("<") == "-1" &&
		address.value.indexOf(">") == "-1")
		return true;
	else return false;
}

/**********************************************************************************************/
// 檢查是否為正確之網址
/**********************************************************************************************/
function isHttp(url) {
	if (url.value.indexOf("http://") != "-1" &&
     url.value.indexOf(".") != "-1" &&
     url.value != "" &&
     url.value.indexOf("<") == "-1" &&
     url.value.indexOf(">") == "-1")
	return true;
	else return false;
}
//-->