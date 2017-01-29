<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>修改密码</title>
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/change_password.css" />
	<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
	<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/mod_sidebar_toggle.js"></script>
</head>
<body>
	<!-- __头部#header -->
	<div id="header" class="type2 type3">
		<p class="link ff_simsun fs_12">
			<a href="javascript:;" onclick="login('会员登录','<?php echo U('login');?>',900,'')" id="login">会员登录</a>
			|
			<a href="javascript:;" onclick="register('免费注册','<?php echo U('register');?>',900,'')">免费注册</a>
			<span class="userInfo">|</span>
			<a href="html/member.html" class="userInfo">会员中心</a>
			<span class="userInfo">|</span>
			<a href="html/cart.html" class="userInfo">我的购物车（<span>0</span>）</a>
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
			<a href="index.html" class="index">首页</a>
			<a href="html/introduction.html" class="introduction">品牌介绍</a>
			<a href="html/product.html" class="product">产品中心</a>
			<a href="html/news.html" class="news">新闻中心</a>
			<a href="html/contact.html" class="contact">联系我们</a>
		</p>
		<!-- 清除浮动样式 -->
		<div class="clear"></div>
	</div>
	<!-- //头部#header -->
	<!-- __主体#content -->
	<div id="content" class="type1">
		<div class="main">
			<ul class="sidebar type2 ff_yh fs_14">
				<li class="banner ff_fz">
					<p class="cn">会员中心</p>
					<p class="en fs_14">Member Center</p>
				</li>
				<li class="entry">
					<p class="header cart">
						<a href="cart.html">我的购物车</a>
					</p>
				</li>
				<li class="entry">
					<p class="header account">帐户管理</p>
					<ul class="sub_entry">
						<li><a href="member_info.html">个人信息</a></li>
						<li><a href="change_password.html" class="current">修改密码</a></li>
					</ul>
				</li>
				<li class="entry">
					<p class="header order">订单管理</p>
					<ul class="sub_entry">
						<li><a href="confirm_order.html">我的订单</a></li>
						<li><a href="confirm_address.html">收货地址</a></li>
					</ul>
				</li>
				<li class="entry">
					<p class="header trade">
						<a href="purchase_record.html">交易管理</a>
					</p>
				</li>
				<li class="entry">
					<p class="header point">
						<a href="#">积分兑换</a>
					</p>
				</li>
				<li class="buy">
					<a href="product.html"></a>
				</li>
			</ul>
			<form action="" method="post" class="main_text ff_yh fs_14">
				<p class="current_location ff_fz">
					当前位置：
					<a href="memeber.html">会员中心</a>
					&gt;&gt;
					<a href="change_password.html" class="current">修改密码</a>
				</p>
				<h1 class="headline type2 fs_18">修改密码</h1>
				<input type="text" class="input text" placeholder="请输入您的帐户名" name="username" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<input type="password" class="input text" placeholder="请输入密码" name="oldpassword" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<input type="password" class="input text" placeholder="请输入新密码" name="password" />
				<span class="tip text fs_12">6-16位，数字，字母或符号组合</span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<input type="password" class="input text" placeholder="确认新密码" />
				<span class="tip warning fs_12">&#x25c0; 确认新密码不能为空</span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<input type="text" class="input verify" placeholder="请输入验证码" name="veri" />
				<img src="<?php echo U('verify');?>" class="box" />
				<a href="#" class="refresh_verify">看不清？</a>
				<span class="tip warning fs_12">&#x25c0; 验证码不能为空</span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<input type="submit" value="保存修改" class="float_btn save ff_yh fs_14" />
				<input type="reset" value="返回" class="float_btn back ff_yh fs_14" />

				<!-- 清除浮动样式 -->
				<div class="clear"></div>
		
		</form>
			<!-- 清除浮动样式 -->
			<div class="clear"></div>
		</div>
	</div>
	<!-- //主体#content -->
	<!-- __底部#footer -->
	<p id="footer" class="type2 ff_simsun fs_14">&copy;　20010-20011　版权所有　2003 - 2010 dodi.cn分享设计作品？就去多迪梦工厂！<br />联系地址：广州市白云区永泰路</p>
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
		var nikename = "<?php echo ($_SESSION['tp1611_user']['nickname']); ?>";
			if (nikename!=="") {
				
				var memberInfo= $("<span></span>");
			
				memberInfo.append(nikename);
				$("#login").replaceWith(memberInfo);
				
			}else if (nikename=="") {
				$(".userInfo").css("display","none");
			};
		});
	function logout () {
		layer.confirm("确定退出吗",function (index) {
			location.href="<?php echo U(logout);?>";
		})
	}
</script>
</body>
</html>