<?php
namespace jushuitan\Api;
use jushuitan\JuShuiTan;

class ApiRes extends JuShuiTan
{

    public function __construct($config)
    {
        self::setConfig($config);
        parent::__construct();
    }


    /**
     * @param array $config
     * @return ApiRes
     */
    protected function setConfig(array $config):JuShuiTan
    {
        if (isset($config['access_token'])){
            parent::setConfig($config);
            $this->config['access_token'] = $config['access_token'];
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }
}