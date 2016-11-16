// JavaScript Document



window.addEventListener('load',mqfunc);




 function mqfunc(){
	 
	 
	if(window.matchMedia("(min-width:781px)").matches){
		

	$(function(){
		// 幫 #menu li 加上 hover 事件
		$('#menu>li').hover(function(){
			// 先找到 li 中的子選單
			var _this = $(this),
				_subnav = _this.children('ul');
			
			// 變更目前母選項的背景顏色
			// 同時顯示子選單(如果有的話)
			_subnav.css('display', 'block');
		} , function(){
			// 同時隱藏子選單(如果有的話)
			// 也可以把整句拆成上面的寫法
			$(this).children('ul').css('display', 'none');

		});
		
		// 取消超連結的虛線框
		$('a').focus(function(){
			this.blur();
		});
	});






$(function(){
		// 幫 #menu li 加上 hover 事件
		$('#menux>li').hover(function(){
			// 先找到 li 中的子選單
			var _this = $(this),
				_subnav = _this.children('ul');
			
			// 變更目前母選項的背景顏色
			// 同時顯示子選單(如果有的話)
			_subnav.css('display', 'block');
		} , function(){
			// 同時隱藏子選單(如果有的話)
			// 也可以把整句拆成上面的寫法
			$(this).children('ul').css('display', 'none');

		});
		
		// 取消超連結的虛線框
		$('a').focus(function(){
			this.blur();
		});
	});









	}else if(window.matchMedia("(min-width: 481px) and (max-width: 780px)").matches){
		

	
		$(function(){
		// 幫 #menu li 加上 hover 事件
		$('#menu>li').hover(function(){
			// 先找到 li 中的子選單
			var _this = $(this),
				_subnav = _this.children('ul');
			
			// 變更目前母選項的背景顏色
			// 同時顯示子選單(如果有的話)
			_subnav.css('display', 'block');
		} , function(){
			// 同時隱藏子選單(如果有的話)
			// 也可以把整句拆成上面的寫法
			$(this).children('ul').css('display', 'none');

		});
		
		// 取消超連結的虛線框
		$('a').focus(function(){
			this.blur();
		});
	});

	


$(function(){
		// 幫 #menu li 加上 hover 事件
		$('#menux>li').hover(function(){
			// 先找到 li 中的子選單
			var _this = $(this),
				_subnav = _this.children('ul');
			
			// 變更目前母選項的背景顏色
			// 同時顯示子選單(如果有的話)
			_subnav.css('display', 'block');
		} , function(){
			// 同時隱藏子選單(如果有的話)
			// 也可以把整句拆成上面的寫法
			$(this).children('ul').css('display', 'none');

		});
		
		// 取消超連結的虛線框
		$('a').focus(function(){
			this.blur();
		});
	});







	
		
		
		

	}if(window.matchMedia("(max-width: 480px)").matches){
		
		
		
		
	$(function(){
		// 幫 #menu li 加上 hover 事件
		$('#menux>li').hover(function(){
			// 先找到 li 中的子選單
			var _this = $(this),
				_subnav = _this.children('ul');
			
			// 變更目前母選項的背景顏色
			// 同時顯示子選單(如果有的話)
			_subnav.css('display', 'block');
		} , function(){
			// 同時隱藏子選單(如果有的話)
			// 也可以把整句拆成上面的寫法
			$(this).children('ul').css('display', 'none');

		});
		
		// 取消超連結的虛線框
		$('a').focus(function(){
			this.blur();
		});
	});
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	  
	$(function(){

$("#menu_but").find('a').click(function(){
	
	$("#topfour").slideToggle('fast');
	});	
	});	


	
	
	
	}
    
	
};






















































$(document).ready(function(){
				
				$(".title.red").click(
	function(){
		 $(this).children('span').toggleClass('open');
		 $('#slidehide').slideToggle('fast');
		});
		});








 
  $(function(){

$("#pageline").find('a').click(function(){
	
	var y= $(this).index();
	
	$("#pageline").find('a').removeClass("stay");
	$(this).addClass("stay");
	$("#formlist").find('.page').removeClass("stay");
	$("#formlist").find('.page').eq(y).addClass("stay");
	});	
	});		
		







