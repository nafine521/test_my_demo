$(function(){
	$('input:checkbox').click(function(){
		$('*[itemnumberfield]').html($('li.entry input:checkbox:checked').length);
		var total = 0,
			addition = parseFloat($('*[itemadditionfield]').text()) || 0;
		$('li.entry input:checkbox:checked').each(function(){
			total += parseFloat($(this).closest('li.entry').find('.total').text() || $(this).closest('li.entry').find('.subtotal').text());
		});
		var delivry=parseFloat($("#delivery").text());
		if (isNaN(delivry)) delivry=0.00;
        var insurance=parseFloat($("#insurance").text());
        if (isNaN(insurance)) insurance=0.00;
		$('*[itemtotalfield]').html((total + addition+delivry+insurance).toFixed(2).toString());
	});

	$("#calculator").click(function () {
		//console.log($(this).is(":checked"));
		if($(this).is(":checked")) $("input[type='checkbox']").attr("checked",true);
		else $("input[type='checkbox']").attr("checked",false);
    })
});