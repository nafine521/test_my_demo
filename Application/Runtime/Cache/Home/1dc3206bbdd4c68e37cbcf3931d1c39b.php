<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>新闻中心详情页</title>
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/news_detail.css" />
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
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
    <?php if($promo_pro): ?><li class="buy" style="background:url('/Q2/tp1611<?php echo ($promo_pro["img"]); ?>') no-repeat 100%;"><a href="<?php echo U('Product/product',array('id'=>$promo_pro['id']));?>" title="热卖产品"></a></li><?php endif; ?>
</ul>
			<div class="main_text ff_simsun fs_12">
				<p class="current_location ff_fz fs_14">
					当前位置：
					<a href="<?php echo U('Index/index');?>">首页</a>
					&gt;&gt;
					<a href="<?php echo U('News/news');?>">新闻中心</a>
					&gt;&gt;
					<a href="javascript:;" class="current" title="<?php echo ($info["title"]); ?>"><?php echo ($info["title"]); ?></a>
				</p>
				<p class="center_text title fs_14"><?php echo ($info["title"]); ?></p>
				<p class="center_text pub_time">发布时间：<?php echo (date($info["pubdate"],"Y-m-d : H:m:s")); ?></p>
				<p class="article"><?php echo (cutStr($info["content"],300)); ?></p>
				<div class="image_text">
					<?php if(!empty($series_info["img"])): ?><img src="/Q2/tp1611<?php echo ($series_info["img"]); ?>" class="img" /><?php endif; ?>
					<?php if(!empty($series_info["img"])): ?><img src="/Q2/tp1611<?php echo ($series_info["logo"]); ?>" class="ribbon" /><?php endif; ?>
					<p><?php echo (cutStr($series_info["description"],100)); ?></p>
				</div>
				<p class="article_nav">

				<?php if(empty($front)): ?><a href="javascript:;" class="prev" title="已经是第一篇了">上一篇</a>
					<?php else: ?>
					<a href="<?php echo U('News/news_detail',array('id'=>$front['id']));?>" class="prev">上一篇</a><?php endif; ?>

					<?php if(empty($next)): ?><a href="javascript:;" class="next" title="已经是最后一篇了">下一篇</a>
					<?php else: ?>
					<a href="<?php echo U('News/news_detail',array('id'=>$next['id']));?>" class="next">下一篇</a><?php endif; ?>
				</p>
				<ul class="news_list related">
					<li class="headline type1 ff_yh fs_14">
						<span>相关新闻</span>
					</li>
					<?php if(is_array($relation_news)): $i = 0; $__LIST__ = $relation_news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="entry">
						·<a href="<?php echo U('News/news_detail',array('id'=>$v['id']));?>"><?php echo ($v["title"]); ?></a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>

				</ul>
				<ul class="news_list recommend">
					<li class="headline type1 ff_yh fs_14">
						<span>热门推荐</span>
					</li>
					<?php if(is_array($refer_list)): $i = 0; $__LIST__ = $refer_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="entry">
						·<a href="<?php echo U('News/news_detail',array('id'=>$v['id']));?>"><?php echo ($v["title"]); ?></a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
			</div>
			<!-- 清除浮动样式 -->
			<div class="clear"></div>
		</div>
	</div>
	<!-- //主体#content -->
	<!-- __底部#footer -->
	<footer id="footer" class="type2 ff_simsun fs_14">&copy;<?php echo ($basic["icp"]); ?><br /><?php echo ($contact["add"]); ?></footer>
	<!-- //底部#footer -->
	<!-- <script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script> -->
<script type="text/javascript" src="/Q2/tp1611/Public/Home/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_slideshow.js"></script>
	
<script type="text/javascript" src="/Q2/tp1611/Public/Home/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Home/js/H-ui.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Home/js/H-ui.admin.js"></script>
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
</body>
</html>