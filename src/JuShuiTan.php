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
        'access_token' => '',
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

    private function __construct()
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
    protected function setConfig(array $config): JuShuiTan
    {
        if (isset($config['authUrl'], $config['app_Key'], $config['app_Secret'], $config['baseUrl'])) {
            $this->config['authUrl'] = $config['authUrl'];
            $this->config['baseUrl'] = $config['baseUrl'];
            $this->config['app_Key'] = $config['app_Key'];
            $this->config['app_Secret'] = $config['app_Secret'];
        }
        return $this;
    }

    /**
     * 生成签名
     */
    public function get_sign($data): ?string
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
