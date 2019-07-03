<?php

namespace app\api\model;

use think\Model;

class User extends Model
{
    /**
     * @description: 判断user表是否存在传入参数openid的记录，存在则直接返回该记录主键id，否则插入新的记录并放回新增id
     * @param：  openId
     * @return： uid 
     */
    public static function getIdForToken($openId)
    {
        $user = self::where("openId", $openId)->find();
        $res = $user ? $user : self::create(['openid'=>$openId]);
        return $res->id;
    }
}