<?php

namespace app\api\common;

use app\api\common\Msg;
use think\facade\Request;
class OAuth {
    use Msg;

    /**
     * @description:accesToken存储前缀 
     * @var String  
     */
    protected static $accessTokenPrefix = "accessToken_";

    /**
     * @description:过期时间 
     * @var int 
     */
    protected $expireTime = 7200;
    
    public static function getClient()
    {
        $header = Request::header();
        return $header;
    }

}