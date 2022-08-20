<?php

namespace jushuitan\Api;

use jushuitan\Api\common\Client;
use jushuitan\Api\common\Util;
use jushuitan\JuShuiTan;

class BaseApi extends JuShuiTan
{
    public function __construct($config)
    {
        parent::setConfig($config);
        parent::setPublicRequestParams();
        Util::setParams($this);
        Client::setUrl($this->config['baseUrl']);
    }
}