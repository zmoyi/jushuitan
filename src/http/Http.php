<?php

namespace JsTan\http;

use GuzzleHttp\Client;

class Http
{
    /**
     * 储存实例
     */
    private static Http $instance;

    /**
     * @var Client
     * Guzzle客户端
     */
    private Client $client;

    public function __construct($config = [])
    {
        $this->client = new Client([
            'base_uri' => $config['base_uri']?? '',
            'verify' => $config['verify']?? false,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
            ]
        ]);
    }

    /**
     * @return Http
     * 获取实例
     */
    public static function getInstance($config = []): Http
    {
        if(self::$instance == null){
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    /**
     * @return Client
     * 获取Guzzle客户端
     */
    public function getClient(): Client
    {
        return $this->client;
    }


}