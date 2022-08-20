<?php

namespace jushuitan\Api;

use jushuitan\JuShuiTan;

class Util extends JuShuiTan
{
    protected static array $data;
    protected static string $sign;

    public function __construct()
    {
        parent::__construct();
        parent::setPublicRequestParams();
        Util::setData($this->getPublicRequestParams());
        Util::setSign($this->get_sign($this->getPublicRequestParams()));
    }

    /**
     * 参数值
     * @fun getParams
     * @param array $biz
     * @return array
     * @date 2022/8/20
     * @author 刘铭熙
     */
    public static function getParams(array $biz): array
    {
        $data = self::$data;
        $data['sign'] = self::$sign;
        $data['biz'] = !empty($biz) ? json_encode($biz) : '{}';

        return $data;
    }

    /**
     * @param array $data
     */
    public static function setData(array $data): void
    {
        self::$data = $data;
    }

    /**
     * @param string $sign
     */
    public static function setSign(string $sign): void
    {
        self::$sign = $sign;
    }

}