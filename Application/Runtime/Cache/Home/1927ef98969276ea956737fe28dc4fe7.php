<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>个人资料</title>
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/member_info.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/admin/css/H-ui.css" />

	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_sidebar_toggle.js"></script>
	<style>
		.label{background: none;}
		#address{color: darkred;text-decoration: #ff5663 ;text-decoration: underline;}
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
	<div id="content" class="type1">
		<div class="main">
			<ul class="sidebar type2 ff_yh fs_14">
				<li class="banner ff_fz">
					<p class="cn">会员中心</p>
					<p class="en fs_14">Member Center</p>
				</li>
				<?php if(is_array($memberNav)): $i = 0; $__LIST__ = $memberNav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="entry">
						<p class="header order"><?php echo ($item["name"]); ?></p>
						<ul class="sub_entry">
							<?php if($item['children']): if(is_array($item['children'])): $i = 0; $__LIST__ = $item['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($v['link']);?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
								<?php else: ?>
								<p class="header trade"><a href="<?php echo U($item['link']);?>">交易管理</a></p><?php endif; ?>

						</ul>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>


				<?php if($promo_pro): ?><li class="buy" style="background:url('/Q2/tp1611<?php echo ($promo_pro["img"]); ?>') no-repeat center center"><a href="<?php echo U('Product/product',array('id'=>$promo_pro['id']));?>" title="热卖产品"><img src="/Q2/tp1611/Public/Home/images/bg/sidebar_buy.png" title="点击购买" id="buyHot"></a></li><?php endif; ?>
			</ul>
			<form action="" method="post" class="main_text ff_simsun fs_12" id="member-info">
				<input type="hidden" value="<?php echo ($_SESSION['tp1611_user']['id']); ?>" name="id" datatype="*" nullmsg="您的登录信息已过期，请重新登录"/>
				<p class="current_location ff_fz fs_14">
					当前位置：
					<a href="memeber.html">会员中心</a>
					&gt;&gt;
					<a href="member_info.html" class="current">个人信息</a>
				</p>
				<h1 class="headline type2 ff_yh fs_18">基本信息</h1>
				<span class="tag label">姓　　名：</span>
				<input type="text" class="input long" name="compellation" value="<?php echo ($info['compellation']); ?>" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag label">性　　别：</span>
				<input type="radio" name="sex" value="1" class="radio" 	<?php if($info["sex"] > 0): ?>checked="checked"<?php endif; ?> />
				<label class="tag tip">男</label>
				<input type="radio" name="sex" value="0" class="radio" <?php if($info["sex"] == 0): ?>checked="checked"<?php endif; ?>/>
				<label class="tag tip">女</label>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag label">生　　日：</span>				
				<div class="formControls col-3">
					<input type="text" onfocus="WdatePicker({el:$dp.$('d12')})" id="datemax" class="input-text Wdate input short" style="width:180px;" name="birthday"  value="<?php echo (date('Y-m-d',$info['birthday']> 0?$info['birthday']:'')); ?>">
			</div>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag label">所 在 地：</span>

				<div id="city">
					<select class="prov" name="prov"  >

					</select>
					<select class="city" disabled="disabled" name="city">

					</select>
					<select class="dist" disabled="disabled" name="dist" >

					</select>
				</div>
					<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag label">手机号码：</span>
				<input type="text" class="input long" name="tel" value="<?php echo ($info["tel"]); ?>" />
				<span class="tag tip">请真实填写，用于系统通知和找回密码</span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				
				<div class="current_addr">
					<p class="title fs_14">当前收货地址</p>
					<!--<input type="radio" checked="checked" class="ca_radio" name="delivery"/>-->
					<?php if(empty($delivery_address)): ?><p>暂未添加</p><?php else: ?><p class="text"><?php echo ($delivery_address["province"]); ?> <?php echo ($delivery_address["detail_address"]); ?>（<?php echo ($delivery_address["consignee"]); ?>收）</p><?php endif; ?>

					<!-- 清除浮动样式 -->
					<div class="clear"></div>
					<a href="javascript:layer_show('添加地址','<?php echo U('addressAdd');?>',1200,'');" class="fs_14" id="address">管理收货地址</a>
				</div>

				<input type="submit" value="保存修改" class="float_btn save ff_yh fs_14" />
				<input type="reset" value="返回" class="float_btn back ff_yh fs_14" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
			</form>
		</div>

			<!-- 清除浮动样式 -->
			<div class="clear"></div>
	</div>

	<!-- //主体#content -->
	<!-- __底部#footer -->
	<footer id="footer" class="type2 ff_simsun fs_14">&copy;<?php echo ($basic["icp"]); ?><br /><?php echo ($contact["add"]); ?></footer>
	<!-- //底部#footer -->
	<!-- <script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script> -->
<script type="text/javascript" src="/Q2/tp1611/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_slideshow.js"></script>
	
<script type="text/javascript" src="/Q2/tp1611/Public/admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/admin/js/H-ui.admin.js"></script>
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

	<script type="text/javascript" src="/Q2/tp1611/Public/admin/lib/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/js/jquery.cityselect.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/js/city.min.js"></script>
	<script type="text/javascript">
        $(function() {
            $("#city").citySelect({
                url: "/Q2/tp1611/Public/Home/js/city.min.js",                
               	prov:"<?php echo ($info['prov']); ?>",
 				city:"<?php echo ($info['city']); ?>",
 				dist:"<?php echo ($info['dist']); ?>",
                nodata: "none"
            });
        });
       
	

	</script>
	<script type="text/javascript" src="/Q2/tp1611/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
	<script type="text/javascript">
	 // ajax验证
$("#member-info").Validform({
		tiptype:2,
		ajaxPost:true,
		callback:function(form){			
			if(form.status=='y'){
                setTimeout(function () {
                    $.Hidemsg();                    
                    location.href="<?php echo U('member');?>";            
                },1000);
			}
		}
	});
	</script>



</body>
</html>