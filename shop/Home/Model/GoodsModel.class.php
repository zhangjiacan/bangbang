<?php 
namespace Home\Model;
use Think\Model\RelationModel;

class GoodsModel extends RelationModel{
	protected $_link = array(
		'comment'=>self::HAS_MANY,
	);
}
