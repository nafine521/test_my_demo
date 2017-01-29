$(function(){
	/* 点击显示密码按钮 */
	$('.input.show_password').click(function(e){
		e.preventDefault();
		var status = $(this).hasClass('active');
		if(!status){
			$(this).addClass('active');
			$(this).prev('.input.password').attr('type', 'text');
		}
		else{
			$(this).removeClass('active');
			$(this).prev('.input.password').attr('type', 'password');
		}
	});
});