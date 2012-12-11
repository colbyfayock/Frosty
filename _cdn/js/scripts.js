// Share link tootltip
$(function(){
	$('.panel-title-share-link').click(function(e){
		e.preventDefault();
		$(this).parent().find('.panel-title-share-box').toggle();
	});
	$('.panel-title-share-box').mouseleave(function(){
		$(this).fadeOut("fast");
	});
});

// Slide the mobile nav up and down
$(function(){
	$('#nav-mobile a').click(function(e){
		e.preventDefault();
		$('#nav').slideToggle('slow');
	});
});

// Site selection tabulars
$(function(){
	$('#site-selection li a').click(function(e){
		e.preventDefault();
		$('#site-selection li').removeClass('active');
		$('.panel').hide();
		var pnl = $(this).attr('id');
		if(pnl == 'all'){
			$('.panel').fadeIn('slow');
			$('a#all').parent().addClass('active');
		} else {
			$('div .' + pnl).fadeIn('slow');
			$('a#' + pnl).parent().addClass('active');
		}
	});
});