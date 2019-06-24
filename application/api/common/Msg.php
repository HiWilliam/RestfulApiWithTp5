<?php

namespace app\api\common;

trait Msg{

    public function sendMsg( $msg = '', $data = [], $header = [], $code = 200)
    {
        http_response_code($code);
        $res['msg'] = $msg;
        $res['data'] = is_array($data) ? $data : ['info' => $data] ;
        foreach($header as $k => $v){
            if($v)
                header($k);
            else
                header($k.":".$v);
        }
        exit(json_encode($res,JSON_UNESCAPED_UNICODE));
    }
}