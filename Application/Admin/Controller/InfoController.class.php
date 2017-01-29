<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2017/1/3
 * Time: 12:18
 */

namespace Admin\Controller;
use Think\Controller;

class InfoController extends BaseController
{
    //新闻管理
    public function news(){
        $search=I("word");
        $where=array();
        if (!empty($search)){
            $where['title']=array("like","%$search%");
            $where['keyword']=array("like","%$search%");
            $where['_logic']="or";
        }
        $list=M("news")->where($where)->select();
        $this->assign("list",$list);
        // 无极分类系列
        $arr=classify($this->series_list);
        $this->assign("serlist",$arr);
            
        $this->display();

    }
    //添加修改新闻
    public function newsAdd(){
        if (IS_POST){
            $data=I("post.");
            if (empty($data['id']))$data['pubdate']=time();
            $b=saveAdd("news",$data);
            $this->ajaxReturn(getReturn($b));
        }else{
            // 无极分类栏目
            $list=classify($this->series_list);
            $this->assign("serlist",$list);
            
            //获取修改的数据
            $id=I("get.id",0);
            $info=M("news")->find($id);           
            $this->assign("info",$info);
            $this->display();
        }
    }
}