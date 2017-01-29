<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/html5.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/Q2/tp1611/Public/Admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/Q2/tp1611/Public/Admin/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]--><title>用户查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
  <?php if(!empty($info['img'])): ?><img class="avatar size-XL l" src="/Q2/tp1611<?php echo ($info["img"]); ?>"><?php endif; ?>

</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">性别：</th>
        <td><?php if(($info['sex']) == "1"): ?>男<?php else: ?>女<?php endif; ?></td>
      </tr>
      <tr>
        <th class="text-r">手机：</th>
        <td><?php echo ($info['tel']); ?></td>
      </tr>
      <tr>
        <th class="text-r">邮箱：</th>
        <td><?php echo ($info['email']); ?></td>
      </tr>
      <tr>
        <th class="text-r">地址：</th>
        <td><?php echo ($info['address']); ?></td>
      </tr>
      <tr>
        <th class="text-r">注册时间：</th>
        <td><?php echo (date("Y-m-d H:i:s",$info['register_time'])); ?></td>
      </tr>

    </tbody>
  </table>
</div>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.js"></script>
<script type="text/javascript" src="/Q2/tp1611/Public/Admin/js/H-ui.admin.js"></script>
</body>
</html>