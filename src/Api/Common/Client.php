<?php

namespace zmoyi\JuShuiTan\Api\Common;

use GuzzleHttp\Client as Clients;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    protected static string $url;

    public static function post($url, $data): PromiseInterface
    {
        return self::sendRequest($url, $data);
    }

    private static function sendRequest($url, array $options): PromiseInterface
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
        return $request->then(function (ResponseInterface $request){
            return $request->getBody()->getContents();
        },function (RequestException $exception){
            return $exception;
        })->wait();

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