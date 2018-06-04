<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17
 * Time: 11:39
 */

namespace app\common\traits;
use think\Session;

trait Front
{
    protected $isLogin = false;

    protected function _loginCheck(){

        if(!((session::has('isLogin') && session::get('isLogin')==1) ? true : false)){
            $this->isLogin = false;
            $this->redirect('');
        }

    }

    protected function _isLogin(){
        return uid() ? 1 : 0;
    }


    protected function loginView(){
        return $this->assign('is_login',$this->_isLogin);
    }

    protected function _out(){
        Session::delete('username');
        Session::delete('uid');
        Session::delete('is_login');
    }

}