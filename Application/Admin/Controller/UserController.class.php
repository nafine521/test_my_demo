<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2017/1/18
 * Time: 1:30
 */

namespace Admin\Controller;

use Think\Controller;
class UserController extends BaseController
{
    /*会员列表管理*/
    public function member()
    {
        $db=M("user");
        $list=$db->select();
        $this->assign("list",$list);
        $this->display();
    }
    /*会员添加修改管理*/
    public function memberAdd()
    {
        if (IS_POST){
            $data=I("post.");
            $data['password']=md5($data['password']);
            $data["address"]=$data['prov'].$data['city'].$data['dist'];
            $b=saveAdd("user",$data);
            $this->ajaxReturn(getReturn($b));
        }else{
            $id=I("id");
            $info=M("user")->find($id);
            $this->assign("info",$info);
            $this->display();
        }

    }
    /*查看会员交易的订单*/
    public function order()
    {

        /*查询订单用户的信息*/

        $trans_list=M("trans_order")->field("tp_trans_order.*,tp_address.detail_address,tp_user.compellation,tp_user.img")->join("left join tp_user on tp_user.id=tp_trans_order.uid left join tp_address on tp_address.id=tp_trans_order.address_id")->select();

        $this->assign("trans_list",$trans_list);
        $this->display();
    }
    /*订单详情*/
    public function order_detail(){
        $pro_id=I("pro_id");
        $order_id=I("order_id");
        $where=array(
            "tp_cart.pro_id"=>array("in",$pro_id),
            "tp_cart.order_id"=>array("in",$order_id)
        );
        /*三表连接查询初始化订单*/
        $cart_list=M("cart")->field("tp_cart.*,tp_product.img,tp_order.order_sn,tp_order.order_date,tp_product.name,tp_order.original_price")->join("left join tp_product on tp_cart.pro_id=tp_product.id left join tp_order on tp_order.id=tp_cart.order_id")->where($where)->select();

        $this->assign("cart_list",$cart_list);
        $this->display();
    }
    /*会员导航列表*/
    public function memberNav()
    {
        $db=M("member");
        $list=$db->select();
        $this->assign("list",$list);
        $this->display();

    }
    /*会员导航管理*/
    public function memberNavAdd()
    {
        if (IS_POST){
            $data=I("post.");

            $b=saveAdd("member",$data);
            $this->ajaxReturn(getReturn($b));
        }else{
            $list=M("member")->select();
            $this->assign("list",$list);
            $id=I("id");
            foreach ($list as $item) {
                if ($item['id']==$id)$info=$item;
            }
            $this->assign("info",$info);
            $this->display();
        }
    }
}