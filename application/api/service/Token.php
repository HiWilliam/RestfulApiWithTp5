<?php

namespace app\api\service;

class Token
{
    public static function generateToken()
    {
        // 获取32位随机字符串
        $randChars = getRandChars(32);
        // 时间戳
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //盐    
        $salt = config("token.token_salt");

        return md5($randChars.$timestamp.$salt);
    }

}