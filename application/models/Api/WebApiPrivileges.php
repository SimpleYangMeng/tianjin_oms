<?php
return array(
    /**
     * 电商用户的权限
     * @var array
     */
    'is_ecommerce' => array(
        array(
            'apiName'=>'getStock',
            'opType'=>'Get',//多个权限时必须是数组，单个权限时可以是数组，也可以是字符串
            'name'=>'查询产品库存',
        ),
        array(
            'apiName'=>'Product',
            'opType'=>array('Add','Get'),
            'name'=>array('Add'=>'添加产品','Get'=>'查询产品'),
        ),
        array(
            'apiName'=>'getBatchStock',
            'opType'=>'Get',
            'name'=>array('Get'=>'批量查询产品库存'),
        ),
        array(
            'apiName'=>'Order',
            'opType'=>array('Add','Get','Update'),
            'name'=>array('Add'=>'添加订单','Get'=>'查询订单','Update'=>'更新订单'),
        ),
        array(
            'apiName'=>'getOrderByCode',
            'opType'=>'Get',
            'name'=>array('Get'=>'查询三单信息')
        ),
        array(
            'apiName'=>'PersonItem',
            'opType'=>'Get',
            'name'=>array('Get'=>'查询个人物品清单信息'),
        ),
    ),
    /**
     * 物流角色
     * @var array
     */
    'is_shipping' => array(
        array(
            'apiName'=>'Waybill',
            'opType'=>array('Add', 'Update', 'Get', 'UpdateStatus'),
            'name'=>array('Add'=>'创建运单','Update'=>'更新运单','Get'=>'查询运单'),
        ),
    ),
    /**
     * 支付企业角色
     * @var array
     */
    'is_pay' => array(
        array(
            'apiName'=>'PayOrder',
            'opType'=>array('Add','Update','Get'),
            'name'=>array('Add'=>'创建支付单','Update'=>'更新支付单','Get'=>'查询支付单'),
        ),
        array(
            'apiName'=>'getOrderByCode',
            'opType'=>array('Get'),
            'name'=>array('Get'=>'查询三单信息'),
        )
    ),

    /**
     * 仓租企业
     * @var array
     */
    'is_storage' => array(
        array(
            'apiName'=>'Product',
            'opType'=>array('Add','Get','Update'),
            'name'=>array('Add'=>'创建产品','Get'=>'查询产品','Update'=>'更新产品'),
        ),
        array(
            'apiName'=>'getStock',
            'opType'=>array('Get'),
            'name'=>array('Get'=>'查询产品库存'),
        ),
        array(
            'apiName'=>'getBatchStock',
            'opType'=>array('Get'),
            'name'=>array('Get'=>'批量查询产品库存'),
        ),
        array(
            'apiName'=>'getOrderByCode',
            'opType'=>array('Get'),
            'name'=>array('Get'=>'查询三单信息'),
        ),
        array(
            'apiName'=>'Loader',
            'opType'=>array('Add','Get'),
            'name'=>array('Add'=>'创建载货单','Get'=>'查询载货单'),
        ),
        array(
            'apiName'=>'getSurveillance',
            'opType'=>array('Get'),
            'name'=>array('Get'=>'海关布控查询'),
        ),
        array(
            'apiName'=>'Receiving',
            'opType'=>array('Add','Update','Get'),
            'name'=>array('Add'=>'创建入库单','Update'=>'更新入库单','Get'=>'查询入库单'),
        ),
        array(
            'apiName'=>'PersonItem',
            'opType'=>array('Get'),
            'name'=>array('Get'=>'查询个人物品清单'),
        ),
    ),

    /**
     * 报关企业
     */
    'is_baoguan' => array(
        array(
            'apiName'=>'PersonItem',
            'opType'=>array('Add','Get'),
            'name'=>array('Add'=>'创建个人物品清单','Get'=>'查询个人物品清单'),
        ),
    ),
);