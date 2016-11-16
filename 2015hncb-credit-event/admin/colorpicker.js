function selectColor(color) {
		self.parent.setColor(color);
	}

	function InitColorPalette() {
		if (document.getElementsByTagName)
			var x = document.getElementsByTagName('DIV');
		else if (document.all)
			var x = document.all.tags('DIV');
		for (var i=0;i<x.length;i++) {
			x[i].onmouseover = over;
			x[i].onmouseout = out;
			x[i].onclick = click;
			x[i].style.background=x[i].id;
		}
	}

	function over() {
		this.style.border='1px solid #FFF';
	}

	function out() {
		this.style.border='1px solid #888';
	}

	function click() {
		selectColor(this.id);
	}