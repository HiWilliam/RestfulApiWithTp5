<?php
/*
 * @Description: In User Settings Edit
 * @Author: your name
 * @Date: 2019-06-30 09:07:56
 * @LastEditTime: 2019-07-03 17:12:29
 * @LastEditors: Please set LastEditors
 */

namespace app\api\controller\v1;

use app\api\common\Api;
use app\api\service\UserToken;

class Token extends Api{
    /**
     * @description: 获取token
     * @param {type} code 
     * @return: token
     */
    public function getToken()
    {
        
        $code = $this->request->param('code');
        $result = $this->validate("TokenValidate", $code);
        $user_token = new UserToken($code);
        $token = $user_token->getUserToken();
        if($token)
            $this->success($token);
        //验证code rquire,not empty,
    }
}