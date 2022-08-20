<?php

namespace jushuitan\Api\common;

use MyCLabs\Enum\Enum;


final class ServeHttp extends Enum
{
    /**
     * 基础API路由
     */
    /**
     * 店铺查询
     */
    private const QUERY_SHOPS = 'open/shops/query';

    /**
     * 物流公司查询
     */
    private const QUERY_LOGISTICSCOMPANY = 'open/logisticscompany/query';

    /**
     * 仓库查询
     */
    private const QUERY_PARTNER_WMS = 'open/wms/partner/query';

    /**
     * 分销商查询列表
     */
    private const QUERY_DISTRIBUTOR = 'open/jushuitan/distributor/query';

    /**
     * 基础API路由end
     * ------------------------------------------------------------------
     * 商品API路由
     */

    /**
     * 普通商品资料上传
     */
    private const UPLOAD_ITEMSKU = '/open/jushuitan/itemsku/upload';

    /**
     * 店铺商品资料上传
     */
    private const UPLOAD_SKUMAP = '/open/jushuitan/skumap/upload';

    /**
     * 组合装商品上传
     */
    private const UPLOAD_COMBINESKU_ITEM = '/open/jushuitan/item/combinesku/upload';

    /**
     * 店铺商品资料查询
     */
    private const QUERY_SKUMAP = '/open/skumap/query';

    /**
     * 组合装商品查询
     */


}