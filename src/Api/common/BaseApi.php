<?php

namespace zmoyi\JuShuiTan\Api\common;

use zmoyi\JuShuiTan\JuShuiTan;

class BaseApi extends JuShuiTan
{
    public function __construct($config)
    {
        parent::setConfig($config);
        parent::setPublicRequestParams();
        (new Util())->setParams($this);
        Client::setUrl($this->config['baseUrl']);
    }
}