<?php

namespace jushuitan\Auth;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use jushuitan\JuShuiTan;
use Psr\Http\Message\StreamInterface;

class Auth extends JuShuiTan
{
    public function __construct()
    {
        parent::__construct();
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
}