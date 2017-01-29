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
<link href="/Q2/tp1611/Public/Admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/skin/default/skin.css" rel="stylesheet" type="text/css" id="skin" />
<!--[if IE 6]>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>基本设置</title>
</head>
<div>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 基本设置 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-basic-save">
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl"><span>基本设置</span><span>联系我们</span><span>送货地址</span></div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-2"><span class="c-red">*</span>网站名称：</label>
					<div class="formControls col-6">
						<input type="text" id="website-title" placeholder="控制在25个字、50个字节以内" value="<?php echo ($basic["name"]); ?>" class="input-text" name="basic[name]" datatype="*" nullmsg="请填写网站名称">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-2"><span class="c-red">*</span>网站logo：</label>
					<div class="formControls col-6">
					    <img id="thumb_url" src='/Q2/tp1611<?php if($basic['logo']): echo ($basic["logo"]); else: ?>/Public/404.png<?php endif; ?>' style="height:100px;width:150">
					  	<input type="hidden"  id="picurl" name="basic[logo]" value="<?php echo ($basic["logo"]); ?>" datatype="*" nullmsg="请选择缩略图"/>
					  	<input type="hidden"  name="basic[oldimg]" value="<?php echo ($basic["logo"]); ?>" />
					  	<button class="btn btn-success" id="image"  type="button" >选择图片</button>
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-2"><span class="c-red">*</span>底部版权信息：</label>
					<div class="formControls col-6">
						<input type="text" id="website-copyright" placeholder="&copy;　20010-20011　版权所有" value="<?php echo ($basic['icp']); ?>" class="input-text" name="basic[icp]" datatype="*" nullmsg="请输入版权信息">
					</div>
					<div class="col-3"> </div>
				</div>
			</div>

			<div class="tabCon">

				<div class="row cl">
					<label class="form-label col-2">联系电话：</label>
					<div class="formControls col-6">
						<input type="text" id="" value="<?php echo ($contact['tel']); ?>" class="input-text" name="contact[tel]"   datatype="*" nullmsg="请输入联系电话">
					</div><div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-2">联系地址：</label>
					<div class="formControls col-6">
						<input type="text" id="" value="<?php echo ($contact['add']); ?>" class="input-text" name="contact[add]"  datatype="*" nullmsg="请输入联系地址">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-2">邮政编码：</label>
					<div class="formControls col-6">
						<input type="text" id="" value="<?php echo ($contact['postal']); ?>" class="input-text" name="contact[postal]"  datatype="*" nullmsg="请输入邮政编码">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-2">热线电话：</label>
					<div class="formControls col-6">
						<input type="text" id="" value="<?php echo ($contact['hotline']); ?>" class="input-text" name="contact[hotline]"  datatype="*" nullmsg="请输入热线电话">
					</div>
					<div class="col-3"> </div>

				</div>
				<div class="row cl">
					<label class="form-label col-2">传真地址：</label>
					<div class="formControls col-6">
						<input type="text" id="" value="<?php echo ($contact['fax']); ?>" class="input-text" name="contact[fax]"  datatype="*" nullmsg="请输入传真地址">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-2">联系邮箱：</label>
					<div class="formControls col-6">
						<input type="text" id="" value="<?php echo ($contact['email']); ?>" class="input-text" name="contact[email]"  datatype="*" nullmsg="请输入联系邮箱">
					</div>
					<div class="col-3"> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-2">网站地址：</label>
					<div class="formControls col-6">
						<input type="text" id="" value="<?php echo ($contact['url']); ?>" class="input-text" name="contact[url]"  datatype="*" nullmsg="请输入网站地址">
					</div>
					<div class="col-3"> </div>
				</div>

			</div>
			<div class="tabCon">

				<div class="row cl">
					<label class="form-label col-2">快递范围：</label>
					<div class="formControls col-6">
						<input type="text" value="<?php echo ($delivery["area"]); ?>" class="input-text" name="delivery[area]"   datatype="*" nullmsg="请输入区域">
					</div>
					<div class="col-3"> </div>
				</div>
					<div class="row cl">
						<label class="form-label col-2">送货价格：</label>
						<div class="formControls col-4">
							<input type="text" value="<?php echo ($delivery["fee"]); ?>" class="input-text" name="delivery[fee]"   datatype="*" nullmsg="请填写送货价格">
						</div>
						<div class="col-3"> </div>
					</div>
					<div class="row cl">
							<label class="form-label col-2">运费险：</label>
							<div class="formControls col-4">
							<input type="text" value="<?php echo ($delivery["insurance"]); ?>" class="input-text" name="delivery[insurance]"   datatype="*" nullmsg="请填写运费险,可以写0">
							</div>
							<div class="col-3"> </div>

					</div>
					<div class="row cl">
						<label class="form-label col-2">运费险赔付compensate：</label>
						<div class="formControls col-4">
						<input type="text" value="<?php echo ($delivery["compensate"]); ?>" class="input-text" name="delivery[compensate]"   datatype="*" nullmsg="请填写运费赔付,可以写0">
						</div>
						<div class="col-2"> </div>
					</div>
				</div>
			</div>




		<div class="row cl">
			<div class="col-10 col-offset-2">
				<button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
			</div>
		</div>

	</form>
</div>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");


});
$("#form-basic-save").Validform({
		tiptype:2,
		ajaxPost:true,
		callback:function(data){
			if(data.status=="y"){
				setTimeout(function(){
					$.Hidemsg();
					self.location.reload();//重新页面
				},1000);
			}
		}
	});
</script>

<!-- 新增编辑器引入文件 -->
<link rel="stylesheet" href="/Q2/tp1611/Public/Admin/kindeditor/themes/default/default.css" />
<script src="/Q2/tp1611/Public/Admin/kindeditor/kindeditor-min.js"></script>
<script src="/Q2/tp1611/Public/Admin/kindeditor/lang/zh_CN.js"></script>
<script>
KindEditor.ready(function(K) {
	var editor = K.editor({
	    allowFileManager : true,
	    uploadJson : "<?php echo U('Base/uploadImg',array('path'=>'basic','w'=>150,'h'=>80));?>", //上传功能
	    fileManagerJson : '/Q2/tp1611/Public/Admin/kindeditor/php/file_manager_json.php?dirpath=basic', //网络空间
	  });
	//上传背景图片
	K('#image').click(function() {
	  editor.loadPlugin('image', function() {
	    editor.plugin.imageDialog({
	    	//showRemote : false, //网络图片不开启
	    	//showLocal : false, //不开启本地图片上传
	     	imageUrl : K('#picurl').val(),
	        clickFn : function(url, title, width, height, border, align) {
	        K('#picurl').val(url);
	        $('#thumb_url').attr("src","/Q2/tp1611"+url);
	        editor.hideDialog();
	      }
	    });
	  });
	});
});
</script>
</body>
</html>