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
	<div class="pd-20">
		<div class="text-c"> 日期范围：
			<form action="" method="post">
			<input type="text" onfocus="WdatePicker({maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;" name="start">
			-
			<input type="text" onfocus="WdatePicker({minDate:'#F{ $dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;" name="end">
			<input type="text" name="word" placeholder=" 产品名称" style="width:250px" class="input-text">
			<button class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜产品</button>
			</form>
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="product_add('添加产品','<?php echo U('productAdd');?>',1100,'')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加产品</a></span> <span class="r">共有数据：<strong><?php echo (count($list)); ?></strong> 条</span> </div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="40"><input type="checkbox" value=""></th>
						<th width="40">ID</th>
						<th width="100">产品系列</th>
						<th width="50">产品编号</th>
						<th width="60">产品图</th>
						<th>产品名称</th>
						<th  width="100">库存量</th>
						<th width="100">单价/元</th>
						<th width="60">是否促销中</th>
						<th width="60">发布状态</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c va-m">
						<td><input name="del" type="checkbox" value="<?php echo ($v["id"]); ?>"></td>
						<td><?php echo ($v["id"]); ?></td>

						<td width="200">
							<label class="form-label col-3">&nbsp;</label>
							<div class="formControls col-5"  > <span class="select-box" >
							<select name="series_id" size="1" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'series')" style="width:auto;border:none;"  onfocus="reVal(this)">

								<?php if(is_array($serlist)): $i = 0; $__LIST__ = $serlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $v['series_id']): ?>selected<?php endif; ?> ><?php echo (getNameById("category",$vo["cat_id"])); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							</span></div>
						</td>
						<td><?php echo ($v['goods_sn']); ?></td>
						<td><a onClick="product_show('<?php echo ($v['name']); ?>','<?php echo U('Picture/proPhotoShow',array("pro_id"=>$v['id']));?>',<?php echo ($v['id']); ?>)" href="javascript:;"><img width="60" class="product-thumb" src="/Q2/tp1611<?php echo ($v["img"]); ?>" alt="查看所有图片"></a></td>
						<td class="text-l"><input type="text" value="<?php echo ($v['name']); ?>" class="input-text" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'name')" onfocus="reVal(this)"></td>
						<td class="text-l"><input type="text" value="<?php echo ($v['goods_number']); ?>" class="input-text" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'goods_number')"  onfocus="reVal(this)"></td>
						<td><span class="price"><input type="text" value="<?php echo ($v['official_price']); ?>" class="input-text" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'official_price')"  onfocus="reVal(this)"></span></td>
						<td><?php if($v['promo_price'] > '0'): ?><span class="label label-success radius">正在促销</span><?php else: ?><span class="label label-defaunt radius">正常展示</span><?php endif; ?></td>
						<td class="td-status">
						<?php if($v['is_sale'] == 1): ?><span class="label label-success radius">已上架</span>
							<?php else: ?>
							<span class="label label-defaunt radius">已下架</span><?php endif; ?>
						</td>
						<td class="td-manage">
							<?php if($v['is_sale'] == 1): ?><a style="text-decoration:none" onClick="product_stop(this,'<?php echo ($v['id']); ?>')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
							<?php else: ?>
							<a style="text-decoration:none" onClick="product_start(this,'<?php echo ($v['id']); ?>')" href="javascript:;" title="上架"><i class="Hui-iconfont">&#xe603;</i></a><?php endif; ?>

						<a style="text-decoration:none" class="ml-5" onClick="product_edit('产品编辑','<?php echo U('productAdd',array('id'=>$v['id']));?>')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="product_del(this,'<?php echo ($v['id']); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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
	//获取初始数据，修改失败便还原
	var recycl="";
	function reVal(obj) {
        recycl=$(obj).val();
    }
    // 改变val值
    function saveVal(obj,id,field_name){
        var field_new=$(obj).val();
        if(field_name=="goods_number"||field_name=="official_price"){
            if(isNaN(field_new)){
                $(obj).val(recycl);
                return false;
            }
		}
        $.post("<?php echo U('Base/status');?>",{"tableName":'product',"fieldName":field_name,"primary":'id','id':id,"fieldVal":field_new},function(res){
            if (res.status=="y") {
                layer.msg('已修改!',{icon:1,time:1000});
            }
        })
    }

$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
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

/*产品-下架*/
function product_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$.post("<?php echo U('Base/status');?>",{"tableName":'product',"fieldName":"is_sale","primary":'id','id':id,"fieldVal":0},function(res){
			if (res.status=="y") {
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_start(this,'+id+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe603;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
				$(obj).remove();
				layer.msg('已下架!',{icon: 5,time:1000});
			}

		})

	});
}

/*产品-发布*/
function product_start(obj,id){
	layer.confirm('确认要上架吗？',function(index){
		$.post("<?php echo U('Base/status');?>",{"tableName":'product',"fieldName":"is_sale","primary":'id','id':id,"fieldVal":1},function(res){
			if (res.status=="y") {
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_stop(this,'+id+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已上架</span>');
				$(obj).remove();
				layer.msg('已上架!',{icon: 6,time:1000});
			}
		});
	});
}

/*产品-编辑*/
function product_edit(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-单个删除*/
function product_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
        $.post("<?php echo U('Base/status');?>",{"tableName":'product',"fieldName":"is_trash","primary":'id','id':id,"fieldVal":1},function(res) {
            if (res.status == "y") {
                $(obj).parents("tr").remove();
                layer.msg('已删除,请在回收站查看!', {icon: 1, time: 1000});
            }
        });
	});
}
   function  datadel(){
    	var bechoosed=$("input[name='del']:checked");
       layer.confirm('确认要删除吗？',function(index){
           $(bechoosed).each(function (e) {
               var strId = $(this).val();
               $.post("<?php echo U('Base/status');?>",{"tableName":'product',"fieldName":"is_trash","primary":'id','id':strId,"fieldVal":1},function(res) {
                   if (res.status == "y") {
                       $(bechoosed).each(function () {
                           $(this).parents("tr").remove();
                       });
                       layer.msg('已删除,请在回收站查看!', {icon: 1, time: 1000});
                   }
               });
           });

       });
   }
</script>
</body>
</html>