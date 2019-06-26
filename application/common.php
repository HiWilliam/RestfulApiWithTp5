<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
//curl 获取 openid
function http_get($url)
{
    // 初始化curl会话
    $curl = curl_init();
    //设置curl传输地址
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置curl执行结果以文件流的形式返回 而非直接输出
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //检查服务器公用名
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    //设置发起连接前等待时间
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    //执行会话，并获取结果
    $result = curl_exec($curl);
    //关闭curl会话
    curl_close($curl);

    return $result;
}

function getRandChars($length)
{
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $max = strlen($strPol)-1;
    for($i = 0; $i < $length; $i++){
        $str .= $strPol[rand(0, $max)];
    }
    return $str;
}