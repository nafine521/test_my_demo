$(function(){
	/* 绑定鼠标悬停产品列表事件 */
	$('.product_list li').hover(function(){
		$(this).children('.img').children('a').finish().slideDown();
	}, function(){
		$(this).children('.img').children('a').finish().slideUp();
	});
});