<?php

namespace app\lib\validate;

use think\Validate;
use think\facade\Request;
use app\lib\exception\ValidateException;
use app\lib\exception\BaseException;

class BaseValidate extends Validate
{
    /**
     * @description:验证方法 
     * @param {array} 要验证的参数
     * @return: boolean
     */
    public function goCheck($data = [], $isBatch = false)
    {
        $data = $data ? Request::instance()->param() : $data;
        
        $result = $this->batch($isBatch)->check($data);

        if($result)
            return true;
        else
            throw new BaseException([
                'msg' => $this->getError()
            ]);
    }

    protected function notEmpty($value, $rule, $data = [])
    {
        if($value!= "")
            return true;
        else
            throw new ValidateException();
    }
}