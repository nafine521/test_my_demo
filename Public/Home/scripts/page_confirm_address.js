var popUpApp = {
	'success': function(){
		document.title = '提交订单成功';
		$('.confirm_nav li.last').addClass('current').siblings('li').removeClass('current');
		$('#popUpSuccess').fadeIn(600);
		return false;
	},
	'fail': function(){
		document.title = '提交订单失败';
		$('.confirm_nav li.last').addClass('current').siblings('li').removeClass('current');
		$('#popUpFail').fadeIn(600);
		return false;
	},
	'close': function(element){
		$(element).closest('.popup_box').fadeOut(600);
		return false;
	}
}