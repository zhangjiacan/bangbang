<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function login(){
        if(!IS_POST){
            $this->display();  
        }else{
            if($this->checkyzm(I('post.yzm'))){
               $user = D('User')->where('username='.'"'.I('post.username').'"')->find();

                if(md5(I('post.password').$user['salt']) === $user['password']){
                    //echo "123";
                    cookie('username',$user['username']);
                    cookie('coode',md5($user['username'].C('SALT')));
                    $this->redirect('/');
                }else{
                    echo "密码或者用户名不对";
                }
            }
        }  
    }

    public function logout(){
        cookie('username',null);
        cookie('coode',null);
        $this->redirect('/');
    }
    public function yzm(){
    	$Verify = new \Think\Verify();
    	$Verify->imageW = 140;//设置宽度
    	$Verify->imageH = 40;//设置高度
    	$Verify->fontSize = 18;
    	$Verify->length = 4;
    	$Verify->useNoise = false;
    	$Verify->useCurve = false;
		$Verify->entry();
    }

    public function checkyzm(){
    	$Verify = new \Think\Verify();
    	if($Verify->check(I('post.yzm'))){
    		return true;
    	}else{
    		echo "验证码错误";
            exit();
    	}
    }

    public function reg(){
        if(!IS_POST){
            $this->display();
        }else{
            $model = D('User');
            if(!$model->create()){
                echo $model->getError();
            }else{
                $yan = $this->yan();

                $model->password = md5($model->password.$yan);

                $model->salt = $yan;

                if($model->add()){
                   //$this->success('')
                    $this->redirect('Home/User/login');
                }
            }
        }
    }

    public function yan(){
        return mt_rand(1000,9999);
    }
}