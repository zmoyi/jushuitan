<?php

namespace jushuitan\Api;

use Exception;
use GuzzleHttp\Exception\GuzzleException;

class BaseApiRes extends BaseApi
{
    /**
     * 店铺查询
     * @fun queryShops
     * @param array $params
     * @return Exception|GuzzleException|string
     * @date 2022/8/20
     * @author 刘铭熙
     */
    public function queryShops(array $params)
    {
        return Client::post(ServeHttp::QUERY_SHOPS, Util::getParams($this->getConfig()['app_Secret'], $params));
    }

    /**
     * 物流公司查询
     * @fun queryLogisticscompany
     * @param array $params
     * @return false|mixed|string
     * @date 2022/8/20
     * @author 刘铭熙
     */
    public function queryLogisticscompany(array $params)
    {
        return Client::post(ServeHttp::QUERY_LOGISTICSCOMPANY, Util::getParams($this->getConfig()['app_Secret'], $params));
    }

    /**
     * 仓库查询
     * @fun queryPartnerWms
     * @param array $params
     * @return false|mixed|string
     * @date 2022/8/20
     * @author 刘铭熙
     */
    public function queryPartnerWms(array $params)
    {
        return Client::post(ServeHttp::QUERY_PARTNER_WMS, Util::getParams($this->getConfig()['app_Secret'], $params));
    }

    /**
     * 分销商查询列表
     * @fun queryDistribute
     * @param array $params
     * @return false|mixed|string
     * @date 2022/8/20
     * @author 刘铭熙
     */
    public function queryDistribute(array $params)
    {
        return Client::post(ServeHttp::QUERY_DISTRIBUTOR, Util::getParams($this->getConfig()['app_Secret'], $params));
    }



}