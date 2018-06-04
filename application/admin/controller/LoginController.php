<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17
 * Time: 11:15
 */

namespace app\admin\controller;
use app\common\model\User;
use think\Session;

class LoginController extends BaseController
{
    public function index(){
        return $this->fetch();
    }


    public function register(){
        return $this->fetch();
    }

    public function create(){
        $username   = input('post.username');
        $email      = input('post.email');
        $password   = input('post.password');
        $repassword = input('post.repassword');

        if(empty($username)||empty($email)||empty($password)||empty($repassword)){
           $this->error('请提交正确的注册信息');
        }
        if(trim($password) !== trim($repassword)){
            $this->error('两次的输入的密码不一致');
        }
        $user = new User();

        $result = $user->data([
            'username' => $username,
            'password' => md5($password),
            'email'   => $email,
        ])->save();

        if($result){
            $this->success('注册成功','login/index');
        }else{
            echo "注册失败";
        }
    }

    public function loginAction(){

        $username = input('post.username');

        $password = input('post.password');

        if(empty($username)||empty($password)){

            $this->error('用户名和密码不能为空');
        }

        $password = md5($password);

        $userlist = new User();

        $row = $userlist->where("username='$username' AND password='$password'")->find();

        if(empty($row)){
            $this->error('用户名或密码错误');
        }

        Session::set('username',$row['username']);
        Session::set('uid',$row['id']);
        Session::set('islogin',1);

        $this->success('登录成功','admin/index/index');
    }

}