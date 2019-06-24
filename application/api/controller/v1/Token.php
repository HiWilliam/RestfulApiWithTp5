<?php

namespace app\api\controller\v1;

use app\api\common\Api;
use app\api\common\Msg;

class Token extends Api{
    use Msg;

    public function getAdminById()
    {
        $data = $this->request->param();
        dump($data);
    }
    public function index(){
        $this->sendMsg("返回成功",$this->request->param('route'));
    }
    /**
     * @获取请求方法
     * @return: 
     */
    public function getAction()
    {
        dump($this->request->controller());
    }

}