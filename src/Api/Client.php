<?php

namespace jushuitan\Api;

use jushuitan\JuShuiTan;

class Client extends JuShuiTan
{
    private static Client $clients;
    public function __construct($config)
    {
        parent::setConfig($config);
        parent::__construct();
        self::setClients($this->client);

    }

    public static function post($url, $data){
        return Client::getClient()->post($url,[
            'form_params' => Util::getParams($data)
        ]);
    }

    /**
     * @return Client
     */
    public static function getClient(): Client
    {
        return self::$clients;
    }

    /**
     * @param mixed $clients
     */
    public static function setClients($clients): void
    {
        self::$clients = $clients;
    }

}