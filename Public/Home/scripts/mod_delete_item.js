$(function(){
	/* 绑定删除单个的单击事件 */
	$('.delete_this').click(function(e){
		var order_id=$(this).parents("li.entry").find("input:checkbox").val();
		var theself=$(this);
		// alert(order_id);
        $.post(delUrl,{"order_id":order_id,"tableName":"order"},function (res) {
            if (res.status == "y") {
                theself.closest('li.entry').fadeOut(800, function () {
                    $(this).remove();
                });
            }
        });
		e.preventDefault();
	});
	/* 绑定批量删除的单击事件 */
	$('.delete_selected').click(function(e){
		var tar=$('.item_list li.entry input:checkbox:checked');
		var target = tar.parents('li.entry');
		var strId="";
		if(!target.length){
			alert('请勾选需要删除的产品！');
			return false;
		}
		$(tar).each(function (e) {
			strId+=$(this).val()+",";
        })
		//alert(strId);
		$.post(delUrl,{"order_id":strId},function (res) {
			if (res.status=="y"){
                target.fadeOut(800, function(){
                    $('.delete_selected').remove();
                });
			}
        })


		e.preventDefault();
	});
});