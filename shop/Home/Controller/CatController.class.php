<?php 	
namespace Home\Controller;
use Think\Controller;
class CatController extends Controller {
    public function cat(){
      if(I('get.cat_id')){
        $cat_id = I('get.cat_id');
        //历史浏览
        //print_r(session('history'));
        $this->assign('his',array_reverse(session('history')));
        $cats = D('goods')->field('goods_id,goods_name,shop_price,goods_img,market_price')->where("cat_id=$cat_id")->select();
        //var_dump($cats);
        $this->assign('cat_goods',$cats);
        $this->display();
      }else{
        $keywords = I('get.keywords');
        $goodsmodel = M('goods');
        $con['goods_name'] = array('like',"%{$keywords}%");
        $cats = $goodsmodel->where($con)->select();
        $this->assign('cat_goods',$cats);
        $this->display();
      }
   		
    }
}




