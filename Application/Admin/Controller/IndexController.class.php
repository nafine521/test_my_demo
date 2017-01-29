<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {


    // 首页
    public function index(){
        if (!cookie("1611_admin")) {
            if(!session("?tp1611_admin")){
                $this->redirect('login');
            }
        }else{           
            session("tp1611_admin",unserialize(cookie("1611_admin"))); 
        }
        $user_info=M("admin")->find(session("tp1611_user.id"));
        $limit=M("limit")->find($user_info['lid']);
        $mid=explode(",",$limit['mid']);
        $moudld=M("moudle");
        $arr=$moudld->select();
        $myarr=array();
        foreach ($mid as $item) {
            $myarr=array_merge($myarr,getParent($arr,$item));
        }
        $myarr=array_unique($myarr);
        $list=$moudld->where(array("id"=>array("in",implode(",",$myarr))))->select();
        $list=    tree($list);

        $this->assign("list",$list);
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
                $this->error("请输入账号");die;
            }
            if (empty($password)){
                $this->error("请输入密码");die;
            }
            if (empty($code)){
                $this->error("请输入验证码");die;
            }
            // 验证码检测
            $verify = new \Think\Verify();
            if(!$verify->check($code)){
                $this->error("验证码错误");die;
            }
            //查询数据库
            $db=M("admin");
            $where['username']=$username;
            $where['password']=md5($password);
            $info=$db->where($where)->find();
            if(empty($info)){
                $this->error("账号密码有误");die;
            }else{
                // 更新登陆数据
                $data=array(
                    "login_num"=>$info['login_num']+1,
                    "login_ip"=>get_client_ip(),
                    "login_time"=>time(),
                );                
                $db->where($where)->save($data);
                // 登陆判断
                $info["login_num"]=$info['login_num']==0?"首次登陆":$info['login_num'];
                $info["login_ip"]=$info['login_ip']==''?"首次登陆":$info['login_ip'];
                $info["login_time"]=$info['login_time']==0?"首次登陆":date("Y-m-d h:i:s",$info['login_time']);                
                session("tp1611_admin",$info);
                // 是否保持登陆状态判断
                $online=I("post.online",0);
                if ($online==1) {
                    cookie("1611_admin",serialize($info),3600);
                } 
                
                $this->redirect("index");                            
            }
        }else{            
            if(cookie("1611_admin") or session("?tp1611_admin")){
           
                $this->redirect("index");
            }
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


    // 登出
    public function logout()
    {
        session("tp1611_admin",null);
        cookie("1611_admin",null);
        $this->redirect('index');
    }


     // 切换账号
    public function reLogin(){
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
                $this->ajaxReturn(array("status"=>"n","info"=>"验证码错误，请重新输入"));die;
            }
            //查询数据库
            $db=M("admin");
            $where['username']=$username;
            $where['password']=md5($password);
            $info=$db->where($where)->find();
            if(empty($info)){
                $this->ajaxReturn(array("status"=>"n","info"=>"账号或密码有误"));die;
            }else{
                // 更新登陆数据
                $data=array(
                    "login_num"=>$info['login_num']+1,
                    "login_ip"=>get_client_ip(),
                    "login_time"=>time(),
                );                
                $db->where($where)->save($data);
                // 登陆判断
                $info["login_num"]=$info['login_num']==0?"首次登陆":$info['login_num'];
                $info["login_ip"]=$info['login_ip']==''?"首次登陆":$info['login_ip'];
                $info["login_time"]=$info['login_time']==0?"首次登陆":date("Y-m-d h:i:s",$info['login_time']);
                // 保存session
                session("tp1611_admin",$info);
                // 是否保持登陆状态判断
                $online=I("post.online",0);
                if ($online>0) {
                    cookie("tp1611_admin",$info,3600);
                }
                $this->ajaxReturn(array("status"=>"y","info"=>"切换成功"));die;
            }
        }else{

            $this->display();
        }

    }


}