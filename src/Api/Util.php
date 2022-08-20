<?php

namespace jushuitan\Api;

use jushuitan\JuShuiTan;

class Util
{
    protected static array $params;

    /**
     * @param JuShuiTan $juShuiTan
     * @param $app_Secret
     */
    public static function setParams(JuShuiTan $juShuiTan): void
    {
        $data = $juShuiTan->getPublicRequestParams();
        self::$params = $data;
    }

    /**
     * @param $app_Secret
     * @param array $biz
     * @return array
     */
    public static function getParams($app_Secret, array $biz): array
    {
        $data = self::$params;
        $data['sign'] = self::get_sign($app_Secret, $data);
        $data['biz'] = !empty($biz) ? json_encode($biz) : '{}';
        return $data;
    }
    /**
     * 生成签名
     */
    public static function get_sign($app_Secret, $data): ?string
    {
        if ($data == null) {
            return null;
        }
        ksort($data);
        $result_str = "";
        foreach ($data as $key => $val) {
            if ($key != null && $key != "" && $key != "sign") {
                $result_str = $result_str . $key . $val;
            }
        }
        $result_str = $app_Secret . $result_str;
        return bin2hex(md5($result_str, true));
    }
}