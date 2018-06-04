<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17
 * Time: 17:27
 */

namespace app\admin\controller;


class IndexController extends BaseController
{
    public function index(){
        return $this->fetch();
    }
}