<?php 
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model{
	protected $_validate = array(
		//array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间])
		array('goods_name','3,12','必须是3到12位的字符串',1,'length',3),
		array('goods_sn','','抱歉,已存在,请重新填写',1,'unique')
	);

	protected $_auto = array(
		array('add_time','time',1,'function'),
		array('last_update','time',2,'function')
	);

	protected $insertFields = "goods_id,goods_sn,cat_id,goods_name,shop_price,market_price,goods_number,click_count,goods_weight,goods_brief,goods_desc,thumb_img,ori_img,goods_img,is_on_sale,is_delete,is_best,is_new,is_hot,add_time";
		
	
}
