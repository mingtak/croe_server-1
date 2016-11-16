// JavaScript Document



$(document).ready(function(){
				
				$("a.openbut").click(
	function(){
		 $("#inpo").slideToggle('fast');
		});
		});



$(document).ready(function(){
				
				$("a.webmap").click(
	function(){
		 $("#sitemap").slideToggle('fast');
		});
		});










function intortag(id)
{
   switch(id)
   {
case 'tag1':
              $('#butbar td').removeClass("stay");
			  $('#sb1').addClass("stay");
			  $('.x a').removeClass("stay");
			  $('.x a:eq(0)').addClass("stay");
			  
			 
			  break;
			  
case 'tag2':
               	  $('#butbar td').removeClass("stay");
			  $('#sb2').addClass("stay");
			   $('.x a').removeClass("stay");
			  $('.x a:eq(1)').addClass("stay");
			  break;
			  
			  
case 'tag3':
               	 $('#butbar td').removeClass("stay");
			  $('#sb3').addClass("stay");
			   $('.x a').removeClass("stay");
			  $('.x a:eq(2)').addClass("stay");
			  break;
			  
			  
			  
case 'tag4':
               	  $('#butbar td').removeClass("stay");
			  $('#sb4').addClass("stay");
			   $('.x a').removeClass("stay");
			  $('.x a:eq(3)').addClass("stay");
			  break;
			  		  
			  
   } 
  
}