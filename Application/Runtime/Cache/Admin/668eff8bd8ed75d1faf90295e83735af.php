<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/1611/1232/tp1611/Public/Admin/lib/html5.js"></script>
<script type="text/javascript" src="/1611/1232/tp1611/Public/Admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/1611/1232/tp1611/Public/Admin/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/1611/1232/tp1611/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/1611/1232/tp1611/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/1611/1232/tp1611/Public/Admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/1611/1232/tp1611/Public/Admin/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加导航</title>
</head>
<body>
<div class="pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-nav-add">
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>导航名称：</label>
			<div class="formControls col-5">
				<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
				<input type="text" class="input-text" name="name" value="<?php echo ($info["name"]); ?>" datatype="*" nullmsg="名称不能为空">
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>导航链接：</label>
			<div class="formControls col-5">
				<input type="text" placeholder="Index/index or https://www.baidu.com/" class="input-text" datatype="*" nullmsg="链接不能为空" name="link" value="<?php echo ($info["link"]); ?>">
			</div>
			<div class="col-4"> </div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>是否显示：</label>
			<div class="formControls col-5 skin-minimal">
				<div class="radio-box">
					<input type="radio" id="sex-1" name="is_show" datatype="*" nullmsg="请选择！" value="1" <?php if($info["is_show"] == 1): ?>checked<?php endif; ?> >
					<label for="sex-1">是</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="is_show" value="0" <?php if($info["is_show"] == '0'): ?>checked<?php endif; ?> >
					<label for="sex-2">否</label>
				</div>
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>是否打开新窗口：</label>
			<div class="formControls col-5 skin-minimal">
				<div class="radio-box">
					<input type="radio" id="sex-3" name="is_open_new" datatype="*" nullmsg="请选择！" value="1" <?php if($info["is_open_new"] == 1): ?>checked<?php endif; ?> >
					<label for="sex-3">是</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-4" name="is_open_new" value="0" <?php if($info["is_open_new"] == '0'): ?>checked<?php endif; ?> >
					<label for="sex-4">否</label>
				</div>
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>排序：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" placeholder="" id="user-tel" name="sort"  datatype="n" nullmsg="排序不能为空" value="<?php echo ($info["sort"]); ?>">
			</div>
			<div class="col-4"> </div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-3">位置：</label>
			<div class="formControls col-5"> <span class="select-box" >
				<select class="select" name="local" size="1">
					<option value="" >请选择位置</option>
					<option value="0" <?php if($info["local"] == '0'): ?>selected<?php endif; ?> >顶部</option>
					<option value="1" <?php if($info["local"] == 1): ?>selected<?php endif; ?> >子导航</option>
					<option value="2" <?php if($info["local"] == 2): ?>selected<?php endif; ?> >会员导航</option>
				</select>
				</span> </div>
		</div>
		
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</div>
<script type="text/javascript" src="/1611/1232/tp1611/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/1611/1232/tp1611/Public/Admin/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/1611/1232/tp1611/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="/1611/1232/tp1611/Public/Admin/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/1611/1232/tp1611/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/1611/1232/tp1611/Public/Admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-nav-add").Validform({
		tiptype:2,
		ajaxPost:true,
		callback:function(form){
			if (form.status=="y") {
				setTimeout(function(){
					$.Hidemsg();
                    var index = parent.layer.getFrameIndex(window.name);//获取当前页面的索引
                    parent.location.reload();//刷新父窗口
                    parent.layer.close(index);//关闭当前窗口
				},1000)
            }
        }
	});
});
</script>
</body>
</html>