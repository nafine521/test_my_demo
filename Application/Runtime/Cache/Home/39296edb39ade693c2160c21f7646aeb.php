<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>产品中心详情页</title>
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/product_detail.css" />
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_slideshow.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_number.js"></script>
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
			<ul class="sidebar type1 ff_fz fs_18">
    <?php if(is_array($subnavList)): $i = 0; $__LIST__ = $subnavList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($v['link']);?>" <?php if($action==strchr($v['link'],'/',true) && $action!="Contact")echo "style='color:#692687;'"; ?> ><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php if($promo_pro): ?><li class="buy" style="background:url('/Q2/tp1611<?php echo ($promo_pro["img"]); ?>') no-repeat center center;">
        <a href="<?php echo U('Product/product_detail',array('id'=>$promo_pro['id']));?>" title="热卖产品"><img src="/Q2/tp1611/Public/Home/images/bg/sidebar_buy.png" title="点击购买" id="buyHot"></a>

    </li><?php endif; ?>
</ul>
			<div class="main_text ff_simsun fs_12">
				<p class="current_location ff_fz fs_14">
					当前位置：
					<a href="<?php echo U('Index/index');?>">首页</a>
					&gt;&gt;
					<a href="<?php echo U('Product/product');?>">产品中心</a>
					&gt;&gt;
					<a href="javascript:;" class="current"><?php echo ($info["name"]); ?></a>
				</p>
				<form action="<?php echo U('Member/getOrder');?>" method="post" class="detail" id="form-shopping">
					<span class="border_top"></span>
					<div class="detail_text">
						<div class="slideshow">
							<div class="wrapper">
								<ul class="image plain">
									<li>
										<img src="/Q2/tp1611<?php echo ($info["img"]); ?>"/>
									</li>
									<?php if(!empty($pro_photo)): ?><li>
										<img src="/Q2/tp1611<?php echo ($pro_photo["img"]); ?>" />
									</li><?php endif; ?>
								</ul>
							</div>
							<ul class="nav">
								<li class="prev"></li>
								<li class="next"></li>
							</ul>
						</div>
						<p class="name ff_yh fs_14"><?php echo ($info["name"]); ?></p>
						<?php if(!empty($info['promo_pri'])): ?><p class="tags">限时特价销售 保证正品 支持鉴定</p><?php endif; ?>

						<p class="price">
							价格
							<span class="ff_yh">￥<?php echo ($info["official_price"]); ?></span>
						</p>
						<p class="purchase_text">
							配送
							<span class="customize_select">
								<select>
									<option><?php echo ($delivery["area"]); ?></option>
								</select>
							</span>
							快递：<?php if(empty($delivery["fee"])): ?>免运费<?php else: echo ($delivery["fee"]); ?>元<?php endif; ?>
						</p>
						<div class="purchase_text">
							数量：
							<span class="num_box">
								<ul class="buttons">
									<li class="minus"></li>
									<li class="add"></li>
								</ul>
								<input type="number" name="quantity" value="1"/>
							</span>
							<input type="hidden" name="pro_id" value="<?php echo ($info["id"]); ?>">
						</div>
						<input type="submit" value="立即购买" class="buy button ff_fz fs_20" />
						<input type="button" value="加入购物车" class="add_to_cart button ff_fz fs_20" id="add_to_cart"/>
						<!-- 清除浮动样式 -->
						<div class="clear"></div>
					</div>
					<span class="border_bottom"></span>
				</form>
				<p class="description"><?php echo (htmlspecialchars_decode($info["description"])); ?></p>
				<h1 class="recommend headline type1 ff_yh fs_18">
					<span>产品推荐</span>
				</h1>
				<ul class="recommend_list plain">
					<?php if(is_array($promo_list)): $i = 0; $__LIST__ = $promo_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
						<img src="/Q2/tp1611<?php echo ($v["img"]); ?>" />
						<p class="bubble_top"></p>
						<a href="<?php echo U('Product/product_detail',array('id'=>$v['id']));?>" class="text"><?php echo ($v["name"]); ?></a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>

			</div>
			<!-- 清除浮动样式 -->
			<div class="clear"></div>
		</div>
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
		/*加入购物车*/
		$("#add_to_cart").click(function() {
			var quantity=$("input[name='quantity']").val();
			var pro_id="<?php echo ($info["id"]); ?>";
			$.post("<?php echo U('product_detail');?>",{"quantity":quantity,"pro_id":pro_id},function(res){
				if(res.status=="y")layer.msg(res.info,{icon:1,time:1500});
				else layer.msg(res.info,{icon:3,time:1500});
			});
		});


	</script>
</body>
</html>