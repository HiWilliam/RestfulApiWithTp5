<?php

namespace app\lib\exception;

class TokenException extends BaseException
{
    public $code = 404;

    public $msg = "获取token失败";

    public $errorCode = 20000;
}