/* 滚动到中央函数 */
function scroll_to_center(){
	$('body').scrollLeft(($(document).width() - $(window).width()) / 2);
}
/* 绑定滚动函数 */
$(document).ready(scroll_to_center);
$(window).resize(scroll_to_center);
/* 检测主体区域是否超过规定高度，如果是，加滚动条 */
$(document).ready(function(){
	$('.main').each(function(){
		var main = $(this),
			max_height = parseInt(main.css('max-height').replace('px', '')),
			height = main.height();
		if(height >= max_height){
			main.css('overflow-y', 'scroll');
		}
	});
});