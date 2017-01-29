$(function(){
	$('.tab_box').each(function(){
		var tabs = $(this).children('.tabs').children('.tab'),
			tab_con = $(this).children('.tab_content');
		/* 绑定标签单击事件 */
		tabs.click(function(e){
			var index = $(this).index();
			tabs.eq(index).addClass('current').siblings('.tab').removeClass('current');
			tab_con.eq(index).show().siblings('.tab_content').hide();
			e.preventDefault();
		});
		/* 绑定标签鼠标悬停事件 */
		tabs.hover(function(){
			$(this).addClass('active');
		}, function(){
			$(this).removeClass('active');
		});
		/* 初始化标签页 */
		tabs.first().click();
	});
});