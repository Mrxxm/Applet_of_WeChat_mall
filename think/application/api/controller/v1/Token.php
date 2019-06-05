<?php
/**
 * Created by PhpStorm.
 * User: xuxiaomeng
 * Date: 2019/2/10
 * Time: 下午8:15
 */

namespace app\api\controller\v1;


use app\api\service\AppToken;
use app\api\validate\AppTokenGet;
use app\api\validate\TokenGet;
use app\api\service\UserToken;
use app\lib\exception\TokenException;
use app\api\service\Token as TokenServie;

class Token
{
    public function getToken($code = '')
    {
        // 1.验证code
        (new TokenGet())->goCheck();

        $serviceUT = new UserToken($code);

        // 2.service获取Token
        $token = $serviceUT->get();

        // 3.返回到客户端
        return [
            'token' => $token
        ];
    }

    // 校验令牌
    public function verifyToken($token = '')
    {
        if (!$token) {
            throw new TokenException([
                'token不允许为空'
            ]);
        }
        $valid = TokenServie::verifyToken($token);
        return [
            'isValid' => $valid
        ];
    }

    /**
     * cms使用
     * 第三方应用获取令牌
     * @url /app_token?
     * @POST ac=:账号 se=:密码
     */
    public function getAppToken($ac='', $se='')
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET');
        (new AppTokenGet())->goCheck();
        $app = new AppToken();
        $token = $app->get($ac, $se);
        return [
            'token' => $token
        ];
    }
}