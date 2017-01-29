<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2016/12/28
 * Time: 20:41
 */

namespace Home\Controller;
use Think\Controller;

class ProductController extends PublicController
{
    /*给总记录条数赋值为静态*/
    static private $count ;
    /*产品中心*/
    public function product(){
        $pro = M('product'); // 实例化

        //self::$count      = $pro->count();// 查询满足要求的总记录数

        $Page       = new \Think\Page(self::$count,4);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev',"上一页");
        $Page->setConfig('next',"下一页");
        $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $where=array(
          "tp_product.is_sale"=>1,
          "tp_product.is_trash"=>0,
        );
        /*搜索关键字*/
        $search_word=I("keyword");
        if (!empty($search_word))$where["tp_product.name"]=array("like","%".$search_word."%");

        /*首页传入系列id*/
        $search_series_id=I("series_id");
        if (!empty($search_series_id))$where["tp_product.series_id"]=$search_series_id;

        $list = $pro->field("tp_product.*,tp_series.cat_id")->join("left join tp_series on tp_product.series_id=tp_series.id")->where($where)->order('tp_product.pubdate desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        self::$count      = count($list);// 当有搜索条件筛选进行重新赋值

        /*功效转成数组*/
        foreach ($list as $key=>$value){
            $value['virtue']=explode(",",$value['virtue']);
            $list[$key]=$value;//$value在循环时只是$list的一个复制（副本）
        }


        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

        $this->display();
    }
    //    产品详情
    public function product_detail(){
        $pro = M('product'); // 实例化
        if (IS_POST) {
            /*判断用户是否登陆*/
            if (!session("?tp1611_user")){
                $this->ajaxReturn(array("status"=>"u","info"=>"您还未登陆"));die;
            }
              $quantity=I("post.quantity");

              $pro_id=I("post.pro_id");
              /*查询该产品的信息*/
              $info=$pro->find($pro_id);
              /*查询产品库存量*/
            if($quantity>$info['goods_number']){
                $this->ajaxReturn(array("status"=>"n","info"=>"请选择正确的数字"));
                die;
            }
            /*查询购物车是否存在pro_id*/
            $cart=M("cart");
            /*查询用户总订单*/
            $order=M("order");
            $user_order_id=$order->where("user_id=".session("tp1611_user.id"))->getField("id");

            if ($user_order_id) {
                if (is_array($user_order_id)) {
                    $user_order_id = implode(",", $user_order_id);
                }
                $getcart_where = array(
                    "pro_id" => $info['id'],
                    "status"=>0
                );

                $getCart = $cart->where($getcart_where)->find();

                if (!empty($getCart)) {
                    $setInc = $cart->where($getCart)->setInc("s_num", $quantity);
                    if ($setInc) $this->ajaxReturn(array("status" => "y", "info" => "添加成功"));
                    else $this->ajaxReturn(array("status" => "n", "info" => "请选择正确的数字"));
                    die;
                }
            }

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
                    "order_date" => time()
                );
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
                $this->ajaxReturn(getReturn($cart_b));

        }else{
            $id=I("get.id");
            //判断当前页面get值未收到
            if (empty($id)) {
              $pro_where=array(
              "trash"=>0,
              "is_sale"=>1,
              );
              $info=$pro->where($pro_where)->order("pubdate desc")->find();
            }else{
              $info=$pro->find($id);
            }

            /*查询产品相册*/
            $pro_photo=M("pro_photo")->where("pro_id=".$info['id'])->select();
            /*快递读取*/
            $delivery=F("basic");

            /*产品热推*/
            $pro_where=array(
                "promo_price"=>array("gt",0),
                /*"unix_timestamp(now())"=>array("in","tp_product.promo_on,tp_product.promo_off"),*/
                "promo_on"=>array("lt",time()),
                "promo_off"=>array("gt",time()),
            );

            $promo_pro=$pro->where($pro_where)->order("pubdate desc")->select();
            $this->assign("promo_list",$promo_pro);

            $this->assign("delivery",$delivery['delivery']);
            $this->assign("pro_photo",$pro_photo);
            $this->assign("info",$info);
            $this->display();



      }
    }

}
