<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2016/12/22
 * Time: 22:26
 */

namespace Home\Controller;
use Think\Controller;

class PublicController extends Controller
{
    public function  _initialize(){
    	//初始化头部导航数据
        $where=array(
            "is_show"=>1,
            "local"=>0,
        );
        $nav=M("nav")->where($where)->order("sort")->select();
        $this->assign("navList",$nav);
        /*当前样式*/
        $controller=CONTROLLER_NAME;
        $this->assign("action",$controller);
        /*品牌介绍*/
        $info=F("brand");
        $info['brand']['content']=htmlspecialchars_decode($info['brand']['content']);
        $info['brand']['description']=htmlspecialchars_decode($info['brand']['description']);
        $this->assign("brand",$info['brand']);
        /*联系我们*/
        $contact=F("basic");
        $this->assign("basic",$contact['basic']);
        $this->assign("contact",$contact['contact']);
        /*快递读取*/

        $this->assign("delivery",$contact['delivery']);
        /*banner图*/
        $banner_where=array(
            "local"=>1,
            "is_show"=>1,
        );
        $banner=M("banner")->where($banner_where)->find();
        $this->assign("banner",$banner);

        /*
        * 初始化侧边导航数据
        */
        $sub_nav_where=array(
            "is_show"=>1,
            "local"=>1,
        );
        $nav=M("nav")->where($sub_nav_where)->order("sort")->select();
        $this->assign("subnavList",$nav);

        /*产品热推*/
        $pro_where=array(
            "promo_price"=>array("gt",0),
            /*"unix_timestamp(now())"=>array("in","tp_product.promo_on,tp_product.promo_off"),*/
            "promo_on"=>array("lt",time()),
            "promo_off"=>array("gt",time()),
        );
        $a=M("product");
        $promo_pro=$a->where($pro_where)->order("pubdate desc")->find();
        $this->assign("promo_pro",$promo_pro);

        //var_dump($_SERVER,$_GET,CONTROLLER_NAME."/".ACTION_NAME);
        /*浏览记录*/
        $pro_url=CONTROLLER_NAME."/".ACTION_NAME;


        if($pro_url=="Product/product_detail"){
            $pro_id=I("get.id");
            $time=time();
            $value=array($pro_id => $time);

            if(!cookie("views")) cookie('views',serialize($value),array("expire"=>3600*7));
            else {
                $result=cookie("views");

                $res=unserialize($result);
                if(strlen($result)>2000){
                    array_shift($res);
                }
                $res[$pro_id]=$time;
                //array_unshift($res,$pro_id=>$time);在开头插入一个元素无法带健 也许可以$res
                cookie("views",serialize($res),array("expire"=>3600*168));
            }
        }
    }
    // 修改值
    public function status()
    {
        $primary=I("post.primary");
        $tableName=I("post.tableName");
        $id=I("post.id");
        $fieldName=I("post.fieldName");
        $fieldVal=I("post.fieldVal");

        $db=M($tableName);
        $where[$primary]=$id;
        if ($tableName=="address" && $fieldName=="status" && $fieldVal==1){
            $db->where("uid=".session("tp1611_user.id"))->setField($fieldName,0);
        }
        $b=$db->where($where)->setField($fieldName,$fieldVal);
        if($b){
            $this->ajaxReturn(array("status"=>"y","info"=>"操作成功"));
        }else{
            $this->ajaxReturn(array("status"=>"n","info"=>"操作失败"));
        }
    }
    /*前台删除*/
    public function comDel(){
        $tableName=I("post.tableName");
        $id=I("post.id");
        $db=M($tableName);
        $where['id']=array("in",rtrim($id,","));
        $b=$db->where($where)->delete();
        if($tableName=="order"){
            $db1=M("cart");
            $db1->where($where)->delete();
        }
        $status=getReturn($b);
        $this->ajaxReturn($status);
    }

    /*搜索*/
    public function search()
    {
        /*搜索初始化*/
        $search_word=I("get.keyword");
        /*查询产品是否有关键字*/
        $search_where = array("name" => array("like", "%$search_word%"));
        $search_info = M("product")->where($search_where)->getField("name");
        if (empty($search_info)) {
             $this->redirect("News/news",array("keyword"=>$search_word));
        }else{
             $this->redirect("Product/product",array("keyword"=>$search_word));
        }

    }

}
