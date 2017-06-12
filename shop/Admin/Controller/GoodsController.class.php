<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
	public function goodsadd(){
		if(!IS_POST){
			$this->display();
		}else{
			//var_dump($_POST);
			$goodsModel = D('goods');
			$upload = new \Think\Upload();
            $upload->exts = array('jpg','gif','png','jpeg');
            $upload->rootPath = './Public/up/';
            //var_dump($upload->upload());
           	$info =$upload->upload();
           	if(!$info){
           		var_dump($upload->getError());
           	}else{
           		//原始图片上传
           		//var_dump($info);
           		$_POST['goods_img'] = '/Public/up/'.$info['goods_img']['savepath'].$info['goods_img']['savename'];

           		$path = './Public/up/'.$info['goods_img']['savepath'].$info['goods_img']['savename'];
           		//缩略图
           		$img = new \Think\Image();
           		//这是open打开的路径
           		
           		$img->open($path);
           		//保存到数据库的路径
           		$thumb_path = '/Public/up/thumb/'.$info['goods_img']['savename'];

           		//实际的图片路径
           		$thumb_path1 = './Public/up/thumb/'.$info['goods_img']['savename'];
           		//echo $thumb_path1;

           		$img->thumb(208, 208)->save($thumb_path);
           		//var_dump($info2);
           		//exit();

           		$_POST['thumb_img'] = $thumb_path;

           	}
           	if(!$goodsModel->create()){
					echo $goodsModel->getError();
					exit();
			}else{
					if($goods_id = $goodsModel->add()){
						echo "<pre>";
						var_dump($_POST);
						$model = M('goods_attr');
						$model->goods_id = $goods_id;
						$model->attr_key = $_POST['attr_key'];
						$model->attr_value = $_POST['size'];
						$model->add();
					}
			}	
		}
	}

	public function goodslist(){
		$model = D('goods');
		$count = $model->count();
		$page = new \Think\Page($count,10);
		$show = $page->show();


		$goods = $model->field('goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_best,is_new,is_hot,is_delete,goods_number')->order('goods_id desc')->limit($page->firstRow.','.$page->listRows)->select();
		//print_r($goods);\
		$this->assign('page',$show);//页码
		$this->assign('goods',$goods);//数据
		$this->display();
	}

	public function del(){
		$model = D('goods');
		$res = $model->delete(I('get.goods_id'));
		if($res){
			$this->redirect('Admin/Goods/goodslist','',3,'页面跳转中...');
		}
	}
}