<?php 
namespace Home\Model;
use Think\Model;

class UserModel extends Model{
	protected $_validate = array(
		array('username','3,12','用户名必须3到12位',1,'length',3),
		array('email','email','邮箱不合法',1,'regex',3),
		array('password','6,16','密码长度必须6到16位',1,'length',3),
		array('confirm_password','password','两次密码不一致',1,'confirm',3)
	);
}