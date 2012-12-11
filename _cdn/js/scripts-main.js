$(function(){
	$('.list-collapse h3 a').click(function(e){
		e.preventDefault();
		$(this).parent().parent().find('ul').slideToggle();
		$(this).parent().toggleClass("list");
	});
});