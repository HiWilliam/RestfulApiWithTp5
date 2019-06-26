<?php

namespace app\api\service;

use app\api\common\Msg;

class UserToken extends Token
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
        $result = http_get($this->wxLoginUrl);
        if(empty($result))
            Msg::sendMsg("获取session_key和openid错误,微信内部错误");
        if(isset($result['errrcode']))
            Msg::sendMsg("获取token错误");
        $user_id = User::getIdForToken($result['openid']);
        if(!$user_id)
            Msg::sendMsg("openid插入或更新失败");
        $cacheValue = $this->prepareCache($result);

        
        
    }

    private function prepareCache($wxresult)
    {
        $cacheValue = $wxresult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = Scope::UserScope;
        return $cacheValue;
    }

    private function saveToCache($cacheValue)
    {
        // 生成token口令
        $key = self::generateToken();
        
        $cacheValue = json_encode($cacheValue);

        $expireTime = config("token.token_expire_time");

        $res = cache($key, $cacheValue, $expireTime);

        if(!$res)
            Msg::send(" 服务器异常");

        return $key;
    }
}