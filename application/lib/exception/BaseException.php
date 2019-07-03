<?php

namespace app\lib\exception;

use \Exception;

class BaseException extends Exception
{
    public $code;

    public $msg;

    public $errorCode;

    public function __construct($param = [])
    {   
        if(!is_array($param) || empty($param))
            return;
        if(array_key_exists("code", $param))
            $this->code = $param['code'];

        if(array_key_exists("msg", $param))
            $this->msg = $param['msg'];

        if(array_key_exists("errorCode", $param))
            $this->errorCode = $param['errorCode'];
    }
}