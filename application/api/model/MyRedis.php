<?php

namespace app\api\model;

use Redis;

class MyRedis
{
    public static $redis;
    
    public static function getRedis()
    {
        self::$redis = self::$redis instanceof Redis ? $redis : new Redis();
        return self::$redis;
    }
}
