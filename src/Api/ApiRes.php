<?php
namespace jushuitan\Api;
use GuzzleHttp\Exception\GuzzleException;
use jushuitan\JuShuiTan;

class ApiRes extends JuShuiTan
{
    const QUERY_SHOPS = 'open/shops/query';




    public function __construct($config)
    {
        parent::setConfig($config);
        parent::__construct();
        parent::setPublicRequestParams();
    }

    public function queryShops()
    {
        $data = $this->getPublicRequestParams();
        try {
            $data['sign'] = $this->get_sign($data);
            return $this->client->post(self::QUERY_SHOPS, [
                'form_params' => $data
            ])->getBody();
        } catch (GuzzleException $e) {
            return $e;
        }
    }
}