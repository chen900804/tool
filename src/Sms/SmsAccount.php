<?php

namespace Zvn\Tools\Sms;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Zvn\Tools\Exceptions\HttpToolsException;
use Zvn\Tools\Sms\Interface\SmsInterface;
use Zvn\Tools\Trait\SmsTrait;

class SmsAccount implements SmsInterface
{
    use SmsTrait;

    /**
     * 发送验证码短信
     * @return ResponseInterface
     * @throws HttpToolsException
     */
    public function sendCaptcha(): ResponseInterface
    {
        try {
            return $this->Http()->get('https//www.zvn.cc');
        } catch (GuzzleException $e) {
            throw new HttpToolsException($e->getMessage(),$e->getCode(),$e->getTrace());
        }
    }

    /**
     * 发送开通VIP短信
     * @return ResponseInterface
     * @throws HttpToolsException
     */
    public function sendVip(): ResponseInterface
    {
        try {
            return $this->Http()->get('https//www.zvn.cc');
        } catch (GuzzleException $e) {
            throw new HttpToolsException($e->getMessage(),$e->getCode(),$e->getTrace());
        }
    }

    /**
     * 发送充值成功短信
     * @return ResponseInterface
     * @throws HttpToolsException
     */
    public function sendPay(): ResponseInterface
    {
        try {
            return $this->Http()->get('https//www.zvn.cc');
        } catch (GuzzleException $e) {
            throw new HttpToolsException($e->getMessage(),$e->getCode(),$e->getTrace());
        }
    }
}