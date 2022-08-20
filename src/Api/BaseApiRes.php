<?php

namespace jushuitan\Api;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use jushuitan\JuShuiTan;

class BaseApiRes extends JuShuiTan
{


    public function __construct($config)
    {
        parent::setConfig($config);
        parent::setPublicRequestParams();
        Client::setUrl($this->config['baseUrl']);
    }

    /**
     *
     * @fun queryShops
     * @param $biz
     * @return Exception|GuzzleException|string
     * @date 2022/8/20
     * @author 刘铭熙
     */
    public function queryShops($biz)
    {
        return Client::post(ServeHttp::QUERY_SHOPS,Util::setParams($biz));

    }
}