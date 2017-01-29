<?php
namespace Admin\Controller;
use Think\Controller;
class FeedbackController extends BaseController
{
	/*评论列表*/
	public function feedback()
	{
		$list=M("feedback")->select();
		$this->assign("list",$list);
		$this->display();
	}
	/*用户信息*/
    public function userShow()
    {
        $id=I("id");
        $info=M("user")->find($id);
        $this->assign("info",$info);
        $this->display();
	}
}