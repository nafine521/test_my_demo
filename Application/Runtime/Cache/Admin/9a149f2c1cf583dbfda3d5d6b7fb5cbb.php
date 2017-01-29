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
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>新增文章</title>
</head>
<body>
<div class="pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-news-add">
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>新闻标题：</label>
			<div class="formControls col-7">
				<input type="text" class="input-text" value="<?php echo ($info['title']); ?>" placeholder="请输入新闻标题" name="title" datatype="*" nullmsg="请输入新闻标题">
			</div>
			<div class="col-3"> </div>
		</div>

		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>所属系列：</label>
			<div class="formControls col-2"> <span class="select-box">
				<select name="series_id" class="select" datatype="*" nullmsg="请选择新闻标题">
					<option value="">全部类型</option>
					<?php if(is_array($serlist)): $i = 0; $__LIST__ = $serlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $info['series_id']): ?>selected<?php endif; ?> ><?php echo (getNameById("category",$v["cat_id"])); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				</span> </div>
			<div class="col-2"> </div>
			<label class="form-label col-1">推荐：</label>
			<div class="formControls col-2 skin-minimal">
				<div class="check-box">
					<input type="checkbox" id="checkbox-1" name="refer" value="1" <?php if($info["refer"] == 1): ?>checked<?php endif; ?> >
					<label for="checkbox-1">&nbsp;</label>
				</div>
			</div>
			<div class="col-2"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-2">关键词：</label>
			<div class="formControls col-7">
				<input type="text" class="input-text" value="<?php echo ($info["keyword"]); ?>" placeholder="关键词触发搜索关键字 请用,（英文半角）隔开" name="keyword">
			</div>
			<div class="col-3"> </div>
		</div>



		<div class="row cl">
			<label class="form-label col-2">新闻内容：</label>
			<div class="formControls col-7">
				<script id="editor" type="text/plain" style="width:100%;height:400px;"><?php echo (htmlspecialchars_decode($info["content"])); ?></script> 
			</div>
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
			<div class="col-3"> </div>

		</div>
		<div class="row cl">
			<div class="col-10 col-offset-2">
				<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
			</div>
		</div>
	</form>
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
    //提交数据
    $("#form-news-add").Validform({
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
    //检查数据填写状况
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	var ue = UE.getEditor('editor',{textarea:"content"});
	
});
</script>
</body>
</html>