<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>会员中心</title>
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/main.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/common.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/header.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/footer.css" />
	<link rel="stylesheet" type="text/css" href="/Q2/tp1611/Public/Home/styles/member.css" />
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/jquery_1.11.3.min.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_scrollbar.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/mod_sidebar_toggle.js"></script>
	<script type="text/javascript" src="/Q2/tp1611/Public/Home/scripts/page_member.js"></script>
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
			<div class="main_text ff_simsun fs_12">
				<p class="current_location ff_fz fs_14">
					当前位置：
					<a href="javascript:;" class="current">会员中心</a>
				</p>
				<h1 class="headline type2 ff_yh fs_18">会员中心</h1>
				<h2 class="headline type3 user ff_fz fs_14">个人资料</h2>
				<div class="info_box">
					<input type="hidden"  id="picurl" name="img" value="<?php echo ($user_info['img']); ?>"/>
                	<input type="hidden" name="oldpic" value="<?php echo ($user_info['img']); ?>" >
                	<input type="hidden" name="id" value="<?php echo ($_SESSION['tp1611_user']['id']); ?>" >

                	<span class="btn btn-success" id="image"  style="cursor: pointer;"><img id="thumb_url" src='<?php if($user_info['img']): ?>/Q2/tp1611<?php echo ($user_info['img']); else: ?>/Q2/tp1611/Public/Home/images/icons/login_avatar.jpg<?php endif; ?>' class="img" alt="选择图片" title="点击更换头像" ></span>
					<p class="info username ff_fz fs_18">
						用户名：
						<span class="ff_yh"><?php echo ($_SESSION['tp1611_user']['username']); ?></span>
					</p>
					<a href="member_info.html" class="action">完善个人资料</a>
					<p class="info level ff_yh fs_12">
						会员等级：<span>SVIP<?php echo ($user_info["membership"]); ?></span>
					</p>
					<a href="member_info.html" class="action">管理收货地址</a>
					<a href="purchase_record.html" class="info view_record">查看购物记录</a>
					<a href="change_password.html" class="action">修改密码</a>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
					<a href="javascript:;" class="change_avatar">保存头像</a>
					<?php if($finish): ?><p class="messages">
							您的信息不完整！[<a href="<?php echo U('member_info');?>">请填写资料</a>]<a href="#" class="hide_this">隐藏显示</a>
						</p><?php endif; ?>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
				</div>
				<ul class="list_box">
					<li class="headline type3 ff_fz fs_14">我的动态</li>
					<?php if(is_array($RecentViews)): foreach($RecentViews as $k=>$v): ?><li class="entry">
						<a href="<?php echo U('Product/product_detail',array('id'=>$k));?>"><?php echo (getNameById("product",$k)); ?></a>
						<span class="date"><?php echo (date("Y-m-d",$v)); ?></span>
						<span class="time"><?php echo (date("H:i",$v)); ?></span>
						<!-- 清除浮动样式 -->
						<div class="clear"></div>
					</li><?php endforeach; endif; ?>
					<li class="more">
						<?php if(empty($RecentViews)): ?>你还没逛过本站<?php endif; ?>
						<a href="<?php echo U('Product/product');?>">&gt;&gt;随便看看...</a>
					</li>
				</ul>


				<h2 class="headline type3 ff_fz fs_14">我的收藏</h2>
				<div class="slideshow">
					<div class="wrapper">
					<ul class="favorite_list plain image">

						<?php if(is_array($cart_list)): $i = 0; $__LIST__ = $cart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
							<img src="/Q2/tp1611<?php echo ($v['img']); ?>" />
							<a href="<?php echo U('Product/product_detail',array('id'=>$v['id']));?>" class="name"><?php echo (cutStr($v['name'],10)); ?></a>
							<p class="price">
								￥<?php if($v['promo_price']>0 && $v['promo_on']< time() && $v['promo_off']>time()){echo $v['promo_price'];}else{echo $v['official_price'];} ?>
								<a href="javascript:collectBuy(<?php echo ($v['order_id']); ?>);">购买&gt;&gt;</a>
							</p>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>

					</ul>
					</div>
						<ul class="nav">
						<li class="prev"></li>
						<li class="next"></li>
						</ul>
						<!-- 清除浮动样式 -->
						<div class="clear"></div>

				</div>
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

	<!-- 新增编辑器引入文件 -->
<link rel="stylesheet" href="/Q2/tp1611/Public/Admin/kindeditor/themes/default/default.css" />
<script src="/Q2/tp1611/Public/Admin/kindeditor/kindeditor-min.js"></script>
<script src="/Q2/tp1611/Public/Admin/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
	/*上传图片*/
	$(".change_avatar").click(function(){
		var uploadImg=$("input[name='img']").val();
		var oldpic=$("input[name='oldpic']").val();
		var id=$("input[name='id']").val();
		if (uploadImg==oldpic) {
			layer.msg("请点击图片上传图片",{icon:2,time:2000});
			return false;
		};
		$.post("<?php echo U('member');?>",{"img":uploadImg,"oldpic":oldpic,"id":id},function(res){
			if (res.status=="y") {
				$("input[name='oldpic']").val(uploadImg);
				layer.msg("保存成功",{icon:1,time:2000});
			}else{
				layer.msg("保存失败,请尝试重新登录",{icon:2,time:2000});
			}
		})
	});
	//上传图片
    KindEditor.ready(function(K) {
    var editor = K.editor({
        allowFileManager : true,
        uploadJson : "<?php echo U('Basic/uploadImg',array('path'=>'user','w'=>150,'h'=>80));?>", //上传功能
        fileManagerJson : '/Q2/tp1611/Public/Admin/kindeditor/php/file_manager_json.php?dirpath=user', //网络空间
      });
    //上传背景图片
    K('#image').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
            showRemote : false, //网络图片不开启
            //showLocal : false, //不开启本地图片上传
            imageUrl : K('#picurl').val(),
            clickFn : function(url, title, width, height, border, align) {

            K('#picurl').val(url);
            $('#thumb_url').attr("src","/Q2/tp1611"+url);
            editor.hideDialog();
          }
        });
      });
    });
 });

/*收藏列表提交购买事件*/
function collectBuy(id) {
//    $url=U("confirm_order");
	document.write("<form action='<?php echo U("confirm_order");?>' method='post' name='form1' style='display:none'>");
    document.write("<input type='hidden' name='order_id' value='"+id+"'>");
 	document.write("</form>");
    document.form1.submit();

}

</script>
</body>
</html>