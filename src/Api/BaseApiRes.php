<?php

namespace jushuitan\Api;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use jushuitan\JuShuiTan;

class BaseApiRes extends JuShuiTan
{
    protected ServeHttp $serveHttp;

    public function __construct($config)
    {
        parent::setConfig($config);
        parent::__construct();
        $this->serveHttp = new ServeHttp();

    }

    /**
     *
     * @fun queryShops
     * @param array $biz
     * @return Exception|GuzzleException|string
     * @date 2022/8/20
     * @author 刘铭熙
     */
    public function queryShops(array $biz)
    {
//        try {
//            return $this->client->post(ServeHttp::QUERY_SHOPS, [
//                'form_params' => Util::getParams($biz)
//            ])->getBody()->getContents();
//        } catch (GuzzleException $e) {
//            return $e;
//        }

      return  Client::post(ServeHttp::QUERY_SHOPS,$biz);
    }
}