<?php

namespace jushuitan;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;

class JuShuiTan
{
    /**
     * @var array
     */
    protected array $config = [
        'authUrl' => 'https://openweb.jushuitan.com/auth',
        'baseUrl' => '',
        'app_Key' => '',
        'app_Secret' => '',
        'version' => 2,
        'charset' => 'utf-8'
    ];

    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @var string
     */
    protected string $getTokenUrl = 'https://openapi.jushuitan.com/openWeb/auth/accessToken';

    /**
     * @var string
     */
    protected string $refreshTokenUrl = 'https://openapi.jushuitan.com/openWeb/auth/refreshToken';

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
        $this->config['authUrl'] = $config['authUrl'];
        $this->config['app_Key'] = $config['app_Key'];
        $this->config['app_Secret'] = $config['app_Secret'];

        return $this;
    }

    /**
     * 生成授权链接
     * @fun createUrl
     * @date 2022/8/20
     * @author 刘铭熙
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
     * 获取访问令牌
     * @fun getAccessToken
     * @param $code
     * @return Exception|GuzzleException|StreamInterface
     * @date 2022/8/20
     * @author 刘铭熙
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
            $response = $this->client->post($this->getTokenUrl, [
                'form_params' => $data
            ]);
            return $response->getBody();
        } catch (GuzzleException $e) {
            return $e;
        }
    }

    /**
     * 更新授权令牌
     * @fun refreshToken
     * @param $refresh_token
     * @return Exception|GuzzleException|StreamInterface
     * @date 2022/8/20
     * @author 刘铭熙
     */
    public function refreshToken($refresh_token)
    {
        $data = [
            'app_key' => $this->getConfig()['app_Key'],
            'timestamp' => time(),
            'grant_type' => 'refresh_token',
            'charset' => $this->getConfig()['charset'],
            'refresh_token' => $refresh_token,
            'scope' => 'all',
        ];

        $sign = $this->get_sign($data);

        try {
            $data['sign'] = $sign;
            $response = $this->client->post($this->refreshTokenUrl, [
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
        $result_str = $this->getConfig()['app_Secret'] . $result_str;
        return bin2hex(md5($result_str, true));
    }
}
