<?php
/**
 * Created by PhpStorm.
 * User: xuxiaomeng
 * Date: 2019/5/22
 * Time: 下午5:04
 */

namespace app\api\service;


use Exception;

class WxMessage
{
    private $sendUrl = "";
    private $touser;
    //不让子类控制颜色
    private $color = 'black';

    protected $tplID;
    protected $page;
    protected $formID;
    protected $data;
    protected $emphasisKeyWord;

    function __construct()
    {
        $this->sendUrl = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?" .
            "access_token=%s";
        $accessToken = new AccessToken();
        $token = $accessToken->get();
        $this->sendUrl = sprintf($this->sendUrl, $token);
    }

    // 开发工具中拉起的微信支付prepay_id是无效的，需要在真机上拉起支付
    protected function sendMessage($openID)
    {
        $data = [
            'touser' => $openID,
            'template_id' => $this->tplID,
            'page' => $this->page,
            'form_id' => $this->formID,
            'data' => $this->data,
//            'color' => $this->color,
            'emphasis_keyword' => $this->emphasisKeyWord
        ];
        $result = curl_post($this->sendUrl, $data);
        $result = json_decode($result, true);
        if ($result['errcode'] == 0) {
            return true;
        } else {
            throw new Exception('模板消息发送失败,  ' . $result['errmsg']);
        }
    }
}