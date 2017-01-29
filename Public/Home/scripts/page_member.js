$(function(){
	/* 点击隐藏时隐藏消息 */
	$('.hide_this').click(function(e){
		$(this).parent('.messages').fadeOut();
		e.preventDefault();
	});
})