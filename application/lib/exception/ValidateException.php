<?php

namespace app\lib\exception;

use app\lib\exception\BaseException;

class ValidateException extends BaseException
{
    public $code = 400;

    public $msg  = "验证错误";

    public $errorCode = 10000;

      
}