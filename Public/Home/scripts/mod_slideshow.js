$(function(){
	$('.slideshow').each(function(){
		var image = $(this).find('.image'),
			nav = $(this).find('.nav'),
			duration = $(this).attr('duration') || 800,
			clone_left = image.children('li').clone(),
			clone_right = image.children('li').clone(),
			image_count = image.children('li').length,
			image_width = image.children('li').outerWidth(true) || image.children('li').width() || image.width();
		/* 设置图片框初始宽度并添加前后副本 */
		image.css({
			'width': 3 * image_width * image_count,
			'left': -1 * image_width * image_count
		})
		.append(clone_left)
		.prepend(clone_right)
		.children('li').eq(image_count).addClass('current');
		/* 滚动函数 */
		function slideshow_scroll_to(page, direction){
			var current = image.children('li.current').index() % image_count;
			if(!page.toString().indexOf('+=')){
				page = (current + parseInt(page.substring(2))) % image_count;
			}
			else if(!page.toString().indexOf('-=')){
				page = (current - parseInt(page.substring(2)) + image_count) % image_count;
			}
			var op = (direction == 'right' ? '+=' : '-='),
				step = ((op == '+=' ? -1 : 1) * (page - current) + image_count) % image_count || image_count;
			image.finish().animate({'left': op + (image_width * step).toString()}, duration, function(){
				image
				.css({'left': -1 * image_width * (image_count + page)})
				.children('li').eq(image_count + page).addClass('current')
				.siblings('li').removeClass('current');
			});
		}
		/* 绑定滚动函数到导航按钮 */
		nav.children('li.prev').click(function(){
			slideshow_scroll_to("-=1", 'right');
		});
		nav.children('li.next').click(function(){
			slideshow_scroll_to('+=1', 'left');
		});
	});
});