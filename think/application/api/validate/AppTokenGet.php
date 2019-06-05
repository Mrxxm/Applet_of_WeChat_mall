<?php
/**
 * Created by PhpStorm.
 * User: xuxiaomeng
 * Date: 2019/5/22
 * Time: 下午3:44
 */

namespace app\api\validate;


class AppTokenGet extends BaseValidate
{
    protected $rule = [
        'ac' => 'require|isNotEmpty',
        'se' => 'require|isNotEmpty'
    ];
}