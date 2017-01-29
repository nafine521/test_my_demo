<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2017/1/1
 * Time: 20:24
 */

namespace Admin\Controller;
use Think\Controller;

class PictureController extends BaseController
{
	// 相册列表
	public function proPhoto(){
		// 产品名查询
		$proList=M("product")->getField("id,name");
		$this->assign("proList",$proList);
		//相册列表 
		$list=M('pro_photo')->select();
		$this->assign("list",$list);
		$this->display();
	}
	// 相册修改、添加
	public function proPhotoAdd()
	{
        //$arr=array(0=>true,1=>false,2=>false,3=>false,4=>false);dump(array_count_values($arr));//outprint #empty
		$db=M("pro_photo");
		if (IS_POST) {			
			$data=I("post.");
			
			if ($data['id']>0) {	
				$b=$db->save($data);			
				$data['img']!=$data['oldpic']?unlink(".".$data['oldpic']):"";
			}else{
				
				$res=array();
				foreach ($data['pic'] as $value) {
				    if (file_exists(".".$value)) {
                        $res["pro_id"] = $data['pro_id'];
                        $res["img"] = $value;
                        $arr[] = $res;
                    }
				}
				$b=$db->addAll($arr);

			}
			
			$this->ajaxReturn(getReturn($b));
		}else{
			$id=I("get.id");
            $pro_id=I("get.pro_id");
			$info=$db->find($id);
			$this->assign("info",$info);

			/*判断是否是火狐，多图片上传插件无法兼容*/
            $firfox=strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')?true:false;
            $this->assign("firfox",$firfox);
//           var_dump( $firfox);
			// 产品名
			$proList=M("product")->getField("id,name");

			$this->assign("proList",$proList);
            $this->assign("pro_id",$pro_id);
			$this->display();
		}

	}
       /*产品id关联相册*/
    public function proPhotoShow(){
        $pro_id=I("pro_id");
        $db=M("pro_photo");
        if (IS_POST){
            $data=I("post.");
        }else{
            $list=$db->where("pro_id=$pro_id")->getField("id,img");
            $this->assign("list",$list);
            $this->assign("pro_id",$pro_id);
            $this->display();
        }

    }
    /*banner*/
    public function banner()
    {
    	$db=M("banner");
    	$list=$db->select();
    	$this->assign("list",$list);
    	$this->display();

    }
     /*banner添加修改*/
    public function bannerAdd()
    {
    	$db=M("banner");
    	if (IS_POST) {
    		$data=I("post.");
    		$b=saveAdd("banner",$data);
    		if ($data['img']!=$data['oldpic'])unlink(".".$data['oldpic']);
    		$this->ajaxReturn(getReturn($b));
    		
    	}else{
    		$info=$db->find(I("get.id"));
    		$this->assign("info",$info);
    		$this->display();
    	}
    	
    }

}