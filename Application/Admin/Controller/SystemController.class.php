<?php
	namespace Admin\Controller;
	use Think\Controller;

	class SystemController extends BaseController
	{

		// 导航页面
		public function nav()
		{
			$db=M("nav");
			// 查询

			$word=I("post.word","");
			if (!empty($word)){
				$where['name']=array("like","%".$word."%");
			}
			/*
            放弃tp提供的分页。。js的分页貌似更好用
            $count      = $db->where($where)->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show = $Page->show();// 分页显示输出
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $list = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('page',$show);// 赋值分页输出
			$this->assign("list",$list);
            $this->assign("count",$count);*/
            $list = $db->where($where)->select();
            $this->assign("list",$list);
			$this->display();
		}
		// 导航添加及修改
		public function navAdd()
		{
			$db=M("nav");
			if (IS_POST) {
				// 接收数据
				$data=I("post.");
				$data['id']=I("get.id",0);
                //  引用添加或修改的函数
                $b=saveAdd('nav',$data);
                //  返回值
                $this->ajaxReturn(getReturn($b));
			}
			$id=I("get.id",0);
			$info=$db->find($id);
			$this->assign("info",$info);
			$this->display();
		}


		//栏目
		public function category()
		{
            // 查询
            $list=array();
            $word=I("post.word","");
            if (!empty($word)){
                foreach( $this->category_list as $s ){
                    if ( strpos( $s['name'] , $word ) !== false )
                        $list[]=$s;
                }
            }else{
                $list=$this->category_list;
            }

			$this->assign("list",$list);
			$this->display();
		}

		//栏目 添加 修改
		public function categoryAdd()
		{
			$db=M("category");
			if (IS_POST) {
				$data=I("post.");
                //添加或修改
                $b=saveAdd('category',$data);
				// 判断操作是否成功
                //  返回值
                $this->ajaxReturn(getReturn($b));
			}
			// 无极分类栏目
			$list=classify($this->category_list);
			$this->assign("list",$list);
			// 修改时拿到数据
			$id=I("get.id",0);
			$myarr=array();
			foreach ($this->category_list as $v) {
				if ($v['id']==$id) {
					$myarr=$v;
				}
			}
			$this->assign("info",$myarr);
			$this->display();
		}
		// 栏目删除
		public function categoryDel()
		{
		    $tableName=I("post.tableName");
			$id=rtrim(I("post.id"),",");
            $strId=explode(",",$id);
			$db=M($tableName);
			/*$list=$this->category_list;*/
			$list=$db->select();
			$arr=array();
			foreach($strId as $v){
                foreach ($list as $item) {
                    if ($item['id']=$v){
                        if ($item['pid']=='0'){
                            $arr[]=$v;
                        }
                    }
                }
            }
            $myarr=array();
            foreach ($arr as $i) {
                foreach ($list as $value){
                    if($i==$value['pid']){
                        $myarr[]=$value['id'];
                    }
                }
            }
            $myarr=array_values(array_unique($myarr));

            $getId=rtrim(implode(",",$myarr),",");


            $where['id']=array("in",$id);
			$b=$db->where($where)->delete();
			if ($b){
                $where['id']=array("in",$getId);
                $db->where($where)->delete();
                $this->ajaxReturn(array("status"=>"y","data"=>$myarr,"info"=>"删除成功"));
            }else{
                $this->ajaxReturn(array("status"=>"n","info"=>"删除失败"));
            }
		}


        public function brand()
        {
            if (IS_POST){
                $data=I("post.");

                // 修改数据时删掉原图片
                if ($data['brand']['img']!=$data['brand']['oldimg']){
                    unlink(".".$data['brand']['oldimg']);
                };
                unset($data['brand']['oldimg']);

                $b=F("brand",$data);

                if(empty($b)){
                    $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                }

            }else{
                $info=F("brand");
                $info['brand']['content']=htmlspecialchars_decode($info['brand']['content']);
                $info['brand']['description']=htmlspecialchars_decode($info['brand']['description']);
                $this->assign("info",$info['brand']);
                $this->display();
            }

        }
        /*基本设置*/
         public function basic()
        {

            if (IS_POST){
                $data=I("post.");

                // 修改数据时删掉原图片
                if ($data['basic']['logo']!=$data['basic']['oldimg']){
                    unlink(".".$data['basic']['oldimg']);                };
                unset($data['basic']['oldimg']);
                $b=F("basic",$data);
                if(empty($b)){
                    $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
                }else{
                    $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
                }

            }else{
                $info=F("basic");
// var_dump($info);
                $this->assign("basic",$info['basic']);
                $this->assign("contact",$info['contact']);
								$this->assign("delivery",$info['delivery']);
                $this->display();
            }

        }
	}
