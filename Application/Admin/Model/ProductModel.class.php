<?php
namespace Admin\Model;
use Think\Model;
class ProductModel extends Model
{
	// 自动验证
	protected $_validate=array(
		// 必须
		array('name','require','产品标题必须填写！'),
		array('series_id','require','请选择所属系列！'), 
		array('capacity','require','请填写产品容量！'),
		array('goods_number','require','请填写商品库存量！'),
		array('official_price','require','请填写官方价格！'),
		array('virtue','require','请填写产品功效！'),
		array('img','require','请上传产品图片！'),
		// 验证字符的类型
		array('capacity','number','产品容量必须是数字！'),
		array('goods_number','number','商品库存量必须是数字！'),
		array('official_nrice','currency','官方价格格式不正确！'),
        array('promo_price','currency','促销价格格式不正确！',2),
		// 验证促销如果填写必须验证日期
		array('promo_on','promo','请选择促销开始时间',0,"callback"),
		array('promo_off','promo','请选择促销结束时间',0,"callback"),
	);
	// 促销勾选时验证促销时间是否填写
	protected function promo($paramete)
	{
		$bool=I("post.promo_price");
		if (empty($bool)) {
			return true;
		}else{
			if(!empty($paramete)){
				return true;
			}else{
				return false;
			}
		}
		
	}

	// 自动完成
	protected $_auto=array(
		array('promo_on',"strtotime",3,"function"),
		array('promo_off',"strtotime",3,"function"),
		array('pubdate',"time",1,"function"),
	);
}