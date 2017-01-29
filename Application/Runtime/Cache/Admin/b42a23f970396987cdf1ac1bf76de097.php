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
<title>新增图片</title>
</head>
<body>
<div class="pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-product-add">
		<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"  />
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>产品标题：</label>
			<div class="formControls col-7">
				<input type="text" class="input-text" value="<?php echo ($info['name']); ?>" placeholder="请输入产品名称" name="name" >
			</div>
			<div class="col-3"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-2">产品编号：</label>
			<div class="formControls col-7">
				<input type="text" class="input-text" value="<?php echo ($info['goods_sn']); ?>" placeholder="不填写将自动生成" name="goods_sn" <?php if($info['id'] > 0): ?>disabled<?php endif; ?> >
			</div>
			<div class="col-3"> </div>
		</div>

		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>产品系列：</label>
			<div class="formControls col-2"> <span class="select-box">
				<select name="series_id" class="select">
					<option value="">一级分类</option>
				<?php if(is_array($serlist)): $i = 0; $__LIST__ = $serlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v['id']); ?>" <?php if($v['id'] == $info['series_id']): ?>selected<?php endif; ?> ><?php echo (str_repeat("├",$v['level'])); echo (getNameById("category",$v["cat_id"])); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				</span> </div>
			<label class="form-label col-2">是否上架：</label>
			<div class="formControls col-2 skin-minimal">
				<div class="check-box">
					<input type="checkbox" id="checkbox-1" name="is_sale" value="1" <?php if($info["is_sale"] == 1): ?>checked<?php endif; ?> >
					<label for="checkbox-1">&nbsp;</label>
				</div>
			</div>
			<div class="col-3"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>产品容量：</label>
			<div class="formControls col-10">
				<input type="text" name="capacity" placeholder="输入毫升" value="<?php echo ($info["capacity"]); ?>" class="input-text" style="width:25%">
				ml
				</div>
			<div class="col-3"> </div>
		</div>

		<div class="row cl">

			<label class="form-label col-2"><span class="c-red">*</span>商品库存量：</label>
			<div class="formControls col-4">
				<input type="text" name="goods_number" placeholder="商品库存量必须是数字" value="<?php echo ($info["goods_number"]); ?>" class="input-text" style="width:90%">
				</div>
			<div class="col-3"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>产品展示价格：</label>
			<div class="formControls col-4">
				<input type="text" name="official_price" placeholder="产品价格必须是数字" value="<?php echo ($info['official_price']); ?>" class="input-text" style="width:90%">
				元</div>
			<div class="col-3"> </div>

		</div>
		<div class="row cl">
			<label class="form-label col-2">促销价格：</label>
			<div class="formControls col-4">
					<input type="text" id="checkbox-2" name="promo_price" value="<?php echo ($info["promo_price"]); ?>" class="input-text">
					<label for="checkbox-1">&nbsp;</label>
			</div>
			<div class="col-3"> </div>
		</div>
		<div class="row cl">

			<label class="form-label col-2">销售开始时间：</label>
			<div class="formControls col-3">
				<input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{ $dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:180px;" name="promo_on" value="<?php echo (date('Y-m-d H:i:s',$info['promo_on']> 0?$info['promo_on']:'')); ?>">
			</div>
			<label class="form-label col-2">销售结束时间：</label>
			<div class="formControls col-3">
				<input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{ $dp.$D(\'datemin\')}'})" id="datemax" class="input-text Wdate" style="width:180px;" name="promo_off"  value="<?php echo (date('Y-m-d H:i:s',$info['promo_off']> 0?$info['promo_off']:'')); ?>">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>产品功效：</label>
			<div class="formControls col-7">
				<input type="text" name="virtue" placeholder="多个关键字用英文逗号隔开，限10个关键字" value="<?php echo ($info['virtue']); ?>" class="input-text">
			</div>
			<div class="col-3"> </div>
		</div>

		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>产品展示图：</label>
			<div class="formControls col-7">
				<img id="thumb_url" src='/Q2/tp1611<?php if($info['img']): echo ($info["img"]); else: ?>/Public/404.png<?php endif; ?>' style="height:100px;width:150">
				<input type="hidden"  id="picurl" name="img" value="<?php echo ($info["img"]); ?>"  />
				<input type="hidden" name="oldimg" value="<?php echo ($info["img"]); ?>"/>
				<button class="btn btn-success" id="image"  type="button" >选择图片</button>
			</div>
			<div class="col-3"> </div>
		</div>

		<div class="row cl">
			<label class="form-label col-2">详细内容：</label>
			<div class="formControls col-10">
				<script id="editor" type="text/plain" style="width:100%;height:400px;"><?php echo (htmlspecialchars_decode($info['description'])); ?></script>
			</div>
		</div>
		<div class="row cl">
			<div class="col-10 col-offset-2">
				<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
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
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});



	var ue = UE.getEditor('editor',{textarea:"description"});
	// ajax验证
	$("#form-product-add").Validform({
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
            uploadJson : "<?php echo U('Base/uploadImg',array('path'=>'product','w'=>150,'h'=>80));?>", //上传功能
            fileManagerJson : '/Q2/tp1611/Public/Admin/kindeditor/php/file_manager_json.php?dirpath=product', //网络空间
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