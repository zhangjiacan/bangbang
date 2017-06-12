<?php 	
namespace Home\Controller;
use Think\Controller;
class FlowController extends Controller {
    public function add(){
      $goods = D('goods');
      if(!$goodsinfo = $goods->find(I('get.goods_id'))){
        $this->redirect('/');
        exit();
      }
      $car = \Home\Tool\CarTool::getIns();
      $car->add($goodsinfo['goods_id'],$goodsinfo['goods_name'],$goodsinfo['shop_price']);
      //$car->clear();
      //var_dump($car->items());
      $this->assign('che',$car->items());
      $this->display('checkout');
    }

    public function done(){
      $car = \Home\Tool\CarTool::getIns();
      $oi = M('ordinfo');
      $oi->create();//接受POST表单数据
      $oi->ord_sn = $ord_sn = date('Ymd').rand(100000,999999);
      $oi->user_id = cookie('user_id')?cookie('user_id'):0;
      $oi->money = $car->calcMoney();
      $oi->ordtime = time();
      //echo $oi->add()?'ok':'fail';
      //echo 123;
      if($ordinfo_id = $oi->add()){
        $og = M('ordgoods');
        foreach($car->items() as $k=>$v){//array(15=>array())
          $row = array();
          $row['goods_id'] = $k;
          $row['goods_name'] = $v['goods_name'];
          $row['shop_price'] = $v['shop_price'];
          $row['goods_num'] = $v['num'];
          $row['ordinfo_id'] = $ordinfo_id;
          $data[] = $row;
        }
        if($og->addAll($data)){
          $this->assign('ord_sn',$ord_sn);
          $this->assign('money',$car->calcMoney());
          //$this->assign('');
          $this->display();
        }
      }
    }

    public function pay(){
      //当消费者在商户端生成最终订单的时候，将订单中的v_amount v_moneytype v_oid v_mid v_url key六个参数的value值拼成一个无间隔的字符串(顺序不要改变)。参数key是商户的MD5密钥（该密匙可在登陆商户管理界面后自行更改。）
      $row = array();
      $row['v_amount'] = 0.01;
      $row['v_moneytype'] = 'CNY';
      $row['v_oid'] = date('Ymd').mt_rand(10000,99999);
      $row['v_mid'] = '1009005';
      $row['v_url'] = 'http://127.0.0.1/huipay.php';
      $row['key'] = '12#*&dklsK*&LKFDKLSF';
      $row['v_md5info'] = strtoupper(md5($row['v_amount'].$row['v_moneytype'].$row['v_oid'].$row['v_mid'].$row['v_url'].$row['key']));
    //echo $row['v_md5info'];
     //$this->assign('')
     $this->assign('pay',$row);
     $this->display('pay');
    }
}