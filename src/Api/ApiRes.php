<?php

namespace jushuitan\Api;

use jushuitan\Api\common\BaseApi;
use jushuitan\Api\common\Client;
use jushuitan\Api\common\Util;

class ApiRes extends BaseApi
{
    public function request($serveHttp, $params)
    {
        if (!isset($serveHttp)){
            return '请填写路径';
        }
        return Client::post($serveHttp, Util::getParams($this->getConfig()['app_Secret'], $params));
    }

}