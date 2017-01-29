<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2017/1/17
 * Time: 20:57
 */

namespace Admin\Controller;
use Think\Controller;

class AdminController extends BaseController
{
    /*管理员列表*/
    public function admin_list()
    {
        $db=M("admin");
        $list=$db->order("id desc")->select();
        $this->assign("list",$list);
        $this->display();
    }
    /*添加修改管理员*/
    public function adminAdd()
    {
        $db=M("admin");

        if(IS_POST){
            $data=I("post.");
            if ($data['id']<1){
                $list=$db->select();
                foreach ($list as $item) {
                    if ($item["username"]==$data["username"]){
                        $this->ajaxReturn(array("status"=>"n","info"=>"该管理员已被添加了"));die;
                    }
                }
            }
            $data["password"]=md5($data["password"]);
            $b=saveAdd("admin",$data);
            $this->ajaxReturn(getReturn($b));
        }else{
            $id=I("get.id");
            $info=$db->find($id);
            $this->assign("info",$info);
            /*查询角色*/
            $list=M("limit")->select();
            /*$list=classify($list);*/
            $this->assign("list",$list);
            $this->display();
        }

    }
    /*模块列表*/
    public function admin_permission()
    {
        $db=M("moudle");
        $list=$db->order("id desc")->select();
        $this->assign("list",$list);
        $this->display();
    }
    /*添加修改  模块管理*/
    public function admin_moudle_add()
    {
        $db=M("moudle");
        if (IS_POST){
            $data=I("post.");
            $b=saveAdd("moudle",$data);
            $this->ajaxReturn(getReturn($b));

        }else{
            $id=I("get.id");
            $list=$db->select();
            $info=array();
            foreach ($list as $v){
                if ($id==$v['id']){
                    $info=$v;
                }
            }

            $list=classify($list);

            $this->assign("list",$list);
            $this->assign("info",$info);
            $this->display();
        }

    }
    /*角色权限管理*/
    public function admin_role()
    {
        $db=M("limit");
        $list=$db->order("id desc")->select();

        $this->assign("list",$list);
        $this->display();
    }
    /*角色权限管理  添加修改*/
    public function admin_role_add()
    {
        if(IS_POST){
            $data=I("post.");
            $data['mid']=implode(",",$data['mid']);
            $b=saveAdd("limit",$data);
            $this->ajaxReturn(getReturn($b));
        }else {
            /*查询模块并以树结构打开*/
            $moudle=M("moudle")->select();
            $moudle_list=tree($moudle);

            $id=I("get.id");
            $info=M("limit")->find($id);
            $info['mid']=explode(",",$info["mid"]);

            $this->assign("info",$info);
            $this->assign("moudle_list",$moudle_list);
            $this->display();
        }
    }
}