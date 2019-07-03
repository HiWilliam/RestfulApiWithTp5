<?php

namespace app\api\common;

use think\facade\Config;
use think\facade\Response;
use think\exception\HttpResponseException;

trait Msg{

    public function sendMsg( $msg = '', $data = [], $header = [],$code = 200, $type = 'json')
    {
        http_response_code($code);
       
        $data = is_array($data) ? $data : ['info' => $data] ;
        foreach($header as $k => $v){
            if($v)
                header($k);
            else
                header($k.":".$v);
        }
        $type = $type ? $type : "json";
        
        // Config::set("default_return_type", $type);
        $res = [
            'msg'   => $msg,
            'data'  => $data,
            'time'  => $this->request->server("REQUEST_TIME")
        ];
        $response = Response::create($res,$type)->header($header);
        throw new HttpResponseException($response);
        // exit(json_encode($res,JSON_UNESCAPED_UNICODE));
    }

    public function success($data = [])
    {

        $this->sendMsg("获取成功", $data);
    }
}