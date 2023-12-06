<?php

namespace JsTan;

class Route
{
    /**
     * @var array
     * 路由
     */
    private array $routes = [];

    private static Route $instance;


    /**
     * @param array $route
     * 构造函数
     */
    private function __construct(array $route)
    {
        $this->setRoute($route);
    }


    /**
     * @param array $routes
     * 设置路由
     */
    private function setRoute(array $routes): void
    {
        $this->routes = $routes;
    }

    /**
     * @param string $name
     * @return string|null
     * 获取路由
     */
    public function getRoute(string $name): ?string
    {
        $routes = [
            'QUERY_SHOPS' => 'open/shops/query',
            'QUERY_LOGISTICSCOMPANY' => 'open/logisticscompany/query',
            'QUERY_PARTNER_WMS' => 'open/wms/partner/query',
            'QUERY_DISTRIBUTOR' => 'open/jushuitan/distributor/query',
            'UPLOAD_ITEMSKU' => '/open/jushuitan/itemsku/upload',
            'UPLOAD_SKUMAP' => '/open/jushuitan/skumap/upload',
            'UPLOAD_COMBINESKU_ITEM' => '/open/jushuitan/item/combinesku/upload',
            'QUERY_SKUMAP' => '/open/skumap/query',
            'QUERY_COMBINE_SKU' => '/open/combine/sku/query',
            'QUERY_CATEGORY' => '/open/category/query',
            'QUERY_MALL_ITEM' => '/open/mall/item/query',
            'QUERY_SKU' => '/open/sku/query',
            'QUERY_INVENTORY' => '/open/inventory/query',
            'QUERY_INVENTORY_COUNT' => '/open/inventory/count/query',
            'UPLOAD_INVENTORY_V2' => '/open/jushuitan/inventoryv2/upload',
            'UPLOAD_ORDERS' => '/open/jushuitan/orders/upload',
            'CANCEL_ORDERBYOID' => '/open/jushuitan/orderbyoid/cancel',
            'QUERY_ORDERS_SINGLE' => '/open/orders/single/query',
            'UPLOAD_ORDER_SENT' => '/open/order/sent/upload',
            'UPLOAD_EXPRESS_REGISTER' => '/open/express/register/upload',
            'UPLOAD_ORDERS_WEIGHT_SEND' => '/open/orders/weight/send/upload',
            'QUERY_LOGISTIC' => '/open/logistic/query',
            'QUERY_PURCHASE' => '/open/purchase/query',
            'UPLOAD_PURCHASE' => '/open/jushuitan/purchase/upload',
            'UPLOAD_SUPPLIER' => '/open/supplier/upload',
            'QUERY_SUPPLIER' => '/open/supplier/query',
            'QUERY_MANUFACTURE' => '/open/jushuitan/manufacture/query',
            'UPLOAD_PURCHASEIN' => '/open/jushuitan/purchasein/upload',
            'QUERY_PURCHASEIN' => '/open/purchasein/query',
            'UPLOAD_PURCHASEIN_RECEIVED' => '/open/purchasein/received/upload',
            'UPLOAD_PURCHASEIN_CONFIRM' => '/open/purchasein/confirm/upload',
            'QUERY_ORDER_OUT_SIMPLE' => '/open/orders/out/simple/query',
            'UPLOAD_ORDERS_WMS_SENT' => '/open/orders/wms/sent/upload',
            'QUERY_PURCHASEOUT' => '/open/purchaseout/query',
            'UPLOAD_PURCHASEOUT' => '/open/jushuitan/purchaseout/upload',
            'QUERY_REFUND_SINGLE' => '/open/refund/single/query',
            'UPLOAD_REFUND_RECEIVE' => '/open/refund/receive/upload',
            'QUERY_AFTERSALE_RECEIVED' => '/open/aftersale/received/query',
            'UPLOAD_AFTERSALE' => '/open/aftersale/upload',
            'QUERY_OTHER_INOUT' => '/open/other/inout/query',
            'UPLOAD_OTHERINOUT' => '/open/jushuitan/otherinout/upload',
            'QUERY_ALLOCATE' => '/open/allocate/query',
            'UPLOAD_ALLOCATE_KC' => '/open/allocate/kc/upload',
            'UPLOAD_ALLOCATE_IN' => '/open/jushuitan/allocate/in/upload',
        ];
        $routes += $this->routes;

        return $routes[$name] ?? null;
    }

    public static function getInstance(array $route=[]): Route
    {
        if (self::$instance == null){
            self::$instance = new self($route);
        }
        return self::$instance;
    }

}