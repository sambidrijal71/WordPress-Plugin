// Simple Back To Top Scripts
jQuery(document).ready(function() 
{
    jQuery("body").append('<div id="sbttBacktotop" class="sbttBacktotop"><img src="'+sbttback.sbttimg+'" alt"sbtt"></div>'); 
	jQuery(window).scroll(function()
	{
		if(jQuery(this).scrollTop()!=0)
		{
			jQuery("#sbttBacktotop").fadeIn()
		}
		else
		{
			jQuery("#sbttBacktotop").fadeOut()
			
		}
	});
	jQuery("#sbttBacktotop").on('click touchstart',function(e)
	{
		e.preventDefault();
		jQuery("body,html").animate({scrollTop:0},500);
		 return false; 
	});
});