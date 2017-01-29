$(function(){
	$('input:checkbox[groupid]').click(function(){
		var selectid = $(this).attr('groupid'),
			stat = $(this).prop('checked');
		$('input:checkbox[selectid=' + selectid + '], input:checkbox[groupid=' + selectid + ']').not(this)
		.prop('checked', stat);
	});
});