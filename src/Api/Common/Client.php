<?php

namespace zmoyi\JuShuiTan\Api\Common;

use GuzzleHttp\Client as Clients;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    protected static string $url;
    protected static  $data;

    public static function post($url, $data)
    {
        return self::sendRequest($url, $data);
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

        $request = $client->postAsync($url, [
            'form_params' => $options
        ]);
        $request->then(function (ResponseInterface $request) {
            $contents = $request->getBody()->getContents();
            self::$data = json_decode($contents, true);
        }, function (RequestException $e) {
            self::$data = $e;
        });
        return self::$data;

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