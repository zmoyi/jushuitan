<?php

namespace zmoyi\JuShuiTan\Api\Common;

interface ServeHttp
{
    /**
     * 基础API路由
     */
    /**
     * 店铺查询
     */
    const QUERY_SHOPS = 'open/shops/query';

    /**
     * 物流公司查询
     */
    const QUERY_LOGISTICSCOMPANY = 'open/logisticscompany/query';

    /**
     * 仓库查询
     */
    const QUERY_PARTNER_WMS = 'open/wms/partner/query';

    /**
     * 分销商查询列表
     */
    const QUERY_DISTRIBUTOR = 'open/jushuitan/distributor/query';

    /**
     * 基础API路由end
     * ------------------------------------------------------------------
     * 商品API路由
     */

    /**
     * 普通商品资料上传
     */
    const UPLOAD_ITEMSKU = '/open/jushuitan/itemsku/upload';

    /**
     * 店铺商品资料上传
     */
    const UPLOAD_SKUMAP = '/open/jushuitan/skumap/upload';

    /**
     * 组合装商品上传
     */
    const UPLOAD_COMBINESKU_ITEM = '/open/jushuitan/item/combinesku/upload';

    /**
     * 店铺商品资料查询
     */
    const QUERY_SKUMAP = '/open/skumap/query';

    /**
     *组合装商品查询
     */
    const QUERY_COMBINE_SKU = '/open/combine/sku/query';

    /**
     * 商品类目查询
     */
    const QUERY_CATEGORY = '/open/category/query';

    /**
     * 普通商品查询（按款查询）
     */
    const QUERY_MALL_ITEM = '/open/mall/item/query';

    /**
     * 普通商品资料查询（按sku查询）
     */
    const QUERY_SKU = '/open/sku/query';

    /**
     * 商品API end
     * ————————————————————————————————————————————————
     * 库存API
     */

    /** 库存查询
     */
    const QUERY_INVENTORY = '/open/inventory/query';

    /**
     * 库存盘点查询
     */
    const QUERY_INVENTORY_COUNT = '/open/inventory/count/query';

    /**
     * 新建盘点单
     */
    const UPLOAD_INVENTORY_V2 = '/open/jushuitan/inventoryv2/upload';

    /**
     * 库存API end
     * ————————————————————————————————————————————————
     * 订单API
     */

    /**
     * 订单上传(商家自有商城、跨境线下)
     */
    const UPLOAD_ORDERS = '/open/jushuitan/orders/upload';

    /**
     * 订单取消-按内部单号取消
     */
    const CANCEL_ORDERBYOID = '/open/jushuitan/orderbyoid/cancel';

    /**
     * 订单查询
     */
    const QUERY_ORDERS_SINGLE = '/open/orders/single/query';

    /**
     * 订单发货
     */
    const UPLOAD_ORDER_SENT = '/open/order/sent/upload';

    /**
     * 订单API end
     * ————————————————————————————————————————————————
     * 物流API
     */

    /**
     * 批量快递登记
     */
    const UPLOAD_EXPRESS_REGISTER = '/open/express/register/upload';

    /**
     * 称重并发货
     */
    const UPLOAD_ORDERS_WEIGHT_SEND = '/open/orders/weight/send/upload';

    /**
     * 发货信息查询
     */
    const QUERY_LOGISTIC = '/open/logistic/query';

    /**
     * 物流API end
     * ———————————————————————————————————————————————————
     * 采购API
     */

    /**
     * 采购单查询
     */
    const QUERY_PURCHASE = '/open/purchase/query';

    /**
     * 采购单上传
     */
    const UPLOAD_PURCHASE = '/open/jushuitan/purchase/upload';

    /**
     * 供应商上传
     */
    const UPLOAD_SUPPLIER = '/open/supplier/upload';

    /**
     * 供应商查询
     */
    const QUERY_SUPPLIER = '/open/supplier/query';

    /**
     * 加工单查询
     */
    const QUERY_MANUFACTURE = '/open/jushuitan/manufacture/query';

    /**
     * 采购API end
     * ————————————————————————————————————————
     * 入库API
     */

    /**
     * 新建采购入库单
     */
    const UPLOAD_PURCHASEIN = '/open/jushuitan/purchasein/upload';

    /**
     * 采购入库查询
     */
    const QUERY_PURCHASEIN = '/open/purchasein/query';

    /**
     * 入库单确认
     */
    const UPLOAD_PURCHASEIN_RECEIVED = '/open/purchasein/received/upload';

    /**
     * 采购按箱入库
     */
    const UPLOAD_PURCHASEIN_CONFIRM = '/open/purchasein/confirm/upload';

    /**
     * 入库API end
     * ————————————————————————————————————
     * 出库API
     */

    /**
     * 销售出库查询
     */
    const QUERY_ORDER_OUT_SIMPLE = '/open/orders/out/simple/query';

    /**
     * 出库发货
     */
    const UPLOAD_ORDERS_WMS_SENT = '/open/orders/wms/sent/upload';

    /**
     * 采购退货查询
     */
    const QUERY_PURCHASEOUT = '/open/purchaseout/query';

    /**
     * 采购退货上传（新）
     */
    const UPLOAD_PURCHASEOUT = '/open/jushuitan/purchaseout/upload';

    /**
     * 出库API end
     * ————————————————————————————————————
     * 售后API
     */

    /**
     * 退货退款查询
     */
    const QUERY_REFUND_SINGLE = '/open/refund/single/query';

    /**
     * 实际收货上传
     */
    const UPLOAD_REFUND_RECEIVE = '/open/refund/receive/upload';

    /**
     * 实际收货查询
     */
    const QUERY_AFTERSALE_RECEIVED = '/open/aftersale/received/query';

    /**
     * 售后上传
     */
    const UPLOAD_AFTERSALE = '/open/aftersale/upload';

    /**
     * 售后API end
     * ————————————————————————————————————
     *其他出入库API
     */

    /**
     * 其它出入库查询
     */
    const QUERY_OTHER_INOUT = '/open/other/inout/query';

    /**
     * 新建其它出入库（新）
     */
    const UPLOAD_OTHERINOUT = '/open/jushuitan/otherinout/upload';

    /**
     * 其他出入库API end
     * ————————————————————————————————————
     *调拨API
     */

    /**
     * 调拨单查询
     */
    const QUERY_ALLOCATE = '/open/allocate/query';

    /**
     * 库存调拨上传（跨仓调拨）
     */
    const UPLOAD_ALLOCATE_KC = '/open/allocate/kc/upload';

    /**
     * 库存调拨上传（仓内调拨）
     */
    const UPLOAD_ALLOCATE_IN = '/open/jushuitan/allocate/in/upload';













}