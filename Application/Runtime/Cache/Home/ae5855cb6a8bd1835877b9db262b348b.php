<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>购买记录页</title>
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/purchase_record.css" />
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_sidebar_toggle.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_select_all.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_delete_item.js"></script>
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


				<?php if($promo_pro): ?><li class="buy" style="background:url('/Q2/tp1611<?php echo ($promo_pro["img"]); ?>') no-repeat center center;"><a href="<?php echo U('Product/product',array('id'=>$promo_pro['id']));?>" title="热卖产品"><img src="/Q2/tp1611/Public/Home/images/bg/sidebar_buy.png" title="点击购买" id="buyHot"></a></li><?php endif; ?>
			</ul>
			<div class="main_text ff_yh fs_12">
				<p class="current_location ff_fz fs_14">
					当前位置：
					<a href="<?php echo U('member');?>">会员中心</a>
					&gt;&gt;
					<a href="javascript:;" class="current">购买记录</a>
				</p>
				<h1 class="headline type2 fs_18">我购买的</h1>
				<ul class="item_list">
					<li class="item header fs_14">
						<span class="float name">商品名称</span>
						<span class="float price">单价（元）</span>
						<span class="float amount">数量&nbsp;</span>
						<span class="float total">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;交易状态&nbsp;</span>
						<span class="float actions">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;交易操作</span>
						<!-- 清除浮动样式 -->
						<div class="clear"></div>
					</li>
					<li class="action">
						<input type="checkbox" groupid="g1" />
						<span class="fs_14">全选</span>
						<a href="#" class="delete_selected">删除</a>
					</li>

					<?php if(is_array($cart_list)): $i = 0; $__LIST__ = $cart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="entry">
						<p class="item header fs_14">
							<input type="checkbox" selectid="g1" name="pruchase" value="<?php echo ($v["order_id"]); ?>"/>
							<?php echo (date("Y-m-d  h:i:s",$v["order_date"])); ?>
							<span class="fs_12">订单号： <?php echo ($v["order_sn"]); ?></span>
							<a href="javascript:;" class="delete_this"></a>
						</p>
						<div class="item float name ff_simsun">
							<img src="/Q2/tp1611/Public/Home/images/imgs/cart_product_img.jpg" />
							<p class="title"><?php echo (cutStr($v["name"],11)); ?></p>
							<p class="category">品种分类：<?php echo ($v["cat_name"]); ?></p>
						</div>
						<p class="float price"><?php if($v['promo_price']>0 && $v['promo_on']< time() && $v['promo_off']>time()){echo $v['promo_price'];}else{echo $v['official_price'];} ?></p>
						<p class="float amount fs_14"><?php echo ($v["s_num"]); ?></p>
						<p class="float status">
							<span>&nbsp;</span>
							<?php if($v['status'] == 1): ?><span>交易成功</span>
								<?php else: ?>

								<span>未成功</span><?php endif; ?>
						</p>
						<p class="float actions">

							<a href="<?php echo U('Product/product_detail',array('id'=>$v['pro_id']));?>">再次购买</a>
						</p>
						<!-- 清除浮动样式 -->
						<div class="clear"></div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div class="page_nav ff_simsun">
					<?php echo ($page); ?>
				</div>
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
		//ajax删除
		$(".delete_selected").click(function () {
			var choosed=$("input[name='pruchase']");
			var str="";
			$(choosed).each(function (e) {
				strId+=$(this).val()+","
            })
			if(strId==""){
			    layer.msg("未选择数据",{icon:2,time:1000});
			    return false;
			}
			$.post("<?php echo U('Public/comDel');?>",{"tableName":"order","id":strId},function (res) {
				if (res.status=="y"){
				    laye.msg("删除成功",{icon:1,time:1000});
				    location.reload();
				}
            })
        })
var delUrl="<?php echo U('Public/comDel');?>";
		/*$(".delete_this").click(function (res) {
			var id=$(this).siblings("input").val();
            $.post("<?php echo U('Public/comDel');?>",{"tableName":"order","id":strId},function (res) {
                if (res.status=="y"){
                    laye.msg("删除成功",{icon:1,time:1000});
                    location.reload();
                }
            })
        })*/
	</script>
</body>
</html>