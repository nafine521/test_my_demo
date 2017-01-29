<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/html5.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/Q2/tp1611/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/Q2/tp1611/Public/Admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>产品列表</title>
</head>
<body>


<div>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

		<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel('order')" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> <span class="r">共有数据：<strong><?php echo (count($trans_list)); ?></strong> 条</span> </div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="40"><input type="checkbox" value=""></th>
						<th width="40">订单编号</th>
						<th width="100">关注日期</th>
						<th>产品图片</th>
						<th width="100">该产品交易总数量</th>
						<th width="60">交易单价</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php if(is_array($cart_list)): $i = 0; $__LIST__ = $cart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c va-m">
						<td><input name="del" type="checkbox" value="<?php echo ($v["id"]); ?>"></td>
						<td><?php echo ($v["order_sn"]); ?></td>
						<td><?php echo (date("Y-m-d h:i:s",$v["order_date"])); ?></td>
						<td><a onClick="product_show('<?php echo ($v['name']); ?>','<?php echo U('Product/productAdd',array("id"=>$v['pro_id']));?>',<?php echo ($v['id']); ?>)" href="javascript:;"><img width="60" class="product-thumb" src="/Q2/tp1611<?php echo ($v["img"]); ?>" title="查看该产品"></a></td>
						<td class="text-l"><?php echo ($v["s_num"]); ?></td>

						<td><span class="price"><?php echo ($v["original_price"]); ?></span></td>


						<td class="td-manage">
						 <a style="text-decoration:none" class="ml-5" onClick="product_del(this,'<?php echo ($v['id']); ?>','order')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">


$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  {"orderable":false,"aTargets":[0,6]}// 制定列不参与排序
	]
});
/*产品-添加*/
function product_add(title,url,W,H){
	layer_show(title,url,W,H);
}
/*产品图片-查看*/
function product_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-单个删除*/
function product_del(obj,id,tableName){
	layer.confirm('确认要删除吗？',function(index){
        $.post("<?php echo U('Base/comDel');?>",{"tableName":tableName,'id':id},function(res) {
            if (res.status == "y") {

                $(obj).parents("tr").remove();
                layer.msg('已删除!', {icon: 1, time: 1000});
            }

        });

	});
}
function product_del1(obj,id,tableName){
    layer.confirm('确认要删除吗？',function(index){
        $.post("<?php echo U('Base/comDel');?>",{"tableName":tableName,'id':id},function(res) {
            if (res.status == "y") {

                $(obj).parents("tr").remove();
                layer.msg('已删除!', {icon: 1, time: 1000});
            }

        });
        product_del(obj,id,"cart");
    });
}
   function  datadel(tableName){
    	var bechoosed=$("input[name='del']:checked");
    	var strId="";
    	$(bechoosed).each(function () {
			strId+=$(this).val()+",";
        });
    	if (strId==""){
            layer.msg('请先选择!',{icon:3,time:1000});
            return false;
		}
       layer.confirm('确认要删除吗？',function(index){
           $.post("<?php echo U('Base/comDel');?>",{"tableName":tableName,'id':strId},function(res) {
               if (res.status == "y") {

                   $(bechoosed).each(function () {
                       $(this).parents("tr").remove();
                   });
                   layer.msg('已删除!', {icon: 1, time: 1000});
               }
           });
       });
   }
</script>
</body>
</html>