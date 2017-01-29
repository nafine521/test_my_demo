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
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>新闻列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 新闻管理 <span class="c-gray en">&gt;</span> 新闻列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c"> 
		<form action="" name="post">
		<input type="text" name="word" id="" placeholder="请输入关键字" style="width:250px" class="input-text">
		<button class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜关键字</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" data-title="添加资讯" onclick="article_add('添加新闻','<?php echo U('newsAdd');?>',1000,'')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a></span> <span class="r">共有数据：<strong><?php echo (count($list)); ?></strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox"></th>
					<th width="80">ID</th>
					<th>系列</th>
					<th width="80">标题</th>

					<th>内容</th>
					<th width="120">更新时间</th>
					<th width="60">热门推荐</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><tr class="text-c"  id="tr<?php echo ($v["id"]); ?>">
					<td><input type="checkbox" value="<?php echo ($v['id']); ?>" name="opt_id"></td>
					<td><?php echo ($v['id']); ?></td>
					<td width="200">
						<label class="form-label col-3">&nbsp;</label>
						<div class="formControls col-5"  > <span class="select-box" >
						<select size="1" onblur="saveVal(this,<?php echo ($v["id"]); ?>,'series_id')" style="width:auto;border:none;">
							
							<?php if(is_array($serlist)): $i = 0; $__LIST__ = $serlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $v['series_id']): ?>selected<?php endif; ?> ><?php echo (getNameById("category",$vo["cat_id"])); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</span></div>
					</td>
					<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','<?php echo U('newsAdd',array('id'=>$v['id']));?>')" title="查看"><?php echo ($v["title"]); ?></u></td>

					<td><?php echo (cutStr($v["content"])); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$v["pubdate"])); ?></td>
					<td class="td-status">
						<?php if($v['refer'] == 1): ?><span class="label label-success radius">已推荐</span>
							<?php else: ?>
							<span class="label label-defaunt radius">不推荐</span><?php endif; ?>
					</td>
					<td class="td-manage f-14 ">
							<?php if($v['refer'] == 1): ?><a style="text-decoration:none" onClick="news_stop(this,'<?php echo ($v['id']); ?>')" href="javascript:;" title="推荐"><i class="Hui-iconfont">&#xe6de;</i></a>
							<?php else: ?>
							<a style="text-decoration:none" onClick="news_start(this,'<?php echo ($v['id']); ?>')" href="javascript:;" title="推荐"><i class="Hui-iconfont">&#xe603;</i></a><?php endif; ?>
						<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','<?php echo U('newsAdd',array('id'=>$v['id']));?>')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,<?php echo ($v['id']); ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
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
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,5]}// 制定列不参与排序
	]
});

/*资讯-添加*/
function article_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*资讯-编辑*/
function article_edit(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.post("<?php echo U('Base/comDel');?>",{"tableName":"news","id":id},function(res){
			if (res.status=="y") {
				$(obj).parents("tr").remove();

				layer.msg('已删除!',{icon:1,time:1000});
			}
		})
		
	});
}
//多个
	function datadel() {

		var getId=$("input[name='opt_id']:checked");
		var strId="";
		if (getId.length==0) {
			alert("请先选择");
			return false;
		}
		for (var i=0;i<getId.length;i++){
                strId+=getId.eq(i).val()+",";
		}

        layer.confirm('确认要删除吗？',function(index){
            $.post("<?php echo U('Base/comDel');?>",{"id":strId,"tableName":"news"},function (res) {
                if(res.status=="y"){ 
                //删除勾选的id                   
                    for (var k=0;k<getId.length;k++){
                        $("#tr"+getId.eq(k).val()).remove();
                    }
                	layer.msg('已删除!',{icon:1,time:1000});
                }
            });
        });
	}

	// 改变val值
	function saveVal(obj,id,field_name){
		var field_new=$(obj).val();
		$.post("<?php echo U('Base/status');?>",{"tableName":'news',"fieldName":field_name,"primary":'id','id':id,"fieldVal":field_new},function(res){
			if (res.status=="y") {
				layer.msg('已修改!',{icon:1,time:1000});
			};
		})
	}

	/*新闻-不推荐*/
function news_stop(obj,id){
	layer.confirm('确认不推荐吗？',function(index){
		$.post("<?php echo U('Base/status');?>",{"tableName":'news',"fieldName":"refer","primary":'id','id':id,"fieldVal":0},function(res){
			if (res.status=="y") {
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_start(this,'+id+')" href="javascript:;" title="推荐"><i class="Hui-iconfont">&#xe603;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">不推荐</span>');
				$(obj).remove();
				layer.msg('不推荐了!',{icon: 5,time:1000});
			}else{
				layer.msg('操作失败!',{icon: 5,time:1000});
			}
			
		})
		
	});
}

/*新闻-发布*/
function news_start(obj,id){
	layer.confirm('确认要推荐吗？',function(index){
		$.post("<?php echo U('Base/status');?>",{"tableName":'news',"fieldName":"refer","primary":'id','id':id,"fieldVal":1},function(res){
			if (res.status=="y") {
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_stop(this,'+id+')" href="javascript:;" title="推荐"><i class="Hui-iconfont">&#xe6de;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已推荐</span>');
				$(obj).remove();
				layer.msg('已推荐!',{icon: 6,time:1000});
			}else{
				layer.msg('操作失败!',{icon: 5,time:1000});
			}

		});
	});
}
</script> 
</body>
</html>