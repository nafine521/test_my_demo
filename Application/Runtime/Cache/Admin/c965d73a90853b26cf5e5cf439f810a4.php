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
<title>系列设置</title>
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
						<select class="select" id="sel_Sub" name="cat_id" datatype="*" nullmsg="请选择栏目">
							<option value="">请选择栏目</option>						
							<?php if(is_array($catlist)): foreach($catlist as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($info['cat_id'] == $v['id']): ?>selected<?php endif; ?> ><?php echo (str_repeat("&nbsp;&nbsp;├ ",$v["level"])); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
						</select>
						</span> </div>
					<div class="col-3"> </div>
				</div>
				
				<div class="row cl">
					<label class="form-label col-3"><span class="c-red">*</span>系列产品图：</label>
					<div class="formControls col-6">
						<img id="thumb_url" src='/Q2/tp1611<?php if($info['img']): echo ($info["img"]); else: ?>/Public/404.png<?php endif; ?>' style="height:100px;width:150">
						<input type="hidden"  id="picurl" name="img" value="<?php echo ($info["img"]); ?>" datatype="*" nullmsg="请选择缩略图"/>
						<button class="btn btn-success" id="image"  type="button" >选择图片</button>
					</div>
					<div class="col-3"> </div>
				</div>

				<div class="row cl">
					<label class="form-label col-3"><span class="c-red">*</span>系列logo图：</label>
					<div class="formControls col-6">
						<img id="thumb_url1" src='/Q2/tp1611<?php if($info['logo']): echo ($info["logo"]); else: ?>/Public/404.png<?php endif; ?>' style="height:100px;width:150">
						<input type="hidden"  id="picurl1" name="logo" value="<?php echo ($info["logo"]); ?>" datatype="*" nullmsg="请选择缩略图"/>
						<button class="btn btn-success" id="image1"  type="button" >选择图片</button>
					</div>
					<div class="col-3"> </div>
				</div>

				<div class="row cl">
					<label class="form-label col-3">文章内容：</label>
					<div class="formControls col-8">
						<script id="editor" type="text/plain" style="width:100%;height:400px;"><?php echo (htmlspecialchars_decode($info['description'])); ?></script>
					</div>
				</div>
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
				<input type="hidden" name="oldlogo" value="<?php echo ($info["logo"]); ?>">
				<input type="hidden" name="oldimg" value="<?php echo ($info["img"]); ?>">
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
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$(function(){
    var ue = UE.getEditor('editor',{textarea:""});

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
<!-- 新增编辑器引入文件 -->
<link rel="stylesheet" href="/Q2/tp1611/Public/Admin/kindeditor/themes/default/default.css" />
<script src="/Q2/tp1611/Public/Admin/kindeditor/kindeditor-min.js"></script>
<script src="/Q2/tp1611/Public/Admin/kindeditor/lang/zh_CN.js"></script>
<script>
 	var ue = UE.getEditor('editor',{textarea:"description"});
    KindEditor.ready(function(K) {
        var editor = K.editor({
            allowFileManager : true,
            uploadJson : "<?php echo U('Base/uploadImg',array('path'=>'series','w'=>150,'h'=>80));?>", //上传功能
            fileManagerJson : '/Q2/tp1611/Public/Admin/kindeditor/php/file_manager_json.php?dirpath=series', //网络空间
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
        K('#image1').click(function() {
            editor.loadPlugin('image', function() {
                editor.plugin.imageDialog({
                    //showRemote : false, //网络图片不开启
                    //showLocal : false, //不开启本地图片上传
                    imageUrl : K('#picurl1').val(),
                    clickFn : function(url, title, width, height, border, align) {
                        K('#picurl1').val(url);
                        $('#thumb_url1').attr("src","/Q2/tp1611"+url);
                        editor.hideDialog();
                    }
                });
            });
        });

        var ed = K.create("textarea[name='description']", {
            resizeType : 1,
            uploadJson : "<?php echo U('Base/uploadImg',array('path'=>'product'));?>",
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