<?php

namespace zmoyi\JuShuiTan\Api\Common;

use zmoyi\JuShuiTan\JuShuiTan;

class Util
{
    protected static array $params;

    /**
     * @param JuShuiTan $juShuiTan
     */
    public static function setParams(JuShuiTan $juShuiTan): void
    {
        $data = $juShuiTan->getPublicRequestParams();
        self::$params = $data;
    }

    /**
     * @param $appSecret
     * @param array $biz
     * @return array
     */
    public static function getParams($appSecret, array $biz): array
    {
        $data = self::$params;
        $data['biz'] = !empty($biz) ? json_encode($biz) : '{}';
        $data['sign'] = self::getSign($appSecret, $data);
        return $data;
    }

    /**
     * 生成签名
     */
    public static function getSign($appSecret, $data): ?string
    {
        if ($data == null) {
            return null;
        }
        ksort($data);
        $resultStr = "";
        foreach ($data as $key => $val) {
            if ($key != null && $key != "" && $key != "sign") {
                $resultStr = $resultStr . $key . $val;
            }
        }
        $resultStr = $appSecret . $resultStr;
        return bin2hex(md5($resultStr, true));
    }
}