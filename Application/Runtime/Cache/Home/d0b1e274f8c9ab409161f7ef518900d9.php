<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>确认订单页</title>
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/confirm_order.css" />
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_select_all.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_item_calculator.js"></script>
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
		<form action="<?php echo U('Member/confirm_address');?>" method="post" class="main ff_yh fs_14" onsubmit="return selectorder()">
			<ul class="confirm_nav plain fs_16">
				<li class="first current">
					确认订单
					<span class="right_arrow"></span>
				</li>
				<li>
					<span class="left_arrow"></span>
					填写核对订单
					<span class="right_arrow"></span>
				</li>
				<li class="last">
					<span class="left_arrow"></span>
					订单提交
				</li>
				<!-- 清除浮动样式 -->
				<li class="clear"></li>
			</ul>
			<ul class="item_list">
				<li class="action">
					<!-- 全选按钮必须给定一个groupid -->
					<!-- 响应此全选按钮的复选框必须有和此groupid相同的selectid -->
					<input type="checkbox" groupid="g1" />
					全选
				</li>
				<li class="header">
					<span class="float name">商品名称</span>
					<span class="float price">单价（元）</span>
					<span class="float amount">数量</span>
					<span class="float discount">优惠方式(元)</span>
					<span class="float subtotal">小计</span>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
				</li>
				<?php if(is_array($cartList)): $i = 0; $__LIST__ = $cartList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="entry">
					<div class="float name ff_simsun fs_12">
						<input type="checkbox" selectid="g1" name="order_id[<?php echo ($v["order_id"]); ?>]" value="<?php echo ($v["order_id"]); ?>"/>
						<img src="/Q2/tp1611<?php echo ($v["img"]); ?>" />
						<p class="title"><?php echo (cutStr($v["name"],13)); ?></p>
						<p class="category">品种分类：<?php echo ($v["cat_name"]); ?></p>
					</div>
					<p class="float price">

						<?php if($v['promo_price']>0 && $v['promo_on']< time() && $v['promo_off']>time()){echo $v['promo_price']; ?>元
						<span class="tag customize_select">
							<select class="ff_yh fs_12">
								<option selected="selected">卖家促销</option>
							</select>
						</span>
						<?php }else{echo $v['official_price'];} ?>
					</p>
					<p class="float amount"><?php echo ($v["s_num"]); ?></p>
					<input type="hidden" name="s_num[<?php echo ($v["order_id"]); ?>]" value="<?php echo ($v["s_num"]); ?>">
					<p class="float discount">
						<?php if($v['promo_price']>0 && $v['promo_on']< time() && $v['promo_off']>time()){echo "正在促销";}else{echo "无优惠";} ?>
					</p>
					<p class="float subtotal"><?php if($v['promo_price']>0 && $v['promo_on']< time() && $v['promo_off']>time()){echo $v['promo_price']*$v['s_num'];}else{echo $v['official_price']*$v['s_num'];} ?>元</p>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>
			<p class="message">
				给卖家留言：
				<input type="text" placeholder="选填：对本次交易的说明（建议填写已经和卖家达成一致的说明）" name="msg"/>
			</p>
			<div class="checkout_box fs_12">
				<p>
					<span class="tag type1">运送方式：</span>
					<span class="tag type2">
						<input type="radio" checked="checked"/>
						普通配送
						<select class="ff_yh fs_12" name="delivery">

							<option selected="selected" value="<?php echo ($delivery["fee"]); ?>">快速　<?php if(empty($delivery["fee"])): ?>免邮<?php else: echo ($delivery["fee"]); ?>元 <input
									type="hidden" name="delivery" value="<?php echo ($delivery["fee"]); ?>"><?php endif; ?></option>

						</select>
					</span>
					<span class="tag type3 center">
						¥<span class="number red fs_14" id="delivery"><?php if(empty($delivery["fee"])): ?>0.00<?php else: echo ($delivery["fee"]); endif; ?></span>
					</span>
				</p>
				<?php if(!empty($delivery["insurance"])): ?><p>
					<span class="tag type1">运费险：</span>
					<span class="tag type2">购买退货运费险，退货可赔付<?php echo ($delivery["compensate"]); ?>元 [<a href="javascript:;">?</a>]</span>
					<input type="hidden" name="insurance" value="<?php echo ($delivery['insurance']); ?>">
					<span class="tag type3 center">
						¥<span class="number fs_14" id="insurance"><?php echo ($delivery['insurance']); ?><input
							type="hidden" name="insurance" value="<?php echo ($delivery["insurance"]); ?>"></span>
					</span>
				</p><?php endif; ?>
				<p>
					<span class="tag type2 right">合计（含运费，服务费）：</span>
					<span class="tag type3">
						<span class="currency fs_14">¥</span>
						<!-- 必须要有itemtotalfield才能使总价实时更新有效 -->
						<span class="number red fs_18" itemtotalfield="true">0.00</span>
					</span>
				</p>
				<p>
					<span class="tag type2 right">实付款：</span>
					<span class="tag type3">
						<span class="currency">¥</span>
						<span class="number red fs_18" itemtotalfield="true">0.00</span>
					</span> 
				</p>
			</div>
			<input type="submit" value="提交订单" class="submit ff_yh fs_18" />
			<a href="cart.html" class="back_to_cart">返回购物车</a>
			<!-- 清除浮动样式 -->
			<div class="clear"></div>
			<p class="bottom_tip fs_12">若价格变动，请在提交订单后联系卖家改价，并查看已买到的宝贝</p>
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
	<script type="text/javascript">
		function selectorder() {
			if ($(".entry input:checkbox:checked").length==0){
			    layer.msg("选择你要提交的订单",{icon:5,time:2000});
				return false;
			}
        }
	</script>
</body>
</html>