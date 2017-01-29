<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
<title>栏目管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 栏目管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20 text-c">
	<div class="text-c">

	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel('member')" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="system_category_add('添加栏目','<?php echo U('memberNavAdd');?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a></span> <span class="r">共有数据：<strong><?php echo (count($list)); ?></strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox"></th>
					<th width="80">ID</th>
					<th width="200">链接</th>
					<th>栏目名称</th>
					<th>所属栏目</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><tr class="text-c" id="tr<?php echo ($v["id"]); ?>">
					<td><input type="checkbox" name="idDel" value="<?php echo ($v['id']); ?>" ></td>
					<td><?php echo ($v["id"]); ?></td>
					<td><input  class="input-text" type="text" value="<?php echo ($v["link"]); ?>" onblur="saveVal(this,<?php echo ($v['id']); ?>,'link')" style="text-align: center;"></td>
					<td class="text-l"><input  class="input-text" type="text" value="<?php echo ($v["name"]); ?>" onblur="saveVal(this,<?php echo ($v['id']); ?>,'name')"></td>
					<td><?php echo (getNameById('member',$v["pid"])); ?></td>
					<td class="f-14"><a title="编辑" href="javascript:;" onclick="system_category_edit('栏目编辑','<?php echo U('memberNavAdd',array('id'=>$v['id']));?>','900','')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="system_category_del(this,<?php echo ($v['id']); ?>,'member')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,4]}// 制定列不参与排序
	]
});
/*系统-栏目-添加*/
function system_category_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-编辑*/
function system_category_edit(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-删除*/
//单个
function system_category_del(obj,id,tableName){

			layer.confirm('确认要删除吗？',function(index){
                $.post("<?php echo U('System/categoryDel');?>",{"id":id,"tableName":tableName},function (res) {

                    if(res.status=="y"){
                        for (var j=0;j<res.data.length;j++){
                            $("#tr"+res.data[j]).remove();
                        }
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
					}
				});
			});

}
//多个
	function datadel(tableName) {

		var getId=$("input[name='idDel']:checked");
		var strId="";
		if (getId.length==0) {
			alert("请先选择");
			return false;
		};
		for (var i=0;i<getId.length;i++){
                strId+=getId.eq(i).val()+",";
		}

        layer.confirm('确认要删除吗？',function(index){
            $.post("<?php echo U('categoryDel');?>",{"id":strId,"tableName":tableName},function (res) {

                if(res.status=="y"){
                    for (var j=0;j<res.data.length;j++){
                        $("#tr"+res.data[j]).remove();

					}
                    for (var k=0;k<getId.length;k++){
                        $("#tr"+getId.eq(k).val()).remove();
                    }
//                    $("#"+getId).remove();

//                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }
            });
        });
	}



// 改变val值
function saveVal(obj,id,field_name){
    var field_new=$(obj).val();
    $.post("<?php echo U('Base/status');?>",{"tableName":'category',"fieldName":field_name,"primary":'id','id':id,"fieldVal":field_new},function(res){
        if (res.status=="y") {
            layer.msg('已修改!',{icon:1,time:1000});
        };
    })
}
</script>
</body>
</html>