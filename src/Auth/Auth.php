<?php

namespace zmoyi\JuShuiTan\Auth;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use zmoyi\JuShuiTan\Api\common\Client;
use zmoyi\JuShuiTan\Api\common\Util;
use zmoyi\JuShuiTan\JuShuiTan;
use Psr\Http\Message\StreamInterface;

class Auth extends JuShuiTan
{
    public function __construct($config)
    {
        parent::setConfig($config);
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
        $sign = Util::getSign($this->getConfig()['app_Secret'],$data);
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
        $data['sign'] = Util::getSign($this->getConfig()['app_Secret'],$data);
        return Client::post($this->getAccessTokenUrl, $data);
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

        $data['sign'] = Util::getSign($this->getConfig()['app_Secret'],$data);
        return Client::post($this->refreshTokenUrl, $data);
    }
}