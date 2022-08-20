<?php

namespace jushuitan\Api\common;

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