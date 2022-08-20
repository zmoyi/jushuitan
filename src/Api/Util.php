<?php

namespace jushuitan\Api;

use jushuitan\JuShuiTan;

class Util extends JuShuiTan
{


    /**
     *
     * @fun setParams
     * @param array $params
     * @return array
     * @date 2022/8/20
     * @author 刘铭熙
     */
    public static function setParams(array $params): array
    {
        $parent = new parent();
        $parent->setPublicRequestParams();
        $data = $parent->getPublicRequestParams();
        $signOrbiz = [
            'sign' => $parent->get_sign($data),
            'biz'  => empty($params) ? json_encode($params) : '{}'
        ];
        return array_merge($data,$signOrbiz);
    }





}