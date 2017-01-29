$(function(){
	$('.num_box').each(function(){
		var min = parseFloat($(this).attr('min')) || 1,
			max = parseFloat($(this).attr('max')) || ~(1 << 31),
			/*init = $(this).attr('value') || min,*/
			autoreset = $(this).attr('autoreset') === 'false',
			input = $(this).children('input'),
			buttons = $(this).children('.buttons'),
			add_btn = buttons.children('.add'),
			min_btn = buttons.children('.minus');
		/* 验证函数 */
		function validate(ignoreAutoReset){
			var val = input.val(),
				flag = false;
			if(!autoreset && !ignoreAutoReset){
				if(val != parseFloat(val)){
					alert('输入值不是数字！');
					flag = true;
				}
				else if(val < min || val > max){
					alert('输入值超出范围！');
					flag = true;
				}
			}
			else if(val != parseFloat(val) || val < min || val > max){
				flag = true;
			}
			if(flag) input.val(min);
			return !flag;
		}
		/* 绑定验证函数到更改事件 */
		input.change(function(){
			validate(false);
		});
		/* 初始化赋值 */
		//input.val(init);
		/* 设置加减点击事件 */
		add_btn.click(function(){
			var val = parseFloat(input.val());
			input.val(val + 1);
			if(!validate(true)){
				input.val(val);
			}
		});
		min_btn.click(function(){
			var val = parseFloat(input.val());
			input.val(val - 1);
			if(!validate(true)){
				input.val(val);
			}
		});
	});
});