<?php
namespace Admin\Controller;
use Think\Controller;
class CatController extends Controller {
    public function add(){
        $catModel = D('Cat');
        if(!$catModel->create()){
            $this->display('cateadd');   
        }else{
            //var_dump($_POST);
            if($cat_id = $catModel->add()){
                $model = D('attr');
                //echo "<pre>";
                //print_r($_POST);
                
               $value_size = implode(',',$_POST['attr_value']);

               $attr_name = $_POST['attr_name'];
               $attr_key = $_POST['attr_key'];
               $info[] = array('cat_id'=>$cat_id,'attr_value'=>$value_size,'attr_name'=>$attr_name,'attr_key'=>$attr_key);
               $model->addAll($info);
            }

           
        }
    	
    }

    public function catelist(){
        $catModel = D('Cat');
        $cat = S('catlist');
        if($cat == false){
            $catlist = $catModel->getTree();
            S('catlist',$catlist,20); 
        }else{
            echo "这是缓存出来的数据";
            $catlist = $cat;
        }
        


        //$catlist = $catModel->select();
        //var_dump($catlist);
        $this->assign('list',$catlist);
    	$this->display();
    }

    public function catedit(){
        $catModel = D('Cat');
        if(!IS_POST){
           $cat_id = I('cat_id');
            //echo $cat_id;
            $catinfo =$catModel->find($cat_id);
            $this->assign('info',$catinfo);
            $this->display(); 
        }else{
            $catModel->where('cat_id='.$_POST['cat_id'])->save($_POST);
        }
        	
    }

    public function del(){ 	
        $catModel = D('cat');
        $cat_id = I('get.cat_id');
        $catModel->delete($cat_id);
        $this->success('删除成功了','',3);
    }
}