<?php
// 公共函数

// 根据id查名称
	function getNameById($tableName,$id,$str="一级栏目")
	 {
	 		$db=M($tableName);
	 		$info=$db->find($id);
	 		if ($info['id']==0) {
	 			return $str;
	 		}
	 		$str=$info['name'];
	 		return $str;
	 }
	 /*用户id*/
function getNameByuId($tableName,$id,$str="一级栏目")
{
    $db=M($tableName);
    $info=$db->find($id);
    if ($info['id']==0) {
        return $str;
    }
    $str=$info['username'];
    return $str;
}
/*获得父类id
 * */
function getParent($arr,$pid=0){
    $res=array();
    foreach ($arr as $v) {
        if($v['id']==$pid){
            $res[]=$v['id'];
            $res=array_merge($res,getParent($arr,$v['pid'])) ;
        }
    }
    return $res;
}
// 无极分类
	function classify($arr,$pid=0,$level=0){
		$res=array();
		foreach ($arr as $v) {
			if ($v['pid']==$pid) {
				$v['level']=$level;
				$res[]=$v;
				$res=array_merge($res,classify($arr,$v['id'],$level+1));
			}
		}
		return $res;
	}
	/*tree 树形结构*/
	function tree($arr,$pid=0){
        $res=array();
        foreach ($arr as $v) {
            if ($v['pid']==$pid) {
                $v['children']=tree($arr,$v['id']);
                $res[]=$v;
            }
        }
        return $res;
    }

//	添加修改封装
    function saveAdd($tableName,$data){
	    $db=M($tableName);
        if ($data['id']>0) {
            // 修改
            $b=$db->save($data);
        }else{
            // 添加
            $b=$db->add($data);
        }
        return $b;
    }

//    操作状态返回封装
    function getReturn($b){

        if ($b) {
            $res= array("status"=>"y","info"=>"操作成功");
        }else{
            $res= array("status"=>"n","info"=>"操作失败");
        }
        return $res;
    }

    // 压缩图片
    function thumb($src,$path,$name){
        $image = new \Think\Image(\Think\Image::IMAGE_GD,'./'.$src); // GD库
        $width = $image->width(); // 返回图片的宽度
        $height = $image->height(); // 返回图片的高度
        $type = $image->type(); // 返回图片的类型
        $mime = $image->mime(); // 返回图片的mime类型
        $size = $image->size(); // 返回图片的尺寸数组 0 图片宽度 1 图片高度
        $image->thumb(150, 150)->save('./thumb');//生成缩略图
        $res=array(
          "width"=>$width,
            "height"=>$height,
            "type"=>$type,
            "mime"=>$mime,
            "size"=>$size,
            "info"=>$image->thumb(150, 150)->save($path,$name),
        );
        return $res;
    }
    // 上传
    function upload($img,$path){
    	$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        if (!file_exists("/Uploads/")) {
                mkdir("/Uploads/",0777,true);
            }
        $upload->savePath  =      $path."/"; // 设置附件上传目录
        
        // 上传文件     
        $info   =   $upload->uploadOne($img);

        return $info;
    }
    // 截取字符串
    function cutStr($str,$length=50,$charset="utf-8"){
        $str=strip_tags(htmlspecialchars_decode($str));
        if (mb_strlen($str,$charset)>$length) {
            return mb_substr($str, 0,$length,$charset)."...";
        }else{
            return $str;
        }
    }
    // 生成商品编号
    function randSn($id){
        $len=4-strlen($id);
        return C('SN_PREFIX').date("ymd").substr("0000",0,$len);
    }



// 删除图片
function delImg($tableName,$arr_id,$img="img")
{
    try {
        $arr = M($tableName)->where($arr_id)->getField("id," . $img);
        /*      遍历删除会返回空的情况。。只有单个的情况是可以删除的
                foreach ($arr as $key=>$value) {

                    $bool[$key]=unlink(".".$value);
                }*/
        $myarr = array_map(function ($v){
            return ".".$v;
        },$arr);
        $bool = array_map('unlink', $myarr);  # 删除文件 测试1
        return array("info" => $bool);//原因在于先删了字段  才返回null。。。继续加油。。好歹用了次回调函数
    } catch (\Exception $e) {
        return array("info" => $e->getMessage());
    }
}

    /*
     * 随机邮箱验证字符
     * */
    function setCode()
    {
        $config = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNOPQRTUVWXY';
        $code = "";
        for ($i = 0; $i < 5; $i++) {
            $code .= $config[mt_rand(0, strlen($config) - 1)];
        }
        return $code;
    }

    /**
     * discuz!金典的加密函数
     * @param string $string 明文 或 密文
     * @param string $operation DECODE表示解密,其它表示加密
     * @param string $key 密匙
     * @param int $expiry 密文有效期
     */
    function authcode($string, $operation = 'ENCODE', $key = '', $expiry = 0)
    {
        // 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
        $ckey_length = 4;
        // 密匙
        $key = md5($key ? $key : C('AUTH_KEY')); // AUTH_KEY 项目配置的密钥
        // 密匙a会参与加解密
        $keya = md5(substr($key, 0, 16));
        // 密匙b会用来做数据完整性验证
        $keyb = md5(substr($key, 16, 16));
        // 密匙c用于变化生成的密文
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
        // 参与运算的密匙
        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);
        // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
        // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);
        $result = '';
        $box = range(0, 255);
        $rndkey = array();
        // 产生密匙簿
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }
        // 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        // 核心加解密部分
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            // 从密匙簿得出密匙进行异或，再转成字符
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ($operation == 'DECODE') {
            // substr($result, 0, 10) == 0 验证数据有效性
            // substr($result, 0, 10) - time() > 0 验证数据有效性
            // substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性
            // 验证数据有效性，请看未加密明文的格式
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
            // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
            return $keyc . str_replace('=', '', base64_encode($result));
        }

    }


/*
 发送邮件
*/
//$mailto 收件人  $subject 标题  $body 内容  $fromname 发送人名称   $mailfrom 回复标签 $toname要回复人名称
function sendmail($mailto,$subject,$body,$fromname,$mailfrom='',$toname='系统管理员',$attachment_dir=''){
    include COMMON_PATH."PHPMailer/class.phpmailer.php";
    if(empty($mailfrom)){
        $mailfrom="xiongquanbo330@126.com";
    }
    error_reporting(0);  //设置应该报告何种 PHP 错误  0关闭错误报告
    $mail =new PHPMailer(); //new一个PHPMailer对象出来
    $mail->CharSet="utf-8"; //设定邮件编码,默认ISO-8859-1,如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();//设定使用SMTP服务
    $mail->SMTPDebug=1;//启用SMTP调试功能1 = errors and messages 2 = messages only
    $mail->SMTPAuth=true; //启用SMTP验证功能
    $mail->SMTPSecure="smtp"; //安全协议
    $mail->Host="smtp.126.com";//SMTP 服务器
    $mail->Port=25; //SMTP服务器的端口号
    $mail->Username="xiongquanbo330"; //SMTP服务器用户名
    $mail->Password="2407561626";//SMTP服务器密码
    $mail->SetFrom("xiongquanbo330@126.com",$fromname);
    $mail->AddReplyTo($mailfrom,$toname);//添加回复标签,参数1地址,参数2名称
    $mail->Subject=$subject;//邮件标题
    $mail->MsgHTML($body);//邮件正文
    $mail->AddAddress($mailto," ");//添加收件人 参数1为收件人邮箱,参数2为收件人称呼
    if(!empty($attachment_dir)){
        $mail->AddAttachment($attachment_dir);//附件的路径和附件名
    }
    if(!$mail->Send()){
        return $mail->ErrorInfo;
    }else{
        return true;
    }
}

    /*
    *浏览历史记录
    * @param int $num 记录条数 默认10条 提示：cookie存数据大小有限制，一般为4K
    * @param int $day  记录保存时间 默认7天
    * @param string $id  商品id,分类 等等参数值 如cid,id参数值以处‘|’外的其他字符分割
    * @return string $datastr   信息id数据字符串
    */

function RecentViews($id,$num=10,$day=7)
{
    var_dump(cookie("views"));
    $id = isset($id) ? $id : 0;
    if(isset($_COOKIE['views'])){
        //直接替换
        if($num==1){
            cookie("views",$id,array("expire"=>time()+3600*$day));
            $datastr = $_COOKIE['views'];
        }else{
            $datastr = $_COOKIE['views'];

            $ids = explode('|',$datastr);
            var_dump($datastr,$ids);
            //在限定记录数以内
            if(count($ids )< $num){
                //id是否已经存在
                if(!in_array($id,$ids)){
                    $datastr .= '|'.$id;
                    cookie("views",$datastr,array("expire"=>time()+3600*$day));
                }
            }
            else
            {
                if(!in_array($id,$ids)){
                    $datastr = str_replace($ids[0].'|','',$datastr);
                    $datastr .= '|'.$id;
                    cookie("views",$datastr,array("expire"=>time()+3600*$day));
                }
            }
        }
    }
    else{
        cookie("views",$id,array("expire"=>time()+3600*$day));
        //php的cookie不会及时生效 直接访问报错 需要刷新一次
        @$datastr = $_COOKIE['views'];
    }
    return $datastr;
}