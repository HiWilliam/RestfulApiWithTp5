<?php

namespace app\api\service;

use app\api\common\Msg;

class UserToken extends UserToken
{
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    public function __construct($code)
    {
        $this->wxAppId = config("wechat.wxAppId");
        $this->wxAppSecret = config("wechar.wxAppSecret");
        $this->wxLoginUrl = sprintf(config("wechat.wxLoginUrl"),$this->wxAppId,$this->wxAppSecret,$code);
    }
    /**
     * @description: 获取token
     * curl,调用wx官方api获取openid
     * 存入或者更新用户表 openid字段
     * 拼接token
     * @return: wx token
     */
    public function getUserToken()
    {
        $result = http_get($this->wxLoginUrl, "post");
        if(isset($result['errrcode']))
            Msg::sendMsg("获取token错误");
        $user_id = User::getIdForToken($result['openid']);
        if($user_id)
            TokenService::makeToken($user_id, $result['openid'])
    }
}