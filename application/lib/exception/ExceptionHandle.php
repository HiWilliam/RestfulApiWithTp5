<?php

namespace app\lib\exception;

use \Exception;
use think\exception\Handle;
use think\facade\Log;
use think\facade\Config;
use app\lib\exception\BaseException;

class ExceptionHandle extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    public function render(Exception $e)
    {
        if($e instanceof BaseException){
            //用户错误
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
            if(Config::get("app_debug"))
                return parent::render($e);
            //服务器错误
            $this->code = 500;
            $this->msg = "服务器错误";
            $this->errorCode = 999;
            $this->recordLog($e);

        }
        $result = [
            'msg' => $this->msg,
            'errorCode' => $this->errorCode,
            'requestUrl' => request()->url()
        ]; 
        return json($result, $this->code);
    }

    private function recordLog(Exception $e)
    {
        Log::init([
            'type' => 'File',
            'path' => '../logs/',
            'level' => ['error']
        ]);
        Log::record($e->getMessage(), 'error');
    }
}