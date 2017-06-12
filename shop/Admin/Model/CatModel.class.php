<?php 
namespace Admin\Model;
use Think\Model;

class CatModel extends Model{
	protected $cats = array();
	public function __construct(){
		parent::__construct();
		$this->cats = $this->cache(true)->select();
	}

	public function getTree($parent_id=0,$lev=0){
		$tree = array();//$tree = array()
		//var_dump($this->cats);
		foreach ($this->cats as $c) {
			if($c['parent_id'] == $parent_id){
				$c['lev'] = $lev;
				$tree[] = $c;
				$tree = array_merge($tree,$this->getTree($c['cat_id'],$lev+1));
			}
		}
		return $tree;
	}		
}
