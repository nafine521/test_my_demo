<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>品牌介绍</title>
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/1611/1232/tp1611/Public/Home/styles/introduction.css" />
	<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/1611/1232/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
</head>
<body>
	<!-- __头部#header -->
	<div id="header" class="type2 type3">
		<p class="link ff_simsun fs_12">
			<a href="javascript:;" onclick="login('会员登录','<?php echo U('Index/login');?>',1150,'')" id="login">会员登录</a>
			|
			<a href="javascript:;" onclick="register('免费注册','<?php echo U('Index/register');?>',1150,'')">免费注册</a>
			<span class="userInfo">|</span>
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
			<a href="<?php echo U('Index/index');?>" class="index">首页</a>
			<?php if(is_array($navList)): foreach($navList as $key=>$v): ?><a href="<?php echo U($v['link']);?>" class="<?php echo (trim(strstr($v['link'],'/'),'/')); ?>"><?php echo ($v['name']); ?></a><?php endforeach; endif; ?>

		</p>
		<!-- 清除浮动样式 -->
		<div class="clear"></div>
	</div>

	<!-- //头部#header -->
	<!-- __主体#content -->
	<div id="content" class="type1">
		<div class="main">
			<ul class="sidebar type1 ff_fz fs_18">
				<li><a href="product.html">产品中心</a></li>
				<li><a href="introduction.html" class="current">品牌介绍</a></li>
				<li><a href="#">新鲜情报</a></li>
				<li><a href="#">客户服务</a></li>
				<li><a href="#">加入我们</a></li>
				<li class="buy"><a href="product.html"></a></li>
			</ul>
			<div class="main_text ff_simsun fs_14">
				<p class="current_location ff_fz">
					当前位置：
					<a href="../index.html">首页</a>
					&gt;&gt;
					<a href="introduction.html" class="current">品牌介绍</a>
				</p>
				<div class="intro">
					<span class="border_top"></span>
					<div class="intro_text">
						<img src="/1611/1232/tp1611/Public/Home/images/imgs/intro_img.png" />
						<p>Bambin在中国的大家庭由西安杨森制药有限公司、Bambin（中国）有限公司、Bambin（中国）医疗器材有限公司、上海Bambin制药有限公司、Bambin视力健商贸（上海）有限公司等公司组成。各公司齐心为提高中国消费者的生活水平和促进健康状况而坚持不懈地付出着努力，致力于在销售产品和研究方向上呈现各不同的市场重心与专长，针对不同症状与需要，我们都保持一贯的温和真诚态度，多角度、全方位地展开创新，引领明天的美好与健康。</p>
						<p>Bambin在中国的大家庭由西安杨森制药有限公司、Bambin（中国）有限公司、Bambin（中国）医疗器材有限公司、上海Bambin制药有限公司、Bambin视力健商贸（上海）有限公司等公司组成。各公司齐心为提高中国消费者的生活水平和促进健康状况而坚持不懈地付出着努力，致力于在销售产品和研究方向上呈现各不同的市场重心与专长，针对不同症状与需要，我们都保持一贯的温和真诚态度，多角度、全方位地展开创新，引领明天的美好与健康。</p>
						<a href="#" class="more">更多&gt;&gt;</a>
						<!-- 清除浮动样式 -->
						<div class="clear"></div>
					</div>
					<span class="border_bottom"></span>
				</div>
			</div>
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
    $(function(){
    	// console.log(location);
        $('.nav a').each(function(){
            if(this.href==String(location)){
                $(this).css('color', '#692687');
            }

        });
  /*      var bgcolor=new array("3cd1e7","7bdec0","7e88c6","f8904b");
        var randomcolor=Math.floor(Math.random()*4)+0;
        $(bgcolor).each(function (i,obj) {
            $(".randomBgeq("+i+")").css("background","#"+obj);
        });*/

    })

</script>
</body>
</html>