<?php
/**
 * Created by PhpStorm.
 * User: xuxiaomeng
 * Date: 2019/5/22
 * Time: 下午3:47
 */

namespace app\api\model;


class ThirdApp extends BaseModel
{
    public static function check($ac, $se)
    {
        $app = self::where('app_id','=',$ac)
            ->where('app_secret', '=',$se)
            ->find();
        return $app;

    }
}