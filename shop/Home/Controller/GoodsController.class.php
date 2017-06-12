<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function goods(){
        //评论相关
        $goods = D('goods'); 
        //$row = array(8=>array(goods_name=>chuizi,shop_price=>555,8));


    	$goods_info = D('goods')->find(I('get.goods_id'));
        $goods_comments = $goods->relationGet('comment');
        //var_dump($goods_comments);
        //分配的是评论的
        $this->assign('goods_c',$goods_comments);

        if($goods_info){
            $this->history($goods_info);
        }
        
    	//print_r($this->mbx($goods_info['cat_id']));
    	$this->assign('mbx',$this->mbx($goods_info['cat_id']));
    	$this->assign('goods',$goods_info);
        $this->display();
    }

    public function history($goods_info){

        $row = session('?history')?session('history'):array();
        $g = array();//$g = array(goods_name=>chuizi,shop_price=>555,8)
        $g['goods_name'] = $goods_info['goods_name'];
        $g['shop_price'] = $goods_info['shop_price'];
        $g['goods_id'] = $goods_info['goods_id'];
        $row[$goods_info['goods_id']] =$g;  //array()

        if(count($row) >7){
            $key = key($row);
            unset($row[$key]);
        }

        session('history',$row);

        //$a = array('laowang','laoliu'); unset($a[0])
    }

    public function mbx($cat_id){
    	$row = D('cat')->find($cat_id);
    	$tree[] = $row;

    	if($row['parent_id']>0){
    		$row = D('cat')->find($row['parent_id']);
    		$tree[] = $row;
    	}

    	return array_reverse($tree);
    }

    public function addComment(){
        //var_dump($_POST);
        if(D('comment')->add($_POST)){
            $this->success('添加成功');
        }
    }
}