$(function(){
	$('.sidebar.type2 li.entry').each(function(){
		$(this).children('.header').click(function(){
			$(this).siblings('.sub_entry').finish().slideToggle();
		});
	});
});