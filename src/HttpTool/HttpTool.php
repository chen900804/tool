<?php

namespace Zvn\Tool\HttpTool;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Zvn\Tool\Exception\HttpException;
use Zvn\Tool\Statics\Statics;

class HttpTool
{

    protected Client $Client;
    protected array $config;

    public function __construct()
    {
        $this->Client = new Client();
        $this->config = require_once(dirname(__DIR__) . '\Config\config.php');
    }

    /**
     * 赛邮发送短信验证码
     * @param $to
     * @param $project
     * @param $vars
     * @return array|bool
     * @throws GuzzleException
     */
    public function SendSms($to, $project, $vars): bool|array
    {
        $date = array_filter([
            'appid' => $this->config['SMS']['SMS_APPID'],
            'to' => $to,
            'project' => $project,
            'vars' => $vars,
            'signature' => $this->config['SMS']['SMS_APP_KEY']
        ]);
        $Client = new Client();
        $url = 'https://api.mysubmail.com/message/xsend.json';
        $reqs = $Client->post($url, ['json' => $date])->getBody()->getContents();
        $reqs = json_decode($reqs);
        if ($reqs->status != 'success') {
            return ['stats' => false, 'message' => $reqs];
        }
        return ['stats' => true, 'message' => $reqs];
    }

    /**
     * 获取IP地址的城市
     * @param $ip
     * @return array
     * @throws GuzzleException
     */
    public function getIpSite($ip): array
    {
        $statics = new Statics();
        if (!$statics->is_ip($ip)['stats']) {
            return ['stats' => false, 'message' => 'ip地址不符合IPV规则'];
        }
        $date = array_filter([
            'key' => $this->config['MAP']['KEY'],
            'ip' => $ip
        ]);
        $reqs = $this->Client->get('https://restapi.amap.com/v3/ip', ['query' => $date])->getBody()->getContents();
        $reqs = json_decode($reqs);
        if ($reqs->status != '1' || $reqs->info != 'OK') {
            return ['stats' => false, 'message' => $reqs];
        }
        return ['stats' => true, 'message' => $reqs];
    }

    /**
     * 返回IP地址的天气
     * @param $ip
     * @return array
     * @throws GuzzleException
     * @throws HttpException
     */
    public function getIpWeather($ip): array
    {
        $city = $this->getIpSite($ip);
        if (!$city['stats']) {
            throw new HttpException('getIpSite function 请求失败', 500);
        }
        $date = array_filter([
            'key' => $this->config['MAP']['KEY'],
            'city' => $city['message']->city,
            'extensions' => 'base',
            'output' => 'JSON'
        ]);
        $reqs = $this->Client->get('https://restapi.amap.com/v3/weather/weatherInfo', [
            'query' => $date,
        ])->getBody()->getContents();
        $reqs = json_decode($reqs);
        if ($reqs->status != '1' || $reqs->info != 'OK') {
            return ['stats' => false, 'message' => $reqs];
        }
        return ['stats' => true, 'message' => $reqs];
    }
}