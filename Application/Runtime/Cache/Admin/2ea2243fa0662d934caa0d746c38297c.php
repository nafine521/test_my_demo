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
<link href="/Q2/tp1611/Public/Admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>栏目设置</title>
</head>
<body>
<div class="pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-category-add">
		<div id="tab-category" class="HuiTab">
			<div class="tabBar cl"><span>基本设置</span></div>
			<div class="tabCon" >
				
				<div class="row cl">
					<label class="form-label col-3"><span class="c-red">*</span>上级栏目：</label>
					<div class="formControls col-6"> <span class="select-box">
						<select class="select" id="sel_Sub" name="pid" datatype="*" nullmsg="请选择栏目">
							<option value="">请选择栏目</option>
							<option value="0" <?php if($info['pid'] == '0'): ?>selected<?php endif; ?>  >顶级分类</option>
							<?php if(is_array($list)): foreach($list as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($info['pid'] == $v['id']): ?>selected<?php endif; ?> ><?php echo (str_repeat("&nbsp;&nbsp;├ ",$v["level"])); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
						</select>
						</span> </div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3"><span class="c-red">*</span>栏目名称：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="<?php echo ($info["name"]); ?>" name="name" datatype="*" nullmsg="栏目名不能为空">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-3"><span class="c-red">*</span>排序：</label>
					<div class="formControls col-6">
						<input type="text" class="input-text" value="<?php echo ($info["sort"]); ?>" name="sort" datatype="n" nullmsg="请输入数字">
					</div>
					<div class="col-3"> </div>
				</div>
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</div>
</div>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-category-add").Validform({
		tiptype:2,
		ajaxPost:true,
		callback:function(form){
			
			if(form.status=='y'){
                setTimeout(function () {
                    $.Hidemsg();
                    var index = parent.layer.getFrameIndex(window.name);//获取当前页面的索引
                    parent.location.reload();//刷新父窗口
                    parent.layer.close(index);//关闭当前窗口
                },1000)
			}
		}
	});
	$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
});
</script>
</body>
</html>