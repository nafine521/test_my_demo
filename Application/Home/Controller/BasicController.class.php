<?php
namespace Home\Controller;
use Think\Controller;
class BasicController extends PublicController
{
	/*初始化用户数据*/
	public function _initialize()
	{
		parent::_initialize();
		/*判断用户登录session*/
		if (cookie("1611_user")) {
            if(!session("?tp1611_user")){
                session("tp1611_user",unserialize(cookie("1611_user")));
            }
        }elseif(!session("?tp1611_user")){
            $this->error("请先登录");
        }
		/*查询用户*/
		$id=session("tp1611_user.id");
		$info=M("user")->find($id);
		// 计算资料完整度
		$info_count=0;
		$empty_count=0;
		array_map(function($v)use(&$info_count,&$empty_count){
			$info_count++;
			if (empty($v)) $empty_count++;
		}, $info);
		$finish=($info_count-$empty_count)/$info_count < ($info_count-7)/$info_count;
		$this->assign("finish",$finish);
		$this->assign("user_info",$info);

		/*会员中心导航*/
		$memberNav=M("member")->select();
		$this->assign("memberNav",tree($memberNav));

	}
	/*上传头像*/
	 public function uploadImg()
     {

        $path=I("get.path");

        $info=upload($_FILES['imgFile'],$path);

        $tmp="/Uploads/".$info['savepath'].$info['savename'];


        if(!$info) {
            // 上传错误提示错误信息
            $this->ajaxReturn(array("error"=>1,"info"=>$info->getError()));
        }else{
            // 上传成功
            $this->ajaxReturn(array("error"=>0,"url"=>$tmp));
        }
	}
}
