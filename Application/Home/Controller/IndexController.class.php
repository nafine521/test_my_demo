<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends PublicController
{

	// 首页
    public function index(){
         /*banner图*/
        $banner_where=array(
            "local"=>0,
            "is_show"=>1,
        );
        $banner=M("banner")->where($banner_where)->find();
        $this->assign("index_banner",$banner);


        /*查询产品系列*/
       /* $series_where=array(
            ""
        );*/
        $series_list=M("series")->field("tp_series.*,tp_category.name")->join("tp_category on tp_series.cat_id=tp_category.id")->order("tp_series.id desc")->select();
        $this->assign("series_list",$series_list);

        /*查询新闻*/
        $news_list=M("news")->limit(5)->order("pubdate desc")->select();
        $this->assign("news_list",$news_list);


        $this->display();



    }

     // 登录
    public function login(){
    	if (IS_POST){
            // 接收数据
            $code=I("post.verify");
            $username=I("post.username");
            $password=I("post.password");

            //判断是否为空
            if (empty($username)){
                $this->ajaxReturn(array("status"=>"n","info"=>"请输入账号"));die;
            }
            if (empty($password)){
                $this->ajaxReturn(array("status"=>"n","info"=>"请输入密码"));die;
            }
            if (empty($code)){
                $this->ajaxReturn(array("status"=>"n","info"=>"请输入验证码"));die;
            }
            // 验证码检测
            $verify = new \Think\Verify();
            if(!$verify->check($code)){
                $this->ajaxReturn(array("status"=>"n","info"=>"验证码错误"));die;
            }
            //查询数据库
            $db=M("user");
            $where['username']=$username;
            $where['password']=md5($password);
            $where['active']=1;
            $info=$db->where($where)->find();
            if(empty($info)){
            	$this->ajaxReturn(array("status"=>"n","info"=>"账号密码有误"));

            }else{
                session("tp1611_user",$info);
                // 是否保持登陆状态判断
                $online=I("post.online",0);
                if ($online==1) {
                    cookie("1611_user",serialize($info),3600);
                }
                $db->where($where)->setField("login_time",time());
                $this->ajaxReturn(array("status"=>"y","info"=>"登陆成功"));
            }
        }else{
            $this->display();
        }

    }


    //  验证码
    public function verify(){
        $conset = array(
            'fontSize'    =>    18,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
        );
        $Verify = new \Think\Verify($conset);
        $Verify->entry();
    }

    // 注册
    public function register()
    {
    	if (IS_POST) {
            // 验证提交内容
    		$data=I("post.");

            // 验证码检测
            $verify = new \Think\Verify();
            if(!$verify->check($data['verify'])){
                $this->ajaxReturn(array("status"=>"n","info"=>"验证码错误"));die;
            }
            //检测邮箱激活码
            if(!session("?register_code")){
                $this->ajaxReturn(array("status"=>"n","info"=>"请先验证邮箱"));die;
            }else
            {
                if($data['code']!=session("register_code")){
                    $this->ajaxReturn(array("status"=>"n","info"=>"邮箱激活码错误"));die;
                }
            }

            // 验证用户名和邮箱是否被注册
            $db=M('user');
            $arr=$db->select();
            foreach ($arr as $v) {
                if ($v['username']==$data['username']) {
                    $this->ajaxReturn(array("status"=>"n","info"=>"该账号被注册"));die;
                }
                if ($v['email']==$data['email']) {
                    $this->ajaxReturn(array("status"=>"n","info"=>"该账号被注册"));die;
                }
            }

            // 检测密码强度
            $password=$data['password'];
            $reg=array(
                "/^\d+$/",
                "/^[a-zA-Z]+$/",
                "/([a-zA-Z]+\d+)+$/",
            );
            $match=array_map(function($v)use($password){
                return preg_match($v, $password);
            }, $reg);
            if (in_array(1, $match)) {
                $safe=array_keys($match,1,ture);
            }else{
                $safe[0]=3;
            }
            $data['safe']=$safe[0];
            // 注册用户信息到数据库
            // unset($data['verify']);//tp可以过滤没有的字段。。。。
            $data['password']=md5($data['password']);
            //保存注册时间
            $data['register_time']=time();
            $b=$db->add($data);

            if ($b){
                try{
                    //发送邮件激活账号
                    $mailto=$data['email'];
                    $subject="恭喜您注册本站会员";
                    $user_info=array(
                        "email"=>$data['email'],
                        "password"=>$data['password'],
                    );
                    // 加密传输用户信息
                    $setCode=array_map(function($v){
                            $str=str_replace("+", "_", $v);
                            return authcode($str,"ENCODE");
                        },$user_info);
                    $urlStr="?".implode("|",$setCode);
                    $url="http://".$_SERVER['HTTP_HOST'].U("active").$urlStr;
                    $body=<<<EOT
                        欢迎注册本站会员,您需要点击此链接激活<a href="$url">立即激活</a><br/>
                        如果不是您操作的。。请无视此链接。。<br/>
                        <hr/>
                        如果链接不可点击，请复制以下链接到浏览器。<br/>
                        <small>$url</small>
EOT;
                    $fromname="Bambin集团";
                    sendmail($mailto,$subject,$body,$fromname);

                    $this->ajaxReturn(array("status"=>"y","info"=>"注册成功，请立即前往邮箱激活账号","safetest"=>$data['safe']));die;
                }catch(\Exception $e){
                    $this->ajaxReturn(array("status"=>"y","info"=>"注册成功，邮箱激活发送失败","error"=>$e->ErrorInfo));die;
                }
            }else{
                $this->ajaxReturn(array("status"=>"n","info"=>"注册失败"));die;
            }


    	}else{
    		$this->display();
    	}

    }

    // 退出登陆
    public function logout()
    {
    	session("tp1611_user",NULL);
    	cookie("1611_user",NULL);
    	header("Refresh:0;url=".$_SERVER['HTTP_REFERER']);
    }

    /*发送邮箱验证码
     * */
    public function sendCode()
    {
        $verify=setCode();
        session(array('name'=>'register_code','expire'=>1200));
        session('register_code',$verify);
        $mailto=I("post.email");
        $subject="欢迎注册本站会员";
        $body="欢迎注册本站会员,您的邮箱激活码是:".$verify;
        $fromname="Bambin集团";
        $b=sendmail($mailto,$subject,$body,$fromname);
        if ($b===true){
            $this->ajaxReturn(array("statu"=>"y","infomation"=>"激活码已发送"));
        }else{
            $this->ajaxReturn(array("statu"=>"n","infomation"=>$b));
        }

    }

    // 修改密码
    public function change_password()
    {
        if (IS_POST) {
            $data=I("post.");
            // 验证码检测
            $verify = new \Think\Verify();
            if(!$verify->check($data['verify'])){
                $this->ajaxReturn(array("status"=>"n","info"=>"验证码错误"));die;
            }
            //验证账号密码是否正确
            $password=md5($data['oldpassword']);
            $arr=M("user")->select();
            foreach ($arr as $v) {
                if ($data['username'] == $v["username"]){
                     if ($password != $v["password"]) {
                        $this->ajaxReturn(array("status"=>"n","info"=>"账号或密码有误"));
                        die;
                    }
                    $id=$v['id'];
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"账号不存在"));die;
                }
            }
            // 修改密码
            $db=M("user");
            $new=array("password"=>md5($data['password']));
            $b=$db->where("id=$id")->save($new);
            $this->ajaxReturn(getReturn($b));

        }
        $this->display();
    }
//    激活链接
    public function active()
    {
        header("content-type:text/html;charset=UTF-8");
        $code=array_keys(I("get."));

        $user_info=explode("|", $code[0]);
        $getCode=array_map(function($v){
            $str=str_replace("_", "+", $v);
            return authcode($str,"DECODE");
        },$user_info);

        $where=array(
            "email"=>$getCode[0],
            "password"=>$getCode[1],
        );

        $db=M("user");
        $info=$db->where($where)->find();

        if (!empty($info)) {
            $db->where($where)->setField("active",1);
            die("<script>alert('激活成功！立即登录');location.href='".U('index')."';</script>");

        }else{

            try{
                $mailto="332656706@qq.com";
                $subject=  "账号激活失败";

                $body=<<<EOT
                用户注册激活失败，请手动给用户激活！<br>
                用户邮箱是{$where['email']}
EOT;
                $fromname="Bambin集团";
                sendmail($mailto,$subject,$body,$fromname);
                echo <<<EOT
                    系统出现错误，已将问题发送给管理员。
EOT;
                header("Refresh:5;url=".U('index'));
            }catch(\Exception $e){
                echo $e->ErrorInfo;
            }
        }
    }

}
