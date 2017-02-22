<?php

class Service_Product
{
    /**
     *
     * @var null
     */
    public static $_modelClass = null;
    public static $productType = array(
        0 => '普通产品',
        1 => '组合产品',
    );

    /**
     *
     * @return Table_Product null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_Product();
        }
        return self::$_modelClass;
    }
    /**
     * [getCiqStatus 商检状态]
     * @param  string $lang [description]
     * @return [type]       [description]
     */
    public static function getCiqStatus($lang = 'zh_CN')
    {
        $tmpArr = array(
            'zh_CN' => array(
                '-1' => '待发送',
                '1' => '已发送',
                '2' => '已接收',
                '3' => '已审核',
                '4' => '审核不通过',
                '5' => '异常',
            ), //做双语言时候在修改
            'en_US' => array(
                '-1' => '待发送',
                '1' => '已发送',
                '2' => '已接收',
                '3' => '审核通过',
                '4' => '审核不通过',
                '5' => '异常',
            ),
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmpArr[$lang]) ? $tmpArr[$lang] : $tmpArr;
    }
    public static function getStatus($lang = 'zh_CN')
    {
        $tmpArr = array(
            'zh_CN' => array(
                '0' => '不可用',
                '1' => '可用',
            ), //做双语言时候在修改
            'en_US' => array(
                '0' => '不可用',
                '1' => '可用',
            ),
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmpArr[$lang]) ? $tmpArr[$lang] : $tmpArr;
    }
    public static function getCustomsStatus($lang = 'zh_CN')
    {
        $tmpArr = array(
            'zh_CN' => array(
                '2' => '待发送',
                '5' => '已发送',
                '7' => '已接收',
                '1' => '已审核',
                '4' => '审核不通过',
                '6' => '停用',

            ), //做双语言时候在修改
            'en_US' => array(
                '2' => '待发送',
                '5' => '已发送',
                '7' => '已接收',
                '1' => '已审核',
                '4' => '审核不通过',
                '6' => '停用',
            ),
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmpArr[$lang]) ? $tmpArr[$lang] : $tmpArr;
    }
    /**
     *
     * @param
     *          $row
     * @return mixed
     */
    public static function add($row)
    {
        $model = self::getModelInstance();
        return $model->add($row);
    }

    /**
     *
     * @param
     *          $row
     * @param
     *          $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "product_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    public static function customUpdate($data, $condition, $value = '')
    {
        $model = self::getModelInstance();
        return $model->customUpdate($data, $condition, $value);
    }

    /**
     *
     * @param
     *          $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "product_id")
    {
        $model = self::getModelInstance();
        return $model->delete($value, $field);
    }

    /**
     *
     * @param
     *          $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public static function getByField($value, $field = 'product_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }
    /**
     * @author william-fan
     * @todo 锁表
     */
    public static function getByFieldLock($value, $field = 'product_id', $colums = "*"){
    	$model = self::getModelInstance();
    	return $model->getByFieldLock($value,$field,$colums);
    }
    /**
     *
     * @param
     *          $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public static function getByFieldForUpdate($value, $field = 'product_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }

    public static function getByWhere($where, $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByWhere($where, $colums);
    }

    /**
     *
     * @return mixed
     */
    public static function getAll()
    {
        $model = self::getModelInstance();
        return $model->getAll();
    }

    // 获取产品封面图片链接
    public static function getProductSingleImageUrl($productId)
    {
        return "http://" . $_SERVER['HTTP_HOST'] . "/merchant/product/view-image/id/" . $productId;
    }

    // 获取attach图片链接
    public static function getAttachUrlByAid($aid)
    {
        return "http://" . $_SERVER['HTTP_HOST'] . "/merchant/product/view-attach/aid/" . $aid;
    }

    // 获取上传时的图片链接
    public static function getUploadUrlByName($fileName)
    {
        return "http://" . $_SERVER['HTTP_HOST'] . "/merchant/product/view-upload-image/fileName/" . $fileName;
    }
	
	/**
	 * 商检状态
	 * Enter description here ...
	 * @param unknown_type $status
	 * @param unknown_type $pageSize
	 * @param unknown_type $minId
	 */
	public static function getByCiqStatus($status, $pageSize = 0 , $minId = 0){
        $model = self::getModelInstance();
        return $model->getByCiqStatus($status, $pageSize , $minId);
    }
    /**
     *
     * @author william-fan
     * @todo 用于得到订单信息
     */
    public static function getProductAllInfo($productId)
    {
        if ($productId) {
            $product = Service_Product::getByField($productId, 'product_id');
        }
        if ($product) {
            if ($product['product_type'] == 0) {
                $con = array(
                    'product_id' => $productId,
                );
                $attaches = Service_ProductAttached::getByCondition($con);
                $product['attach'] = $attaches;
                if (!empty($attachedAddition)) {
                    $product['attach']['addition'] = $attachedAddition;
                }

            }

            $product['product_status_cn'] = $product['product_status'] == 1 ? "可用" : "不可用";

            $product['customer_code'] = $product['customer_code'] ? $product['customer_code'] : '';
            return $product;
        }
        return false;
    }

    /**
     *
     * @param array $condition
     * @param string $type
     * @param int $pageSize
     * @param int $page
     * @param string $order
     * @return mixed
     */
    public static function getByCondition($condition = array(), $field = '*', $order = '', $pageSize = 20, $page = 0)
    {
        $model = self::getModelInstance();
        return $model->getByCondition($condition, $field, $order, $pageSize, $page);
    }

    /**
     *
     * @param
     *          $val
     * @return array
     */
    public static function validator($val)
    {
        $validateArr = $error = array();

        return Common_Validator::formValidator($validateArr);
    }

    /**
     * 获取自定义SQL语句查询结果
     *
     * @access public
     * @param
     *          string  ($field     待返回的字段，默认为所有)
     * @param
     *          string  ($condition 查询条件)
     * @param
     *          mixed   ($value     待转换查询字段值)
     * @return mixed
     */
    public static function getCustomQuery($field = '*', $condition = '', $value = '')
    {
        $model = self::getModelInstance();
        return $model->getCustomQuery($field, $condition, $value);
    }

    /**
     *
     * @param array $params
     * @return array
     */
    public function getFields()
    {
        $row = array(

            'E0' => 'product_id',
            'E1' => 'product_sku',
            'E2' => 'product_barcode',
            'E3' => 'customer_code',
            'E4' => 'customer_id',
            'E5' => 'product_title_en',
            'E6' => 'product_title',
            'E7' => 'product_status',
            'E8' => 'product_receive_status',
            'E9' => 'pu_code',
            'E10' => 'product_length',
            'E11' => 'product_width',
            'E12' => 'product_height',
            'E13' => 'product_net_weight',
            'E14' => 'product_weight',
            'E15' => 'product_sales_value',
            'E16' => 'product_purchase_value',
            'E17' => 'product_declared_value',
            'E18' => 'product_is_qc',
            'E19' => 'product_barcode_type',
            'E20' => 'product_type',
            'E21' => 'pc_id',
            'E22' => 'pce_id',
            'E23' => 'product_add_time',
            'E24' => 'product_update_time',
        );
        return $row;
    }

    /* 去除空格 */
    public static function fomatRow($row)
    {
        foreach ($row as $k => $v) {
            if (!is_array($v)) {
                $row[$k] = trim($v);
            } else {
                $row[$k] = ($v);
            }
        }
        return $row;
    }

    /**
     *
     * @author william-fan
     * @todo 更加条件获取一行
     */
    public static function getRowByCondition($condition = array(), $type = '*')
    {
        $model = self::getModelInstance();
        return $model->getRowByCondition($condition, $type);
    }
}
