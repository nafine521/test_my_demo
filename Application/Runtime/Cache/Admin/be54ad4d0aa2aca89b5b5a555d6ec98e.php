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
<link href="/Q2/tp1611/Public/Admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>品牌介绍</title>
</head>
<body>
<div class="pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-brand-add">
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>标题：</label>
			<div class="formControls col-6">
				<input type="text" class="input-text" name="brand[title]" value="<?php echo ($info["title"]); ?>">
			</div>
		</div>		
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>品牌缩略图：</label>
			<div class="formControls col-6"> 
			        <img id="thumb_url" src='/Q2/tp1611<?php if($info['img']): echo ($info["img"]); else: ?>/Public/404.png<?php endif; ?>' style="height:100px;width:150">
			  	<input type="hidden"  id="picurl" name="brand[img]" value="<?php echo ($info["img"]); ?>" datatype="*" nullmsg="请选择缩略图"/>

			  	<button class="btn btn-success" id="image"  type="button" >选择图片</button>
			</div>
			<div class="col-3"> </div>
		</div>
		<div class="row cl">
			
			<label class="form-label col-2">描述：</label>
			<div class="formControls col-6"> 
				<script id="editor1" type="text/plain" style="width:100%;height:400px;"><?php echo ($info["description"]); ?></script>
			</div>
		</div>
		<div class="row cl">
			<input type="hidden"  name="brand[oldimg]" value="<?php echo ($info["img"]); ?>" />
			<label class="form-label col-2">详细内容：</label>
			<div class="formControls col-6"> 
				<script id="editor" type="text/plain" style="width:100%;height:400px;"><?php echo ($info["content"]); ?></script>
			</div>
		</div>
		<div class="row cl">
			<div class="col-10 col-offset-2">
				<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存 </button>

				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>
</div>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$(function(){
	var ue1 = UE.getEditor('editor1',{textarea:"brand[description]"});
	var ue = UE.getEditor('editor',{textarea:"brand[content]"});
});

$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-brand-add").Validform({
		tiptype:2,
		ajaxPost:true,
		callback:function(data){
			if(data.status=="y"){
				setTimeout(function(){
					$.Hidemsg();
					location.reload();//重新页面
				},1000);
			}
		}
	});
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
	    uploadJson : "<?php echo U('Base/uploadImg',array('path'=>'brand','w'=>150,'h'=>80));?>", //上传功能
	    fileManagerJson : '/Q2/tp1611/Public/Admin/kindeditor/php/file_manager_json.php?dirpath=brand', //网络空间
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
	
	var ed = K.create('textarea[name="brand[description]"]', {
        resizeType : 1,
        uploadJson : "<?php echo U('Base/uploadImg',array('path'=>'brand'));?>",
        allowPreviewEmoticons : false,
        allowImageUpload : true,
        items : [
            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
            'insertunorderedlist', '|', 'emoticons', 'image', 'multiimage','link'],
       afterBlur: function () { this.sync(); }
    });

	
});
</script> 
</body>
</html>