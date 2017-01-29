<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>注册</title>
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/register.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/public/admin/css/H-ui.css" />

	<!--<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>-->
	<script type="text/javascript" src="/Q2/tp1611/public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_tabs.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/page_register.js"></script>
	<style type="text/css">
		#header.type3{background: none;height: auto;}
		#header.type2 .nav{display: none;}
		#header.type2 .search{display: none;}
	</style>
</head>
<body>
	<?php if($index_banner): ?><style>
		#header.type3{background:url('/Q2/tp1611<?php echo ($index_banner['img']); ?>') no-repeat 0px 100px;background-size: 100%;height:1000px;}
</style>
<?php else: ?>
<style>
		#header.type3{background:url('/Q2/tp1611<?php echo ($banner['img']); ?>') no-repeat 0px 100px;background-size: 100%;height:350px;}			
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
			<a href="<?php echo U('Member/cart');?>" class="userInfo">我的购物车</a>
			<a href="javascript:logout();" class="userInfo">退出登陆</a>
			
		</p>
		<a href="index.html" class="logo">
			<?php if(empty($basic["logo"])): ?><img src="/Q2/tp1611/Public/Home/images/logo.png" />
				<?php else: ?>
				<img src="/Q2/tp1611<?php echo ($basic["logo"]); ?>" /><?php endif; ?>
		</a>
		<form action="<?php echo U('Public/search');?>" method="get" class="search">
			<input type="text" name="keyword" class="input_box ff_simsun fs_12" placeholder="搜索.." />
			<button type="submit" style="background: none;border: none;"><img src="/Q2/tp1611/Public/Home/images/icons/search.gif" ></button>
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
	<form action="" method="post" id="form-content" class="ff_yh fs_14">
		<p class="picture"></p>
		<div class="tab_box">
			<p class="tabs fs_20">
				<a href="#" class="tab last">账户名注册</a>
			</p>

			<div class="tab_content">
				<span class="tag">邮&nbsp;箱</span>
				<input type="email" class="input text" datatype="*" nullmsg="请输入邮箱" name="email" />
				<div class="col-3"> </div>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>

				<span class="tag">激活码</span>
				<input type="text" class="input activation" placeholder="短信验证码" style="width:85px;"datatype="*" nullmsg="请先输入邮箱验证码" name="code" />
				<a href="javascript:;" class="input box get_activation" onclick="getCode()">获取验证码</a>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>

				<span class="tag">用户名</span>
				<input type="text" class="input text" datatype="*" nullmsg="请输入用户名" name="username" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">密　码</span>
				<input type="password" class="input password" placeholder="6-16位，数字，字母或符号组合" datatype="*" nullmsg="请输入密码" name="password" />
				<a href="#" class="input show_password"></a>

				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">验证码</span>
				<input type="text" class="input verify" placeholder="输入验证码" datatype="*" nullmsg="请输入验证码" maxlength="4" name="verify" />
				<a href="javascript:verify();" class="input box verify_code">
					<img src="<?php echo U('verify');?>" id="verifySrc" />
				</a>
				<a href="javascript:verify();" class="change_verify">看不清？</a>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
			</div>
		</div>
		<p class="agreement fs_12">
			<input type="checkbox" datatype="*" nullmsg="同意条款才可注册"  name="is_agree" />
			我已立即并接受
			<a href="#">《Flyme 服务条款》</a>
		</p>
		<input type="submit" value="注册" class="submit block_button fs_18" />
	</form>
	<!-- //主体#content -->
	<footer id="footer" class="type2 ff_simsun fs_14">&copy;<?php echo ($basic["icp"]); ?><br /><?php echo ($contact["add"]); ?></footer>
	<!-- //底部#footer -->
	<!-- <script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script> -->
<script type="text/javascript" src="/Q2/tp1611/public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_slideshow.js"></script>
	
<script type="text/javascript" src="/Q2/tp1611/public/admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Q2/tp1611/public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Q2/tp1611/public/admin/js/H-ui.admin.js"></script>
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

	<script type="text/javascript" src="/Q2/tp1611/public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/public/admin/lib/icheck/jquery.icheck.min.js"></script>


	<script type="text/javascript">
	$(document).ready(function(){


	// 注册ajax
	  $("#form-content").Validform({
	      tiptype:2,
	      ajaxPost:true,
	      callback:function(form){
	            if(form.status=='y'){
	            	layer.confirm("注册成功，是否立即登录",function (index) {
	                    		location.href="<?php echo U('login');?>";
	                    	},function  () {
	                    		setTimeout(function () {
			                    $.Hidemsg();
			                    if(top.location!=self.location){
								  //说明你的页面在if框架中显示
								   var index = parent.layer.getFrameIndex(window.name);//获取当前页面的索引
			                    	parent.location.reload();//刷新父窗口
			                    	parent.layer.close(index);//关闭当前窗口
								}else{
									//说明你的页面不是在if框架中显示
									location.href="<?php echo U('Member/member');?>";
								}
				               		},1000);
	                    	});
	                
	            }else{
	            	verify();//更换验证码
	            }
	        }
	  });
	  $('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
		});

});

//	发送验证码到邮箱
		function getCode(){
			var getmail=$("input[name='email']").val();
            var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
            if(!reg.test(getmail)) {
                layer.msg("请输入有效的邮箱地址！",{icon:3,time:1000});
                return false;
            }
			// 获取session值。。避免重复发送
			var is_session="<?php echo (session('register_code')); ?>";
            if (is_session!="")return false;
            $.post("<?php echo U('sendCode');?>",{"email":getmail},function (res) {
				if(res.statu=="y"){
				    layer.msg("信息发送成功",{icon:1,time:1000});
				}else{
                    layer.msg("信息发送失败，请稍后再试",{icon:1,time:1000});
				}
            })
		}
    // 切换验证码图片
    function verify () {
        $("#verifySrc").attr("src",$("#verifySrc").attr("src")+"?"+Math.random());
    }
	</script>
</body>
</html>