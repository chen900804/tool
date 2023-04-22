<?php

namespace Zvn\Tools\Sms\Interface;

use Psr\Http\Message\ResponseInterface;

interface  SmsInterface
{
    /**
     * 发送验证码短信
     * @return ResponseInterface
     */
    public function sendCaptcha(): ResponseInterface;

    /**
     * 发送开通VIP短信
     * @return ResponseInterface
     */
    public function sendVip(): ResponseInterface;

    /**
     * 发送充值成功短信
     * @return ResponseInterface
     */
    public function sendPay(): ResponseInterface;
}