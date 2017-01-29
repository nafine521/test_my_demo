<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2017/1/3
 * Time: 21:57
 */

namespace Admin\Controller;
use Think\Controller;

class ProductController extends BaseController
{
	public function series()
	{
		$db=M('series');
		$list=$db->select();
		$this->assign("list",$list);
		$this->display();
	}
	// 添加系列
	public function seriesAdd()
	{

		if (IS_POST) {
			$data=I("post.");
			$b=saveAdd("series",$data);
			$data['img']!=$data['oldimg']?unlink(".".$data['oldimg']):"";
            $data['logo']!=$data['oldlogo']?unlink(".".$data['oldlogo']):"";
			$this->ajaxReturn(getReturn($b));
		}else{

			// 无极分类栏目
			$list=classify($this->category_list);
			$this->assign("catlist",$list);
			//获取要修改的数据
			$id=I("get.id",0);
			$info=M("series")->find($id);
			
			$this->assign("info",$info);
			$this->display();
		}
		
	}

	// 产品中心
	public function product()
	{
		// 无极分类系列
        $arr=classify($this->series_list);
        $this->assign("serlist",$arr);
        $search=I("post.");
        if (!empty($search)) {
            if (empty($search['start'])&&!empty($search['end'])){
                $where["pubdate"]=array("elt",strtotime($search['end']." 23:59:59"));
            }
            if (empty($search['end'])&&!empty($search['start'])){
                $where["pubdate"]=array("egt",strtotime($search['start']));
            }
            if (!empty($search['start'])&&!empty($search['end'])){
                $where["pubdate"]=array(array("egt",strtotime($search['start'])),array("elt",strtotime($search['end']." 23:59:59")));
            }
            $where["name"]=array("like","%{$search['word']}%");
        }

        $where['is_trash']="0";
        $list=M("product")->where($where)->select();

        $this->assign("list",$list);
        
		$this->display();
	}
	// 产品添加修改
	public function productAdd()
	{
		// 无极分类系列
        $arr=classify($this->series_list,0,1);
        $this->assign("serlist",$arr);
        if (IS_POST) {
        	$db=D("Product");
        	$data=I("post.");
        	// 判断验证是否成功
        	if ($db->create()!=false) {
        		if ($data['id']>0) {
        			$b=$db->save();
        			$data['img']!=$data['oldimg']?unlink(".".$data['oldimg']):"";

        		}else{
        			$b=$db->add();
        			$goodsSn=$db->where("id=".$b)->getField("goods_sn");
        			
        			if (empty($goodsSn)) {
        				//自动生成商品编码
        				$randchar=randSn($b);
        				$db->where("id=".$b)->setField("goods_sn",$randchar);

        			}
        			
        		}
        	}
        	if ($b) {
        		$this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));die;
        	}

        	$this->ajaxReturn(array("status"=>"n","info"=>$db->getError()));
        	
        	
        }else{
        	$id=I("get.id");
        	$info=M("product")->find($id);
        	$this->assign("info",$info);
        	$this->display();
        }
		
	}
//	产品回收站
    public function trash(){
	    if (IS_POST){
            $b = M("product")->where("is_trash=1")->setField("is_sale", "0");
            $this->ajaxReturn(getReturn($b));
        }else {
            // 无极分类系列
            $arr = classify($this->series_list);
            $this->assign("serlist", $arr);
            //搜索
            $search = I("post.");
            if (!empty($search)) {
                if (empty($search['start']) && !empty($search['end'])) {
                    $where["pubdate"] = array("elt", strtotime($search['end'] . " 23:59:59"));
                }
                if (empty($search['end']) && !empty($search['start'])) {
                    $where["pubdate"] = array("egt", strtotime($search['start']));
                }
                if (!empty($search['start']) && !empty($search['end'])) {
                    $where["pubdate"] = array(array("egt", strtotime($search['start'])), array("elt", strtotime($search['end'] . " 23:59:59")));
                }
                $where["name"] = array("like", "%{$search['word']}%");
            }

            $where['is_trash'] = "1";
            $list = M("product")->where($where)->select();

            $this->assign("list", $list);
            $this->display();
        }
    }
    /*
         * 产品回收站删除
         * 要删除相册
         * */
    public function delTrash(){
        $id=I("id");
        $arr_id=explode(",",rtrim($id));
        $where['id']=array("in",$arr_id);
        //调用封装好的函数
        $myarr['pro_id']=array("in",$arr_id);
        $info=delImg("pro_photo",$myarr);//删除相册
        $info1=delImg("product",$where);//删除产品下的一张图片
        $b=M("product")->where($where)->delete();
        $status=getReturn($b);
        $status['delImg']=$info1;
        $status['delPhoto']=$info;
        $this->ajaxReturn($status);
    }
}