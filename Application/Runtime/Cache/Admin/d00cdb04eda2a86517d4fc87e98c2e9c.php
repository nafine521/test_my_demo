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
<link href="/Q2/tp1611/Public/Admin/lib/lightbox2/2.8.1/css/lightbox.css" rel="stylesheet" type="text/css" >
<title>图片展示</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品图片管理 <span class="c-gray en">&gt;</span> 图片展示 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="picture_add('添加图片','<?php echo U('proPhotoAdd',array("pro_id"=>$pro_id));?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加图片</a></span> <span class="r">共有数据：<strong><?php echo (count($list)); ?></strong> 条</span> </div>
	<div class="portfolio-content">
		<ul class="cl portfolio-area">
			<?php if(is_array($list)): foreach($list as $k=>$v): ?><li class="item">
				<div class="portfoliobox">
					<input class="checkbox" name="del" type="checkbox" value="<?php echo ($k); ?>">
					<div class="picbox"><a href="/Q2/tp1611<?php echo ($v); ?>" data-lightbox="gallery" data-title="客厅1"><img src="/Q2/tp1611<?php echo ($v); ?>"></a></div>
					<div class="textbox"> <a href="javascript:;" onclick="edit('修改图片','<?php echo U('Picture/proPhotoAdd',array('id'=>$k));?>',1100,'')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe6df;</i>修改</a> </div>
				</div>
			</li><?php endforeach; endif; ?>
		</ul>
	</div>
</div>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/lightbox2/2.8.1/js/lightbox-plus-jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
$(function(){
	$.Huihover(".portfolio-area li");

});


//选中删除
function datadel() {
	var choosed=$("input[name='del']:checked");
	var strId="";
	$(choosed).each(function (obj) {
		strId+=$(this).val()+",";
    })
	if(strId==""){
	    layer.msg("未选择数据",{icon:2,time:1000});
	    return false;
	}
    layer.confirm("确定要删除吗？",function (index) {
        $.post("<?php echo U('Base/comDel');?>",{"tableName":"pro_photo","id":strId},function (res) {
            if(res.status=="y"){
				$(choosed).each(function () {
					$(this).parents("li").remove();
                })
                layer.msg("已删除",{icon:3,time:1000});
            }
        })
    })

}

function edit(title,url,w,h) {
	layer_show(title,url,w,h);
}


/*
* 失效原因在于点开图片是个框架弹出层了。。。
$(document).ready(function () {
    var num=$(".textbox").html();//用text()或html()
    console.log(num);
    var char=$("<span class='lb-caption'></span>");
    char.append(num);
    char.replaceWith($(".lb-caption"));
})*/

/*图片-添加*/
function picture_add(title,url){
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