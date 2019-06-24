<?php

namespace app\api\common;

use think\Request;
// use think\Controller;

class Api{

    protected $request;
    /*
    *   request对象的注入
    *   登录状态，权限等判断和处理
    *   前置操作的处理
    */
    public function __construct(Request $request = null)
    {
        //注入request对象，使得所有继承了api类的控制器都可以调用request，来获取请求参数
        $this->request =  is_null($request) ? Request::instance() : $request;

        $this->_initialize();

    }

    protected function _initialize()
    {
        echo "this is a test method";
    }
}