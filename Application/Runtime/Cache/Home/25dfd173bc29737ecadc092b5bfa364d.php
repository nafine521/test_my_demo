<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>购物车</title>
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/cart.css" />

	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_sidebar_toggle.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_select_all.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_delete_item.js"></script>
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
					<a href="javascript:;" class="current">我的购物车</a>
				</p>
				<form action="#" method="post" class="info_card">
					<img src="/Q2/tp1611/Public/Home/images/icons/login_avatar.jpg" class="img" />
					<p class="username ff_fz fs_18">
						用户名：
						<span class="ff_yh"><?php echo ($_SESSION['tp1611_user']['username']); ?></span>
					</p>
					<p class="text"><!--你目的是向：注册会员，积分：223分。--></p>
					<p class="search">
						<input type="text" class="input_box" placeholder="输入订单号或商品进行搜索" />
						<input type="image" src="/Q2/tp1611/Public/Home/images/icons/search.gif" class="search_button" />
					</p>
				</form>
				<h1 class="headline type2 fs_18">我的购物车</h1>
				<form action="<?php echo U('confirm_order');?>" method="post" onsubmit="return select()">
					<ul class="item_list">
						<li class="item header fs_14">
							<span class="float name">商品名称</span>
							<span class="float price">单价（元）</span>
							<span class="float amount">数量</span>
							<span class="float total">金额</span>
							<span class="float actions">交易操作</span>
							<!-- 清除浮动样式 -->
							<div class="clear"></div>
						</li>
						<?php if(empty($cart_list)): ?><li>暂无数据，继续逛逛吧
								<!--<a href="#">移至收藏夹</a>-->
							</li>
							<?php else: ?>
						<li class="action">
							<!-- 全选按钮必须给定一个groupid -->
							<!-- 响应此全选按钮的复选框必须有和此groupid相同的selectid -->
							<input type="checkbox" groupid="g1" id="calculator"/>
							<span class="fs_14">全选</span>
							<a href="javascript:;" class="delete_selected">删除</a>
							<!--<a href="#">移至收藏夹</a>-->
						</li><?php endif; ?>
						<?php if(is_array($cart_list)): $i = 0; $__LIST__ = $cart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="entry">
							<p class="item header fs_14">
								<input type="checkbox" selectid="g1" name="order_id[<?php echo ($v["order_id"]); ?>]" value="<?php echo ($v["order_id"]); ?>" class="order"/>
								<?php echo ($v["order_date"]); ?>
								<span class="fs_12">订单号： <?php echo ($v["order_sn"]); ?></span>
								<a href="javascript:;" class="delete_this"></a>
							</p>
							<div class="item float name ff_simsun">
								<a href="<?php echo U('Product/product_detail',array('id'=>$v['pro_id']));?>" title="点击可查看详情"> <img src="/Q2/tp1611<?php echo ($v["img"]); ?>" /></a>
								<p class="title"><?php echo (cutStr($v["name"],10)); ?></p>
								<p class="category">品种分类：<?php echo ($v["cat_name"]); ?></p>
							</div>
							<p class="float price"><?php if($v['promo_price']>0 && $v['promo_on']< time() && $v['promo_off']>time()){echo $v['promo_price'];}else{echo $v['official_price'];} ?></p>

								<div class="purchase_text float amount fs_14">

									<span class="num_box">
									<ul class="buttons">
										<li class="minus"></li>
										<li class="add"></li>
									</ul>
									<input type="number" name="s_num" value="<?php echo ($v["s_num"]); ?>"/>

									</span>
									&nbsp;
								</div>

							<p class="float total"><?php if($v['promo_price']>0 && $v['promo_on']< time() && $v['promo_off']>time()){echo $v['promo_price']*$v['s_num'];}else{echo $v['official_price']*$v['s_num'];} ?>.00</p>
							<p class="float actions">
								<a href="javascript:;" class="delete_this">删除</a>
								<a href="javascript:;" class="collect" dataid="<?php echo ($v['id']); ?>">移至收藏夹</a>
							</p>
							<!-- 清除浮动样式 -->
							<div class="clear"></div>
							<input type="hidden" id="order_id" value="<?php echo ($v["order_id"]); ?>"/>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>


					</ul>
					<div class="checkout_box ff_yh">
						<!-- 必须要有itemnumberfield才能使数量实时更新有效 -->
						<!-- 必须要有itemtotalfield才能使总价实时更新有效 -->
						<!-- 这两个自定义属性值随意 -->
						<p class="text fs_12">
							已选
							<span class="number" itemnumberfield="true">0</span>
							件商品
						</p>
						<p class="text fs_14">
							合计（不含运费）￥
							<span class="number fs_18" itemtotalfield="true">0.00</span>
						</p>
						<input type="submit" value="结算" class="checkout ff_yh" />

					</div>
				</form>
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
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_number.js"></script>
	<script type="text/javascript">
		var delUrl="<?php echo U('Member/cartDel');?>";

		function select() {
			if($(".order:checked").length==0){
			    layer.msg("未选择订单！",{icon:3,time:2000});
			    return false;
			}
        }



        /*点击修改数量*/
        $(".num_box .buttons .add").click(function () {
			var new_num=parseInt($(this).parent().siblings("input").val())+1;
            changeNum(new_num);
        });
        $(".num_box .buttons .minus").click(function () {
            var new_num=parseInt($(this).parent().siblings("input").val())-1;
            changeNum(new_num);
        });
        /*直接修改数值*/
        $("input[type='number']").blur(function () {
            changeNum($(this).val());
        });
		/*ajax返回函数*/
		function changeNum(new_num) {
            var order_id=$("#order_id").val();
            $.post("<?php echo U('cart');?>",{"s_num":new_num,"order_id":order_id},function (res) {
                if (res.status=="y"){
                    layer.msg(res.info,{icon:1,time:1200});
                }
            })

        }

        /*移入收藏夹*/
        $(".collect").click(function () {
            var id=$(this).attr("dataid");
            var _this=$(this)
            $.post("<?php echo U('Public/status');?>",{"tableName":"cart","primary":"id","id":id,"fieldVal":2,"fieldName":"status"},function (res) {
                if(res.status=="y"){
                    layer.msg("成功加入收藏夹",{icon:1,time:1000});
                    _this.parents("li").remove();
                }else{
                    layer.msg("加入收藏夹失败",{icon:2,time:1000});
                }
            })
        })
	</script>
</body>
</html>