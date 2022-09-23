<?php

namespace zmoyi\JuShuiTan\Api;

use zmoyi\JuShuiTan\Api\Common\BaseApi;
use zmoyi\JuShuiTan\Api\Common\Client;
use zmoyi\JuShuiTan\Api\Common\ServeHttp;
use zmoyi\JuShuiTan\Api\Common\Util;

class ApiRequest extends BaseApi implements ServeHttp
{
    public function request($serveHttp, $params): array
    {
        return Client::post($serveHttp, Util::getParams($this->getConfig()['app_Secret'], $params));
    }

}