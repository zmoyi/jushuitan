<?php

namespace zmoyi\JuShuiTan\Api\common;

use GuzzleHttp\Client as Clients;
use GuzzleHttp\Exception\GuzzleException;

class Client
{
    protected static string $url;

    public static function post($url, $data)
    {
        return Client::sendRequest($url, $data);
    }

    private static function sendRequest($url, array $options)
    {
        $client = new Clients([
            'base_uri' => self::getUrl(),
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
            ]
        ]);
        try {
            $request = $client->post($url,[
                'form_params' => $options
            ]);
            $contents = $request->getBody()->getContents();
            return json_decode($contents, true);
        } catch (GuzzleException $e) {
            return json_encode($e);
        }
    }

    /**
     * @param string $url
     */
    public static function setUrl(string $url): void
    {
        self::$url = $url;
    }

    /**
     * @return string
     */
    public static function getUrl(): string
    {
        return self::$url;
    }
}