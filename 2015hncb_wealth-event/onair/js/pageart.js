// JavaScript Document



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
		
