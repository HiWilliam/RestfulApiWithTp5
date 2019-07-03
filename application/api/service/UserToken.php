<?php

namespace app\api\service;

use app\api\common\Msg;
use app\lib\exception\TokenException;
use app\api\model\User;
use app\lib\enum\Scope;
class UserToken extends Token
{
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    public function __construct($code)
    {
        $this->wxAppId = config("wechat.wxAppId");
        $this->wxAppSecret = config("wechat.wxAppSecret");
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
        $wxResult = json_decode($result, true);
        if(empty($result))
            throw new TokenException([
                'msg' => "获取seesion、openid失败",
                'code' => 500,
                'errorCode' => 20002
            ]);
        if(isset($wxResult['errcode']))
            throw new TokenException(); 
        $user_id = User::getIdForToken($wxResult['openid']);
        if(!$user_id)
            throw new TokenException(['code' => 500]);
        $cacheValue = $this->prepareCache($user_id, $wxResult);  

        $token = $this->saveToCache($cacheValue);

        return $token;
    }

    private function prepareCache($user_id, $wxresult)
    {
        $cacheValue['wxresult'] = $wxresult;
        $cacheValue['uid'] = $user_id;
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
            Msg::send("服务器异常");

        return $key;
    }

    private function getOpenIdByKey()
    {
        
    }
}