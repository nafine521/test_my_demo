<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="/Q2/tp1611/Public/Admin/text/javascript" src="lib/html5.js"></script>
<script type="/Q2/tp1611/Public/Admin/text/javascript" src="lib/respond.min.js"></script>
<script type="/Q2/tp1611/Public/Admin/text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/Q2/tp1611/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>意见反馈</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 评论管理 <span class="c-gray en">&gt;</span> 意见反馈 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">

	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> <span class="r">共有数据：<strong><?php echo (count($list)); ?></strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" ></th>
					<th width="60">ID</th>

					<th>留言内容</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
					<td><input type="checkbox" value="<?php echo ($v['id']); ?>" name="del"></td>
					<td><?php echo ($v["id"]); ?></td>

					<td class="text-l"><div class="c-999 f-12">
							<u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo (getNameByuId("user",$v["uid"])); ?>','<?php echo U('userShow',array("id"=>$v['uid']));?>','360','400')"><?php echo (getNameByuId("user",$v["uid"])); ?></u> <time title="<?php echo ($v["pubdate"]); ?>" datetime="<?php echo ($v["pubdate"]); ?>"><?php echo (date($v["pubdate"],"Y-m-d H:i:s")); ?></time> <span class="ml-20"><?php echo ($v["tel"]); ?></span> <span class="ml-20"><?php echo ($v["email"]); ?></span></div>
						<div><?php echo ($v["contents"]); ?></div></td>
					<td class="td-manage"><a title="删除" href="javascript:;" onclick="member_del(this,<?php echo ($v['id']); ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
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
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3]}// 制定列不参与排序
		]
	});
	/*$('.table-sort tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});*/
});
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,w,h){
	layer_show(title,url,w,h);
}

/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*评论-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
	    $.post("<?php echo U('Base/comDel');?>",{"tableName":'feedback','id':id},function(res) {
            if (res.status == "y") {
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
            }
        });

	});
}


function  datadel(){
    var bechoosed=$("input[name='del']:checked");
    if (bechoosed.length==0){
        layer.msg("请先选择要删除的留言",{icon:2,time:1000});
        return false;
	}
    var strId=""
    $(bechoosed).each(function (e) {
         strId += $(this).val();
    });

    layer.confirm('确认要删除吗？',function(index){

            $.post("<?php echo U('Base/comDel');?>",{"tableName":'feedback','id':strId},function(res) {
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