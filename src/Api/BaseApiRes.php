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
        Util::setParams($this,$this->getConfig()['app_Secret']);
        Client::setUrl($this->config['baseUrl']);
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
        return Client::post(ServeHttp::QUERY_SHOPS,Util::getParams($biz));

    }
}