<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-8-4
 * Time: 下午2:50
 */
return array(
	'alipay_config'=>array(
			'partner' =>'2088021119469553',   //这里是你在成功申请支付宝接口后获取到的PID；
			'key'=>'6x7f5gin1grq6wvpfwji07m7rtqtx6ey',//这里是你在成功申请支付宝接口后获取到的Key
			'sign_type'=>strtoupper('MD5'),
			'input_charset'=> strtolower('utf-8'),
			'cacert'=> getcwd().'\\cacert.pem',
			'transport'=> 'http',
	),
	//以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；
	
	'alipay'   =>array(
			//这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
			'seller_email'=>'2355908671@qq.com',
			//这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
			'notify_url'=>'http://14621_DBXP519.php.100dan.cn?s=Api/Index/notifyurl',
			//这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
			'return_url'=>'http://14621_DBXP519.php.100dan.cn?s=Api/Index/returnurl',
	),
);