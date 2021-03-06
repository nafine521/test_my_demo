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
<title>产品回收站列表</title>
</head>
<body>


<div>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

		<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
			<a class="btn btn-primary radius" onclick="reCycle()" href="javascript:;"><i class="Hui-iconfont">&#xe66b;</i> 批量还原</a></span>
			<span class="r">共有数据：<strong><?php echo (count($list)); ?></strong> 条</span> </div>
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
						<td><a onClick="product_show('<?php echo ($v['name']); ?>','<?php echo U('Picture/proPhotoShow',array("pro_id"=>$v['id']));?>',<?php echo ($v['id']); ?>)" href="javascript:;"><img width="60" class="product-thumb" src="/Q2/tp1611<?php echo ($v["img"]); ?>" alt="图片"></a></td>
						<td class="text-l"><input type="text" value="<?php echo ($v['name']); ?>" class="input-text" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'name')" onfocus="reVal(this)"></td>
						<td class="text-l"><input type="text" value="<?php echo ($v['goods_number']); ?>" class="input-text" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'goods_number')"  onfocus="reVal(this)"></td>
						<td><span class="price"><input type="text" value="<?php echo ($v['official_price']); ?>" class="input-text" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'official_price')"  onfocus="reVal(this)"></span></td>
						<td class="td-manage"><a style="text-decoration:none" class="ml-5" onClick="product_cycle(this,'<?php echo ($v['id']); ?>')" href="javascript:;" title="还原"><i class="Hui-iconfont">&#xe66b;</i></a>	<a style="text-decoration:none" class="ml-5" onClick="product_del(this,'<?php echo ($v['id']); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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

/*产品-还原*/
function product_cycle(obj,id){
	layer.confirm('确认要还原吗？',function(index){
        $.post("<?php echo U('Base/status');?>",{"tableName":'product',"fieldName":"is_trash","primary":'id','id':id,"fieldVal":0},function(res) {
            if (res.status == "y") {
                $(obj).parents("tr").remove();
                layer.msg('已还原!', {icon: 1, time: 1000});
            }
        });
	});
}
// 多个还原
function  reCycle(){
    	var bechoosed=$("input[name='del']:checked");



       layer.confirm('确认要还原吗？',function(index){
           $(bechoosed).each(function () {
               var strId=$(this).val();
               $.post("<?php echo U('Base/status');?>",{"tableName":'product',"fieldName":"is_trash","primary":'id','id':strId,"fieldVal":0},function(res) {
                   if (res.status == "y") {
                       $(bechoosed).each(function () {
                           $(this).parents("tr").remove();
                       });
                       layer.msg('已还原!', {icon: 1, time: 1000});
                   }
               });
           });

       });
   }
	/*产品-删除单个*/
function product_del(obj,id){
        layer.confirm('确认要删除吗？此操作不可撤销',function(index){
            $.post("<?php echo U('delTrash');?>",{"tableName":'product','id':id},function(res) {
                if (res.status == "y") {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }
            });
        });
    }
    /*产品删除多个*/
 function  datadel(){
        var bechoosed=$("input[name='del']:checked");
        var strId="";
        $(bechoosed).each(function () {
            strId+=$(this).val()+",";
        });
     if(strId==""){
         layer.msg('未选中数据!', {icon: 3, time: 1000});
         return false;
     }
        layer.confirm('确认要删除吗？此操作不可撤销',function(index){
            $.post("<?php echo U('delTrash');?>",{"tableName":'product','id':strId,},function(res) {
                if (res.status == "y") {
                    $(bechoosed).each(function () {
                        $(this).parents("tr").remove();
                    });
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }
            });
        });
    }
    /*下架所有产品。。貌似效果不好。。。
    *$(document).ready(function () {
	   	$.post("<?php echo U('trash');?>",function (res) {
		   if (res.status=="y"){
               layer.msg('所有产品已下架!', {icon: 1, time: 1000});
		   }
       })
   })*/
	/*产品图片-查看*/
    function product_show(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
</script>
</body>
</html>