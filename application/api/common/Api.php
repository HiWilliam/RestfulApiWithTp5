<?php

namespace app\api\common;

use think\Request;
use app\api\common\Msg;
use \Redis;

class Api{
    use Msg;
    protected $request;
    // 无需token验证
    protected $noToken = [];
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
         //判断当前请求方法是否在请求白名单中
        if(!$this->match($this->noToken)){
           //不在白名单中，取得token比对 是
        //    Token::check();
        }


    }
    // 匹配当前请求是否存在于白名单
    public function match($auths = [])
    {
        //将白名单转为数组
        $auths = is_array($auths) ? $auths : explode(",", $auths);
        // 白名单为空 返回false
        if(!$auths)
            return false;
        // 白名单统一为小写格式
        $auths = array_map("strtolower", $auths);
        // 判断当前请求方法中是否在白名单，或者白名单为*
        if(in_array(strtolower($this->request->action(), $auths)) || in_array("*", $auths)){
            return true;
        }
        return  false;
    }

    public function _empty(){
        $this->sendMsg("不存在".strtolower($this->request->action()));
    }

    public function checkParam($param = [])
    {
        $param = $param ? $param : $this->request->param();
    }

}