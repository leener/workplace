<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 17:13
 */

namespace app\index\controller;
use app\common\controller\BaseController;

class IndexController extends BaseController
{
    public function index(){
        return $this->fetch();
    }
}