<?php
namespace Home\Controller;
use Think\Controller;
use Home\Tool\XxxTool;
class IndexController extends Controller {
    public function index(){
    	//查询首页所有的栏目,左上角
    	$tree = D('Admin/Cat')->getTree();
    	//print_r($tree);
    	$this->assign('tree',$tree);

    	//热门商品
    	$hot_goods = D('goods')->field('goods_id,goods_name,shop_price,market_price,thumb_img')->where('is_hot=1')->order('goods_id desc')->limit(4)->select();
    	//var_dump($hot_goods);
    	$this->assign('hosts',$hot_goods);
        $this->display();
    }

    public function xx(){
        //var_dump(new \Home\Tool\XxxTool());
        $a = new XxxTool();
        echo $a->ha();
    }
}