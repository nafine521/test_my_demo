<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/html5.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/Q2/tp1611/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/css/page.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>导航列表</title>
<style>
	.td-status{cursor: pointer;}
</style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 自定义导航管理 <span class="c-gray en">&gt;</span> 导航列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<form action="" method="post">
		<input type="text" class="input-text" style="width:250px" placeholder="输入导航名称" name="word" >
		<button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 搜导航</button>

	</form>
	</div>

	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_add('添加导航','<?php echo U('System/navAdd');?>','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加导航</a></span> <span class="r">共有数据：<strong><?php echo (count($list)); ?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-bg table-hover table-sort">
		<thead>


			<tr class="text-c">
				<th width="25"><input type="checkbox"></th>
				<th width="40">ID</th>
				<th width="250">名称</th>
				<th width="280">链接</th>
				<th width="60">是否打开新窗口</th>
				<th>位置</th>
				<th width="100">排序</th>
				<th width="100">是否显示</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><tr class="text-c">
				<td><input type="checkbox" value="<?php echo ($v["id"]); ?>" name="idDel"></td>
				<td><?php echo ($k); ?></td>
				<td><input type="text" class="input-text" value="<?php echo ($v["name"]); ?>" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'name')"></td>
				<td><input type="text" class="input-text" value="<?php echo ($v["link"]); ?>" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'link')"></td>
				<td><img src="/Q2/tp1611/Public/Admin/images/icon_<?php echo ($v['is_open_new']?'right':'error'); ?>_s.png" onclick="status(this,<?php echo ($v["id"]); ?>,'is_open_new',<?php echo ($v["is_open_new"]); ?>)"></td>
				<td>
					<label class="form-label col-3">&nbsp;</label>
					<div class="formControls col-5"  > <span class="select-box" >
					<select name="local" size="1" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'local')" style="width:auto;border:none;">
						<option value="0" <?php if($v["local"] == '0'): ?>selected<?php endif; ?> >顶部</option>
						<option value="1" <?php if($v["local"] == 1): ?>selected<?php endif; ?> >子导航</option>
						<option value="2" <?php if($v["local"] == 2): ?>selected<?php endif; ?> >会员导航</option>
					</select>
					</span></div>
				</td>
				<td><input type="text" value="<?php echo ($v["sort"]); ?>" class="input-text" style="text-align: center;" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'sort')"></td>
				<td class="td-status">
					<span class="label label-<?php echo ($v['is_show']?'success':'default'); ?> radius" onClick="nav_<?php echo ($v['is_show']?'stop':'start'); ?>(this,<?php echo ($v["id"]); ?>,'is_show')" ><?php echo ($v['is_show']?'显示':'不显示'); ?></span>
				</td>
				<td class="td-manage"><a title="编辑" href="javascript:;" onclick="admin_edit('导航编辑','<?php echo U('navAdd',array('id'=>$v['id']));?>','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_del(this,<?php echo ($v["id"]); ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			<!-- <tr>
				<td colspan="9" id="page"><?php echo ($page); ?></td>
			</tr> -->
		</tbody>
	</table>
	</div>
</div>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,8]}// 制定列不参与排序
	]
});
	//改变状态
	function status(obj,id,field_name,field_val){
	    var field_new=0;
	    var imgSrc="/Q2/tp1611/Public/Admin/images/icon_error_s.png";
	    if(field_val==0){
	        field_new=1;
            imgSrc="/Q2/tp1611/Public/Admin/images/icon_right_s.png";
		}
		var status="status(this,"+id+",'"+field_name+"',"+field_new+")";
	    $.post("<?php echo U('Base/status');?>",{"tableName":'nav',"fieldName":field_name,"primary":'id','id':id,"fieldVal":field_new},function(res){
				if(res.status=='y'){
			    $(obj).attr('src',imgSrc);
			    $(obj).attr('onclick',status);
				}else {
					layer.msg('修改失败!请稍后再试',{icon:1,time:1000});
				}
    })
	}

	// 改变val值
	function saveVal(obj,id,field_name){
		var field_new=$(obj).val();
		$.post("<?php echo U('Base/status');?>",{"tableName":'nav',"fieldName":field_name,"primary":'id','id':id,"fieldVal":field_new},function(res){
			if (res.status=="y") {
				layer.msg('已修改!',{icon:1,time:1000});
			}
		})
	}
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*导航-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*导航-删除
* 单个
* */
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.post("<?php echo U('Base/comDel');?>",{"id":id,"tableName":"nav"},function (res) {
			if (res.status=="y") {
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			};
		});

	});
}

	/*导航-删除
	 * 多个
	 * */
	function datadel(){
		var dataId=$("input[name='idDel']:checked");
		if (dataId.length==0) {
			alert("请先选择");
			return false;
		};
		for(var i=0;i<dataId.length;i++){
            admin_del(dataId.eq(i),dataId.eq(i).val());
		}
	}
/*导航-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*不显示*/
function nav_stop(obj,id,field_name){
	layer.confirm('确认不显示吗？',function(index){
		var status="nav_start(this,"+id+",'"+field_name+"')";
		//此处请求后台程序
		$.post("<?php echo U('Base/status');?>",{"tableName":'nav',"fieldName":field_name,"primary":'id','id':id,"fieldVal":'0'},function(res){
			if (res.status=='y'){
				// 成功后的前台处理……

                $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius"  onclick="'+status+'">不显示</span>');
                 $(obj).remove();
                layer.msg('不显示了!',{icon: 5,time:1000});
			}
        })

	});
}

/*显示*/
function nav_start(obj,id,field_name){
	layer.confirm('确认显示吗？',function(index){
		var status="nav_stop(this,"+id+",'"+field_name+"')";

		//此处请求后台程序
		$.post("<?php echo U('Base/status');?>",{"tableName":'nav',"fieldName":field_name,"primary":'id','id':id,"fieldVal":1},function (res) {
			if(res.status=='y'){
				// 成功后的前台处理……

                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius" onclick="'+status+'">已显示</span>');
                 $(obj).remove();
                layer.msg('已显示!', {icon: 6,time:1000});
			}
        })


	});
}
</script>
</body>
</html>