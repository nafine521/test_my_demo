<?php
/**
 * Created by PhpStorm.
 * User: ethl
 * Date: 2016/12/28
 * Time: 20:44
 */

namespace Home\Controller;
use Home\Controller\PublicController;
//use Think\Controller;

class ContactController extends PublicController
{
    public function contact()
    {
      if (IS_AJAX) {
        $data=I("post.");
        $data['pubdate']=time();
        $b=saveAdd("feedback",$data);
        $this->ajaxReturn(getReturn($b));
      }else {
        $this->display();
      }

    }
}
