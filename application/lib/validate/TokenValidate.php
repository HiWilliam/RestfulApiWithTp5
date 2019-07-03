<?php

namespace app\lib\validate;

class TokenValidate  extends BaseValidate
{
    protected $rule = [
        'code' => "require|notEmpty"
    ];
}