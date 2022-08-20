<?php

namespace jushuitan;

use GuzzleHttp\Client;

class JuShuiTan
{
    /**
     * 全局config配置
     * @var array
     */
    protected array $config = [
        'authUrl' => 'https://openweb.jushuitan.com/auth',
        'baseUrl' => '',
        'access_token' => '',
        'app_Key' => '',
        'app_Secret' => '',
        'version' => 2,
        'charset' => 'utf-8'
    ];

    /**
     * 公共请求参数
     * @var array|string[]
     */
    protected array $public_request_params = [
        'app_key' => '',
        'access_token' => '',
        'timestamp' => '',
        'charset' => '',
        'version' => '',
    ];

    /**
     * Client请求
     * @var Client
     */
    protected Client $client;

    /**
     * 定义获取access—token Url
     * @var string
     */
    protected string $getAccessTokenUrl = 'https://openapi.jushuitan.com/openWeb/auth/accessToken';

    /**
     * 定义refresh-token地址
     * @var string
     */
    protected string $refreshTokenUrl = 'https://openapi.jushuitan.com/openWeb/auth/refreshToken';

    protected function __construct()
    {
        /**
         * 初始化Client请求
         */
        $this->client = new Client([
            'base_uri'  =>  $this->config['baseUrl'],
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
            ]
        ]);
    }

    /**
     * 获取config配置
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * 设置config配置
     * @param array $config
     * @return JuShuiTan
     */
    protected function setConfig(array $config): JuShuiTan
    {
        if (isset($config['app_Key'], $config['app_Secret'], $config['baseUrl'],$config['access_token'])) {

            $this->config['access_token'] = $config['access_token'];
            $this->config['baseUrl'] = $config['baseUrl'];
            $this->config['app_Key'] = $config['app_Key'];
            $this->config['app_Secret'] = $config['app_Secret'];
        }
        return $this;
    }

    /**
     * 获取公共参数
     * @return array
     */
    public function getPublicRequestParams(): array
    {
        return $this->public_request_params;
    }

    /**
     * 设置公共参数
     */
    public function setPublicRequestParams(): JuShuiTan
    {
        if (isset($this->getConfig()['app_Key'], $this->getConfig()['access_token'])){
            $this->public_request_params = [
               'app_key' => $this->config['app_Key'],
               'access_token' =>  $this->config['access_token'],
               'timestamp' => time(),
               'charset' => $this->config['charset'],
               'version' => $this->config['version'],
                'sign' => '',
                'biz' => '{}'
           ];
        }
       return $this;
    }
    /**
     * 生成签名
     */
    protected function get_sign($data): ?string
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
        $result_str = $this->getConfig()['app_Secret'] . $result_str;
        return bin2hex(md5($result_str, true));
    }
}
