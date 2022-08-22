<?php

namespace zmoyi\JuShuiTan\Api;

use zmoyi\JuShuiTan\Api\common\BaseApi;
use zmoyi\JuShuiTan\Api\common\Client;
use zmoyi\JuShuiTan\Api\common\ServeHttp;
use zmoyi\JuShuiTan\Api\common\Util;

class ApiRes extends BaseApi
{
    public function request($serveHttp, $params)
    {
        return Client::post($serveHttp, Util::getParams($this->getConfig()['app_Secret'], $params));
    }

}