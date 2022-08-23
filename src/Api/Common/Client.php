<?php

namespace zmoyi\JuShuiTan\Api\Common;

use GuzzleHttp\Client as Clients;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    protected static string $url;

    public static function post($url, $data):array
    {
        return self::sendRequest($url, $data);
    }

    private static function sendRequest($url, array $options):array
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
        $promise = $request->then(function (ResponseInterface $request) {
            $contents = $request->getBody()->getContents();
            return json_decode($contents, true);
        }, function (RequestException $exception) {
            return json_decode(json_encode($exception),true);
        });
        return $promise->wait();
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