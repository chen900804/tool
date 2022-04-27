<?php

namespace Zvn\Tool\Statics;

use Zvn\Tool\Exception\InvalidException;

class Statics
{

    public function __construct()
    {

    }


    /**
     * 创建唯一订单
     * @param $who
     * @return string
     * @throws InvalidException
     */
    public function create_order($who): string
    {
        if (!is_string($who)) {
            throw new InvalidException('请输入字符串', 500);
        }
        return $who . date('Ymd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(1000, 9999));
    }

    /**
     * 转元
     * @param $var
     * @return float
     */
    public function IntToFloat($var): float
    {
        $var = floatval($var);
        $var = $var / 100.00;
        return round($var, 2);
    }

    /**
     * 转分
     * @param $var
     * @return float
     */
    public function floatToInt($var): float
    {
        $var = floatval($var);
        $var = $var * 100.00;
        return round($var);
    }

    /**
     * 隐藏账号中间部分 支持手机和邮箱
     * @param $accountNumber
     * @param string $type
     * @return array|string
     * @throws InvalidException
     */
    public function getHideAccount($accountNumber, string $type = "phone"): array|string
    {
        $result = "";
        if (!empty($accountNumber)) {
            switch ($type) {
                case "phone":
                    {
                        $pattern = '/(\d{3})(\d{4})(\d{4})/i';
                        $replacement = '$1****$3';
                        $result = preg_replace($pattern, $replacement, $accountNumber);
                    }
                    break;
                case  "email":
                    {
                        $arr = explode('@', $accountNumber);
                        $rest_start = substr($arr[0], 0, 1);
                        //如果邮箱前缀长度是1，直接用*号代替
                        //如果邮箱前缀长度是2，最后一个字符直接用*号代替
                        if (strlen($arr[0]) == 1) {
                            $rest_start = "*";
                            $rest_end = "";
                            $modelString = "";
                        } elseif (strlen($arr[0]) == 2) {
                            $rest_end = "*";
                            $modelString = "";
                        } else {
                            $rest_end = substr($arr[0], -1, 1);
                            $modelString = str_repeat('*', strlen($arr[0]) - 2);
                        }

                        $result = $rest_start . $modelString . $rest_end . "@" . $arr[1];
                    }
                    break;
                default:
                {
                    $pattern = '/(\d{3})(\d{4})(\d{4})/i';
                    $replacement = '$1****$3';
                    $result = preg_replace($pattern, $replacement, $accountNumber);
                }

            }
        }
        if (is_null($result)) {
            throw new InvalidException('传入的数据不能未空', 500);
        }
        return $result;
    }

    /**
     * 验证是否为手机号
     * @param int $mobile
     * @return array|bool
     */
    function is_mobile(int $mobile): bool|array
    {
        $chars = "/^(?:(?:\+|00)86)?1(?:(?:3[\d])|(?:4[5-79])|(?:5[0-35-9])|(?:6[5-7])|(?:7[0-8])|(?:8[\d])|(?:9[189]))\d{8}$/";

        if (preg_match($chars, $mobile)) {
            return ['stats' => true, 'message' => '手机号 符合规则'];
        } else {
            return ['stats' => false, 'message' => '手机号 不符合规则'];
        }

    }

    /**
     * 验证不带端口IPV4
     * @param $ip
     * @return array
     */
    public function is_ip($ip): array
    {
        $chars = '/^([1-9]?\\d|1\\d{2}|2[0-4]\\d|25[0-5])(\\.([1-9]?\\d|1\\d{2}|2[0-4]\\d|25[0-5])){3}$/';
        if (preg_match($chars, $ip)) {
            return ['stats' => true, 'message' => '手机号 符合规则'];
        } else {
            return ['stats' => false, 'message' => '手机号 不符合规则'];
        }
    }

    /**
     * 验证金额
     * @param float|int $sum
     * @return array|bool
     */
    public function is_sum(float|int $sum): bool|array
    {
        $chars = "/^-?\d+(,\d{3})*(\.\d{1,2})?$/";
        if ($sum <= 0) {
            return ['stats' => false, 'message' => '金额不能小于等于0'];
        }
        if (preg_match($chars, $sum)) {
            return ['stats' => true, 'message' => '金额符合'];
        } else {
            return ['stats' => false, 'message' => '金额 不符合规则'];
        }
    }
}