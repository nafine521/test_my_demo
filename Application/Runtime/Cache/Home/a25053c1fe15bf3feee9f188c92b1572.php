<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>联系我们</title>
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/contact.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/H-ui.css" />
	<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
	<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/page_contact.js"></script>
</head>
<body>
	<?php if($index_banner): ?><style>
		#header.type3{background:url('/1611/1232/tp1611<?php echo ($index_banner['img']); ?>') no-repeat 0px 100px;background-size: 100%;height:1000px;}
</style>
<?php else: ?>
<style>
		#header.type3{background:url('/1611/1232/tp1611<?php echo ($banner['img']); ?>') no-repeat 0px 100px;background-size: 100%;height:350px;}			
</style><?php endif; ?>	
<!-- __头部#header -->
	<div id="header" class="type2 type3">
		<p class="link ff_simsun fs_12">
			<a href="javascript:;" onclick="login('会员登录','<?php echo U('Index/login');?>',1150,'')" id="login">会员登录</a>
			|
			<a href="javascript:;" onclick="register('免费注册','<?php echo U('Index/register');?>',1150,'')" >免费注册</a>
			<span class="userInfo" >|</span>
			<a href="<?php echo U('Member/member');?>" class="userInfo">会员中心</a>
			<span class="userInfo">|</span>
			<a href="<?php echo U('Member/cart');?>" class="userInfo">我的购物车（<span>0</span>）</a>
			<a href="javascript:logout();" class="userInfo">退出登陆</a>
			
		</p>
		<a href="index.html" class="logo">
			<img src="/1611/1232/tp1611/Public/Home/images/logo.png" />
		</a>
		<form action="#" method="post" class="search">
			<input type="text" name="keyword" class="input_box ff_simsun fs_12" placeholder="搜索.." />
			<input type="image" src="/1611/1232/tp1611/Public/Home/images/icons/search.gif" value="搜索" />
		</form>
		<p class="nav ff_fz fs_18">
			<a href="<?php echo U('Index/index');?>" class="index" <?php if(($action) == "Index"): ?>style="color:#692687;"<?php endif; ?> >首页</a>
			<?php if(is_array($navList)): foreach($navList as $key=>$v): ?><a href="<?php echo U($v['link']);?>" class="<?php echo (trim(strstr($v['link'],'/'),'/')); ?>" <?php if(($v['is_open_new']) == "1"): ?>target="_blank"<?php endif; ?> <?php if($action==strchr($v['link'],'/',true))echo "style='color:#692687;'"; ?> ><?php echo ($v['name']); ?></a><?php endforeach; endif; ?>

		</p>
		<!-- 清除浮动样式 -->
		<div class="clear"></div>
	</div>

	<!-- //头部#header -->
	<!-- __主体#content -->
	<div id="content" class="type1">
		<div class="main">
			<ul class="sidebar type1 ff_fz fs_18">
    <?php if(is_array($subnavList)): $i = 0; $__LIST__ = $subnavList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($v["link"]); ?>" <?php if($action==strchr($v['link'],'/',true))echo "style='color:#692687;'"; ?> ><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php if($promo_pro): ?><li class="buy" style="background:url('/1611/1232/tp1611<?php echo ($promo_pro["img"]); ?>') no-repeat 100%;"><a href="<?php echo U('Product/product',array('id'=>$promo_pro['id']));?>" title="热卖产品"></a></li><?php endif; ?>
</ul>
			<form action="" method="post" class="main_text ff_yh fs_14" id="form-content">
				<p class="current_location ff_fz">
					当前位置：
					<a href="<?php echo U('Index/index');?>">首页</a>
					&gt;&gt;
					<a href="javascript:;" class="current">联系我们</a>
				</p>
				<span class="tag">姓　　名：</span>
				<input type="text" class="input text" name="name"   datatype="*" nullmsg="姓名不能为空"/>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">联系电话：</span>
				<input type="tel" class="input text" name="tel"   datatype="*" nullmsg="电话不能为空"/>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">电子邮箱：</span>
				<input type="email" class="input text" name="email"   datatype="*" nullmsg="邮箱不能为空"/>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag" >留言内容：</span>
				<textarea class="input textarea" name="contents"   datatype="*" nullmsg="内容不能为空"></textarea>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag" >&nbsp;</span>
				<input type="text" class="input verify" placeholder="请输入验证码" name="verify"  datatype="*" nullmsg="账户名不能为空"/>
				<img src="<?php echo U('Index/verify');?>" class="box"  id="verifySrc" onclick="verify()" />
				<input type="submit" value="提交" class="submit block_button ff_fz fs_12" style="float:right"/>
				<div class="clear"></div>
				<p class="description">
					<?php echo ($basic["name"]); ?><br />
					联系地址：<?php echo ($contact["add"]); ?><br />
					邮政编码：<?php echo ($contact["postal"]); ?><br />
					全国免费热线:<?php echo ($contact["hotline"]); ?><br />
					电话：<?php echo ($contact["tel"]); ?><br />
					传真：<?php echo ($contact["fax"]); ?><br />
					邮箱：<?php echo ($contact["email"]); ?><br />
					官网：<?php echo ($contact["url"]); ?>
				</p>
				<div id="map"></div>
			</form>
			<!-- 清除浮动样式 -->
			<div class="clear"></div>
		</div>
	</div>
	<!-- //主体#content -->
	<!-- __底部#footer -->
	<footer id="footer" class="type2 ff_simsun fs_14">&copy;<?php echo ($basic["icp"]); ?><br /><?php echo ($contact["add"]); ?></footer>
	<!-- //底部#footer -->
	<!-- <script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script> -->
<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/mod_slideshow.js"></script>
	
<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/js/H-ui.js"></script>
<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/js/H-ui.admin.js"></script>
<script type="text/javascript" >
// layer打开小窗口
		function login(title,url,w,h){
			layer.msg('玩命加载中');
    			layer_show(title,url,w,h);
		}
		function register(title,url,w,h){
			layer.msg('玩命加载中');
    			layer_show(title,url,w,h);
		}
		

// 判断是否登陆
	$(function  () {
		var nikename = "<?php echo ($_SESSION['tp1611_user']['username']); ?>";
			if (nikename!="") {
				var memberInfo= $("<span></span>");
				memberInfo.append(nikename);
				$("#login").replaceWith(memberInfo);
			}else if (nikename=="") {
				$(".userInfo").css("display","none");
			};
		});
	function logout () {
		layer.confirm("确定退出吗",function (index) {
			location.href="<?php echo U('Index/logout');?>";
		})
	}
</script>
	<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/lib/Validform/5.3.2/Validform.min.js"></script>
	<script type="text/javascript" >
		// 切换验证码图片
	function verify () {
		$("#verifySrc").attr("src",$("#verifySrc").attr("src")+"?"+Math.random());
	}
	// 留言ajax
	  $("#form-content").Validform({
	      tiptype:2,
	      ajaxPost:true,
	      callback:function(form){
	            if(form.status=='y'){
	                setTimeout(function () {
	                    $.Hidemsg();
	                    location.reload();//刷新窗口
	                },1000);
	            }
	        }
	  });
	</script>
</body>
</html>