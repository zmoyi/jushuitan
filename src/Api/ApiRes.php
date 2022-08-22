<?php

namespace jushuitan\Api;

use jushuitan\Api\common\BaseApi;
use jushuitan\Api\common\Client;
use jushuitan\Api\common\ServeHttp;
use jushuitan\Api\common\Util;

class ApiRes extends BaseApi implements ServeHttp
{
    public function request(ServeHttp $serveHttp, $params)
    {
        return Client::post($serveHttp, Util::getParams($this->getConfig()['app_Secret'], $params));
    }

}