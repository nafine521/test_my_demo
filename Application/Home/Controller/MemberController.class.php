<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2016/12/28
 * Time: 20:45
 */

namespace Home\Controller;
use Think\Controller;

class MemberController extends BasicController
{
	//会员中心
	public function member()
	{
		$db=M("user");
		if (IS_POST) {
		    /*上传图片*/
			$img=I("img");
			$oldpic=I("oldpic");
			$id=I("id");
            /*判断当前图片和上传图片是否相同*/
			if($img!=$oldpic)unlink(".".$oldpic);
			$b=$db->where("id=$id")->setField("img",$img);
			$this->ajaxReturn(getReturn($b));
		}else{
		    /*查询用户所有的初始化订单id*/
		    $order_id_where=array(
		        "user_id"=>session("tp1611_user.id")
            );
		    $order=M("order");
		    $order_id=$order->where($order_id_where)->getField("order_sn,id");
            $order_id=implode(",",$order_id);
            /*查询用户所有购物车移入收藏栏的*/
            $collect_where=array(
                "tp_cart.order_id"=>array("in",$order_id),
                "tp_cart.status"=>2
            );
		    $cart_list=M("cart")->field("tp_product.*,tp_cart.id as cart_id,tp_cart.order_id")->join("left join tp_product on tp_product.id=tp_cart.pro_id left join tp_order on tp_order.id=tp_cart.order_id")->where($collect_where)->order("tp_order.order_date desc")->select();
		    //var_dump($cart_list,M("cart")->getLastSql());
		    $this->assign("cart_list",$cart_list);

		    /*查询cookie的浏览记录*/
		    $RecentViews=unserialize( cookie("views"));
            arsort($RecentViews);
            $this->assign("RecentViews",$RecentViews);

			$this->display();
		}
	}
	//修改个人信息
	public function member_info()
	{
		$db=M("user");
		if (IS_POST) {
			$data=I("post.");

			$data['address']=$data['prov']." ".$data['city']." ".$data['dist'];
			$data['birthday']=strtotime($data['birthday']);
			$b=$db->save($data);
			$this->ajaxReturn(getReturn($b));
		}else{
			$info=$db->find(session("tp1611_user.id"));
			$arr=explode(" ", $info['address']);

			$info['prov']=$arr[0];
			$info['city']=$arr[1];
			$info['dist']=$arr[2];
			/*查询默认地址*/
			$delivery_status=array(
			    "uid"=>session("tp1611_user.id"),
                "status"=>1
            );
			$delivery_address=M("address")->where($delivery_status)->find();
            $this->assign("delivery_address",$delivery_address);
			$this->assign("info",$info);
			$this->display();
		}
	}
	/*购物车*/
    /**
     *
     */
    public function cart()
    {
        if (IS_POST){
            $id=I("order_id");
            $s_num=I("s_num");
            $b=M("cart")->where("order_id=".$id)->setField("s_num",$s_num);
            $this->ajaxReturn(getReturn($b));
        }else{
            /*查询用户所有的订单*/
            $order_list=M("order")->where(array("user_id"=>session("tp1611_user.id")))->select();
            //遍历$order_list的id
            $arr=array();
            array_map(function ($v)use(&$arr){
                $arr[]=$v['id'];
            },$order_list);
            /*根据订单查询购物车关联的产品*/
            $cart_where=array(
                "order_id"=>array("in",implode(",",$arr)),
                "status"=>0
            );
            $cart_list=M("cart")->join("left join tp_product on tp_cart.pro_id=tp_product.id left join tp_order on tp_order.id=tp_cart.order_id")->where($cart_where)->order("tp_order.order_date desc")->select();

            $this->assign("cart_list",$cart_list);
            $this->display();
        }
	}
	/*删除购物车内订单*/
    public function cartDel()
    {
        $id=rtrim(I("order_id"));
        //var_dump($id,I("post."));die;
        $order_db=M("order");
        $cart_db=M("cart");
        $a=$order_db->where(array("id"=>array("in",$id)))->delete();
        $c=$cart_db->where(array("order_id"=>array("in",$id)))->delete();
        $this->ajaxReturn(getReturn($a));
        //$this->ajaxReturn(getReturn($c));
	}
    /*确认订单*/
    public function confirm_order()
    {
        $data=I("post.");
        foreach ($data as $key=>$datum) {
            foreach ($datum as $k=>$item) {
                if (!isset($res[$k][$key]))$res[$k][$key]=$item;
                else $res[$k][$key]=$item;
            }
        }
        if(is_array($data['order_id'])){
            $strOrderId=implode(",",$data['order_id']);
        }else{
            $strOrderId=$data['order_id'];
        }

        $cart_list=M("cart")->join("left join tp_product on tp_cart.pro_id=tp_product.id left join tp_order on tp_order.id=tp_cart.order_id")->where(array("tp_cart.order_id"=>array("in",$strOrderId)))->order("tp_order.order_date desc")->select();
        

        $this->assign("cartList",$cart_list);
        $this->display();
	}

	/*确认地址*/
    public function confirm_address()
    {
        $data=I("post.");
        /*多余的。。只做小练习。。*/
        foreach ($data as $key=>$datum) {
            foreach ($datum as $k=>$item) {
                if (!isset($res[$k][$key]))$res[$k][$key]=$item;
                else $res[$k][$key]=$item;
            }
        }
        $strOrderId=implode(",",$data['order_id']);
        /*三表连接查询*/
        $cart_list=M("cart")->join("left join tp_product on tp_cart.pro_id=tp_product.id left join tp_order on tp_order.id=tp_cart.order_id")->where(array("tp_cart.order_id"=>array("in",$strOrderId)))->order("tp_order.order_date desc")->select();
        /*计算总价格*/
        foreach ($cart_list as $key=>$item){
            if(!isset($trans_price)) {
                if ($item['promo_price'] > 0 && $item['promo_on'] < time() && $item['promo_off'] > time()) $trans_price = $item['promo_price']*$item['s_num'];
                else $trans_price = $item["official_price"]*$item['s_num'];
            }else{
                $trans_price+=$trans_price;
            }

        }
        /*对服务费和运费相加*/
        $server_num=$data['delivery']+$data['insurance'];
        $trans_price=$trans_price+$server_num;
        /*查询地址*/
        $address_where=array(
            "uid"=>session("tp1611_user.id")
        );
        $address_list=M("address")->where($address_where)->order("id desc")->select();
        /*foreach找到默认地址*/
        $default_address=array();
        foreach ($address_list as $item) {
            if ($item['status']==1)$default_address=$item;
        }

        $this->assign("server_num",$server_num);
        $this->assign("default_address",$default_address);
        $this->assign("address_list",$address_list);
        $this->assign("trans_price",$trans_price);
        $this->assign("cart_list",$cart_list);
        $this->display();
	}
	/*地址管理*/
    public function addressAdd()
    {
        $address=M("address");
        if (IS_POST){
            $data=I("post.");
            if (!session("?tp1611_user")){
                $this->ajaxReturn(array("status"=>"n","info"=>"请先登录！"));die;
            }

            $data['uid']=session("tp1611_user.id");
            if ($data['status']>0)$address->where(array("uid=".session("tp1611_user.id")))->setField("status",0);
            $data['province']=$data['prov'].$data['city'].$data['dist'];
            $b=$address->add($data);
            $this->ajaxReturn(getReturn($b));
        }else {
            $add_list=$address->where("uid=".session("tp1611_user.id"))->order("id desc")->select();
            $this->assign("add_list",$add_list);
            $this->display();
        }
	}

	/*生成交易订单页面*/
    public function trans_order()
    {
        $data=I("post.");
        if(empty($data['address_id'])){
            $this->ajaxReturn(array("status"=>"n","info"=>"请选择收货地址"));die;
        }
        //var_dump($data);die;
        $strOrderId=implode(",",$data['order_id']);
        /*三表连接查询*/
        $cart_list=M("cart")->join("left join tp_product on tp_cart.pro_id=tp_product.id left join tp_order on tp_order.id=tp_cart.order_id")->where(array("tp_cart.order_id"=>array("in",$strOrderId)))->select();
        /*计算总价格以及找到所有的pro_id*/
        $pro_id="";
        foreach ($cart_list as $key=>$item){
            if(!isset($trans_price)) {
                if ($item['promo_price'] > 0 && $item['promo_on'] < time() && $item['promo_off'] > time()) $trans_price = $item['promo_price']*$item['s_num'];
                else $trans_price = $item["official_price"]*$item['s_num'];
            }else{
                $trans_price+=$trans_price;
            }
            foreach ($item as $k=>$v) {
                if ($k=="pro_id")$pro_id=$pro_id.",".$v;
            }
        }
        /*对服务费和运费相加*/
        $trans_price=$trans_price+$data['delivery']+$data['insurance'];

        $trans_data=array(
            "trans_price"=>$trans_price,
            "uid"=>session("tp1611_user.id"),
            "address_id"=>$data['address_id'],
            "pro_id"=>ltrim($pro_id,","),
            "order_id"=>$strOrderId
        );
        $b=M("trans_order")->add($trans_data);
        M("cart")->where(array("order_id"=>array("in",$strOrderId)))->setField("status",1);
        $this->ajaxReturn(getReturn($b));
	}

    /*立即购买生成订单*/
    public function getOrder()
    {

        $pro=M("product");
        /*判断用户是否登陆*/
        if (!session("?tp1611_user")){
            $this->ajaxReturn(array("status"=>"u","info"=>"您还未登陆"));die;
        }
        $quantity=I("post.quantity");

        $pro_id=I("post.pro_id");
        /*查询该产品的信息*/
        $info=$pro->find($pro_id);
        /*查询产品库存量*/
//        if($quantity>$info['goods_number']){
//            $this->ajaxReturn(array("status"=>"n","info"=>"请选择正确的数字"));
//            die;
//        }
        $cart=M("cart");
        $order=M("order");
        /*新建订单*/
        /*查询系列的cat_id*/
        $cat_name = M("series")->join("left join tp_category on tp_series.cat_id=tp_category.id")->where("tp_series.id=" . $info['series_id'])->getField("tp_category.name");

        $sum = $order->count();
        /*补充订单号长度*/
        $str = substr(rand(10000, 99999), 0, 5 - strlen($sum));
        /*整理订单信息*/
        $order_data = array(
            "user_id" => session("tp1611_user.id"),
            "original_price" => $info['official_price'],
            "cat_name" => $cat_name,
            "order_sn" => date("Ymdh") . $str . $sum,

        );
        $order_data["order_date"] = time();
        $order_b = $order->add($order_data);
        if (!$order_b) {
            $this->ajaxReturn(array("status" => "n", "info" => "加入失败"));
            die;
        }
        /*整理购物车信息*/
        $data_cart = array(
            "pro_id" => $pro_id,
            "order_id" => $order_b,
            "s_num" => $quantity
        );
        $cart_b = $cart->add($data_cart);
        $url=U("confirm_order");
        echo <<<EOT
        
        <form action='$url' method='post' name='form1' style='display:none'>
        <input type='hidden' name='order_id' value='$order_b'>
        </form>
        <script>
        document.form1.submit();
</script>
EOT;

    }

    /*购买记录*/
    public function purchase_record()
    {
        $db=M("cart");
        /*三表连接查询初始化订单*/

        $count      = $db->where('status=1')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig("prev","上一页");
        $Page->setConfig("next","下一页");
        $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性

        $cart_list = $db->field("tp_cart.*,tp_product.*,tp_order.order_sn,tp_order.order_date,tp_order.original_price")->join("left join tp_product on tp_cart.pro_id=tp_product.id left join tp_order on tp_order.id=tp_cart.order_id")->where('tp_cart.status=1')->order("tp_order.order_date desc")->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('page',$show);// 赋值分页输出
        $this->assign("cart_list",$cart_list);

        $this->display();
    }

}
