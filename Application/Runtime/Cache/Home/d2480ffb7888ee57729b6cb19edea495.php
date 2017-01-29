<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>确认地址页</title>
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/confirm_address.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Admin/css/H-ui.css" />
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/page_confirm_address.js"></script>
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
		<form action="<?php echo U('trans_order');?>" method="post" id="form-content" class="main ff_yh fs_14">
			<ul class="confirm_nav plain fs_16">
				<li class="first">
					确认订单
					<span class="right_arrow"></span>
				</li>
				<li class="current">
					<span class="left_arrow"></span>
					填写核对订单
					<span class="right_arrow"></span>
				</li>
				<li class="last">
					<span class="left_arrow current"></span>
					订单提交
				</li>
				<!-- 清除浮动样式 -->
				<li class="clear"></li>
			</ul>
			<h1 class="fs_16">
				确认收货地址
				<a href="javascript:layer_show('添加地址','<?php echo U('addressAdd');?>',1200,'');" class="ff_simsun fs_14">管理收货地址</a>
			</h1>
			<div class="info_box">
				<?php if(empty($default_address)): ?><h1 class="fs_16">
						还未设置地址 请
						<a href="javascript:layer_show('添加地址','<?php echo U('addressAdd');?>',1200,'');" class="ff_simsun fs_14">立即添加地址！</a>
						<?php else: ?>

				<span class="title fs_14 tag">当前收货地址</span>
				<span class="text">&nbsp;<input type="radio" checked="checked" class="ca_radio" name="address_id" value="<?php echo ($default_address["id"]); ?>"/></span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">收货人：</span>
				<span class="text name"><?php echo ($default_address["consignee"]); ?></span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">手机：</span>
				<span class="text ff_simsun"><?php echo ($default_address["tel"]); ?></span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">收货区域：</span>
				<span class="text ff_simsun fs_12"><?php echo ($default_address["province"]); ?></span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">详细地址：</span>
				<span class="text ff_simsun fs_12"><?php echo ($default_address["detail_address"]); ?></span>
				<!-- 清除浮动样式 --><?php endif; ?>

				<div class="clear"></div>

				<ul class="addr_list">
					<?php if(is_array($address_list)): $i = 0; $__LIST__ = $address_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if($v['id'] != $default_address['id']): ?>&nbsp;

					<li>
						<input type="radio" name="address_id" value="<?php echo ($v["id"]); ?>"/>
						<?php echo ($v["province"]); ?> &nbsp;<?php echo ($v["detail_address"]); ?>（<?php echo ($v["consignee"]); ?>收）
					</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<h1 class="fs_16">购物清单</h1>
			<ul class="item_list">
				<li class="header">
					<span class="float name">商品名称</span>
					<span class="float price">单价（元）</span>
					<span class="float amount">数量</span>
					<span class="float subtotal">小计</span>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
				</li>
				<?php if(is_array($cart_list)): $i = 0; $__LIST__ = $cart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="entry">
					<div class="float name ff_simsun fs_12">
						<input type="hidden" name="order_id[<?php echo ($v["order_id"]); ?>]" value="<?php echo ($v["order_id"]); ?>">
						<img src="/Q2/tp1611<?php echo ($v["img"]); ?>" />
						<p class="title"><?php echo (cutStr($v["name"],13)); ?></p>
						<p class="category">品种分类：<?php echo ($v["cat_name"]); ?></p>
					</div>
					<p class="float price"><?php if($v['promo_price']>0 && $v['promo_on']< time() && $v['promo_off']>time()){echo $v['promo_price'];}else{echo $v['official_price'];} ?>元</p>
					<p class="float amount"><?php echo ($v["s_num"]); ?></p>
					<p class="float subtotal"><?php if($v['promo_price']>0 && $v['promo_on']< time() && $v['promo_off']>time()){echo $v['promo_price']*$v['s_num'];}else{echo $v['official_price']*$v['s_num'];} ?>元</p>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>
			<div class="submit_order">
				<span class="check fs_12" >
					<span class="fs_14">&nbsp;</span>
					<input type="radio" checked="checked"/>
					包含运费及服务费（<?php echo $delivery['insurance']+$delivery['fee']; ?>元）<input
						type="hidden" name="insurance" value="<?php echo ($delivery["insurance"]); ?>"><input
						type="hidden" name="delivery" value="<?php echo ($delivery["fee"]); ?>">
				</span>
				<input type="submit" value="提交订单" class="submit ff_yh" />
				<span class="total">
					应付总额:<span class="number"><?php echo ($trans_price); ?>元</span>
					<input type="hidden" name="trans_price" value="<?php echo ($trans_price); ?>">
				</span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
			</div>
		</form>
	</div>
	<!-- //主体#content -->
	<!-- __底部#footer -->
	<footer id="footer" class="type2 ff_simsun fs_14">&copy;<?php echo ($basic["icp"]); ?><br /><?php echo ($contact["add"]); ?></footer>
	<!-- //底部#footer -->

<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_slideshow.js"></script>
	
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script>
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
	<!-- __提交订单成功框#popUpSuccess -->
	<div id="popUpSuccess" class="popup_box">
		<a href="#" onclick="return popUpApp.close(this);" class="close"></a>
	</div>
	<!-- //提交订单成功框#popUpSuccess -->
	<!-- __提交订单失败框#popUpFail -->
	<div id="popUpFail" class="popup_box">
		<a href="#" onclick="return popUpApp.close(this);" class="close"></a>
	</div>
	<!-- //提交订单失败框#popUpFail -->
	<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/Validform/5.3.2/Validform.min.js"></script>
	<script type="text/javascript">
        // 首先ajax生成订单再进行跳转
        $("#form-content").Validform({
            tiptype:2,
            ajaxPost:true,
            callback:function(form){
                if(form.status=='y'){
                    popUpApp.success();
                    setTimeout(function () {
                        $.Hidemsg();
                       location.href="<?php echo U('Api/Index/index');?>";
                    },1000);
                }else{
                    popUpApp.fail();
				}
            }
        });
	</script>
</body>
</html>