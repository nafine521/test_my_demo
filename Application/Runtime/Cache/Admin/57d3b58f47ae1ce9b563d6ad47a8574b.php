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
<title>模块管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">

	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_permission_add('添加权限节点','<?php echo U('admin_moudle_add');?>','950','')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限节点</a></span> <span class="r">共有数据：<strong><?php echo (count($list)); ?></strong> 条</span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="7">权限节点</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox"value=""></th>
				<th width="40">ID</th>
				<th width="200">模块名称</th>
				<th>模块链接</th>
				<th>所属模块</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c" id="tr<?php echo ($v["id"]); ?>">
				<td><input type="checkbox" value="<?php echo ($v['id']); ?>" name="idDel"></td>
				<td><?php echo ($v["id"]); ?></td>
				<td><input  class="input-text" type="text" value="<?php echo ($v["name"]); ?>" onblur="saveVal(this,<?php echo ($v['id']); ?>,'name')"></td>
				<td><input  class="input-text" type="text" value="<?php echo ($v["link"]); ?>" onblur="saveVal(this,<?php echo ($v['id']); ?>,'link')"></td>
				<td><?php echo (getNameById("moudle",$v["pid"])); ?></td>
				<td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('模块编辑','<?php echo U('admin_moudle_add',array('id'=>$v['id']));?>','<?php echo ($v['id']); ?>','950','')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo ($v["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
</div>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-权限-添加*/
function admin_permission_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-权限-编辑*/
function admin_permission_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*-删除
 * 单个
 * */
//单个
function admin_del(obj,id){

    layer.confirm('确认要删除吗？',function(index){
        $.post("<?php echo U('System/categoryDel');?>",{"id":id,"tableName":"moudle"},function (res) {

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
function datadel() {

    var getId=$("input[name='idDel']:checked");
    var strId="";

    for (var i=0;i<getId.length;i++){
        strId+=getId.eq(i).val()+",";
    }
    if (strId=='') {
        alert("请先选择");
        return false;
    };
	console.log(strId);
    layer.confirm('确认要删除吗？',function(index){
        $.post("<?php echo U('System/categoryDel');?>",{"id":strId,"tableName":"moudle"},function (res) {

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
    $.post("<?php echo U('Base/status');?>",{"tableName":'moudle',"fieldName":field_name,"primary":'id','id':id,"fieldVal":field_new},function(res){
        if (res.status=="y") {
            layer.msg('已修改!',{icon:1,time:1000});
        };
    })
}
//改变状态
function status(obj,id,field_name,field_val){
    var field_new=0;
    var imgSrc="/Q2/tp1611/Public/Admin/images/icon_error_s.png";
    if(field_val==0){
        field_new=1;
        imgSrc="/Q2/tp1611/Public/Admin/images/icon_right_s.png";
    }
    var status="status(this,"+id+",'"+field_name+"',"+field_new+")";
    $.post("<?php echo U('Base/status');?>",{"tableName":'moudle',"fieldName":field_name,"primary":'id','id':id,"fieldVal":field_new},function(res){
        if(res.status=='y'){
            $(obj).attr('src',imgSrc);
            $(obj).attr('onclick',status);
        }else {
            layer.msg('修改失败!请稍后再试',{icon:1,time:1000});
        }
    })
}
</script>
</body>
</html>