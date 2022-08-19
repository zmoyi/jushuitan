<?php

namespace jushuitan;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class JuShuiTan
{
    /**
     * api配置
     */
    protected  array $config = [
        'authUrl' => 'https://openweb.jushuitan.com/auth',
        'baseUrl' => '',
        'app_Key' => '',
        'app_Secret' => '',
        'version' => 2,
        'charset' => 'utf-8'
    ];
    private $client;
    /**
     * 定义获取access_token接口
     */
    protected  string $getTokenUrl = 'https://openapi.jushuitan.com/openWeb/auth/accessToken';

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
            ]
        ]);
    }
    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     * @return JuShuiTan
     */
    public function setConfig(array $config): JuShuiTan
    {
        $this->config = $config;
        return $this;
    }

    /**
     * 业务授权URL拼装
     */
    public function createUrl(): string
    {
        $data = [
            'app_key' => $this->getConfig()['app_Key'],
            'timestamp' => time(),
            'charset' => $this->getConfig()['charset']
        ];
        $sign = $this->get_sign($data);
        return $this->getConfig()['authUrl'] .
            '?app_key=' . $data['app_key'] .
            '&timestamp=' . $data['timestamp'] .
            '&charset=' . $data['charset'] .
            '&sign=' . $sign;
    }

    /**
     * 使用code换取access_token
     */
    public function getAccessToken($code)
    {
        $data = [
            'app_key' => $this->getConfig()['app_Key'],
            'timestamp' => time(),
            'grant_type' => 'authorization_code',
            'charset' => $this->getConfig()['charset'],
            'code' => $code,
        ];
        $sign = $this->get_sign($data);
        try {
            $data['sign'] = $sign;
            $response =  $this->client->post($this->getTokenUrl, [
                'form_params' => $data
            ]);
            return $response->getBody();
        } catch (GuzzleException $e) {
            return $e;
        }
    }


    /**
     * 生成签名
     */
    private function get_sign($data): ?string
    {
        if ($data == null) {
            return null;
        }
        ksort($data);
        $result_str = "";
        foreach ($data as $key => $val) {
            if ($key != null && $key != "" && $key != "sign") {
                $result_str = $result_str . $key . $val;
            }
        }
        $result_str = $this->getConfig()['app_Secret']. $result_str;
        return bin2hex(md5($result_str, true));
    }
}
