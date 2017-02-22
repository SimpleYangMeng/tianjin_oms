<?php

/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:55
 * To change this template use File | Settings | File Templates.
 */
class Service_PayOrder
{
    public static $_modelClass = null;

    /**
     *
     * @return Table_Customer|null
     */
    public static function getModelInstance ()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_PayOrder();
        }
        return self::$_modelClass;
    }

    /**
     * [getCiqStatus 商检状态]
     * @param  boolean $code [description]
     * @return [type]        [description]
     */
    public static function getCiqStatus($code = false){
        $status = array(
            1 => '草稿',
            4 => '已发送',
            5 => '已接收',
            6 => '接收失败',
        );

        if ($code !== false) {
            return isset($status[$code]) ? $status[$code] : '';
        }
        return $status;        
    }
    /**
     *
     * @param
     *            $row
     * @return mixed
     */
    public static function add ($row)
    {
        $model = self::getModelInstance();
        return $model->add($row);
    }

    /**
     *
     * @param
     *            $row
     * @param
     *            $value
     * @param string $field
     * @return mixed
     */
    public static function update ($row, $value, $field = "po_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * [update 多条件更新]
     * @param  [type] $data  [更新数据]
     * @param  [type] $where [条件数组 key=>value]
     * @return [type]        [description]
     */
    public static function updateByWhere($data, $where){
        if(empty($where) || !is_array($where)){
            return false;
        }
        $model = self::getModelInstance();
        return $model->updateByWhere($data, $where);
    }

    /**
     *
     * @param
     *            $value
     * @param string $field
     * @return mixed
     */
    public static function delete ($value, $field = "po_id")
    {
        $model = self::getModelInstance();
        return $model->delete($value, $field);
    }

    /**
     *
     * @param
     *            $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public static function getByField ($value, $field = 'po_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }

    /**
     * [getByFieldLock 锁表]
     * @param  [type] $value  [description]
     * @param  string $field  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public static function getByFieldLock($value, $field = 'po_id', $colums = "*"){
        $model = self::getModelInstance();
        return $model->getByFieldLock($value,$field,$colums);
    }
    
    /**
     * [getByWhere 多条件获取]
     * @param  [type] $where  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public static function getByWhere($where, $colums = "*")
    {
        if(empty($where) || !is_array($where)){
            return false;
        }
        $model = self::getModelInstance();
        return $model->getByWhere($where, $colums);
    }
    /**
     *
     * @return mixed
     */
    public static function getAll ()
    {
        $model = self::getModelInstance();
        return $model->getAll();
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
    public static function getByCondition ($condition = array(), $type = '*',
            $pageSize = 0, $page = 1, $order = "")
    {
        $model = self::getModelInstance();
        return $model->getByCondition($condition, $type, $pageSize, $page,
                $order);
    }

    /**
     * [getByStatus 根据状态返回数据]
     * @param  [type]  $status   [description]
     * @param  integer $pageSize [description]
     * @param  integer $minId    [description]
     * @return [type]            [description]
     */
    public static function getByStatus($status, $pageSize = 0 , $minId = 0){
        $model = self::getModelInstance();
        return $model->getByStatus($status, $pageSize , $minId);
    }

    /**
     * [getByCiqStatus 根据状态返回数据]
     * @param  [type]  $status   [description]
     * @param  integer $pageSize [description]
     * @param  integer $minId    [description]
     * @return [type]            [description]
     */
    public static function getByCiqStatus($appStatusArr, $status, $pageSize = 0 , $minId = 0){
        $model = self::getModelInstance();
        return $model->getByCiqStatus($appStatusArr, $status, $pageSize , $minId);
    }
    /**
     * [getGroupByCondition 分组统计]
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public static function getGroupByCondition($condition=array(), $field= 'app_status')
    {
        $model = self::getModelInstance();
        return $model->getGroupByCondition($condition, $field);
    }
    /**
     * 获取表格数据
     *
     * @param array $uploadFile
     *            上传数据
     * @param string $field
     *            文件名
     * @return array $resultArray 数据数组
     */
    public static function getXLSData ($uploadFile)
    {
        $fileName = $uploadFile['name'];
        $filePath = $uploadFile['tmp_name'];
        $pathinfo = pathinfo($fileName);
        if (! isset($pathinfo["extension"]) && $pathinfo["extension"] != "xls") {
            $result = array(
                    "ask" => 0,
                    "message" => '请选择xls文件',
                    'error' => ''
            );
            return $result;
            exit();
        }
        $resultArray = Common_Upload::readUploadFile($fileName, $filePath);
        return $resultArray;
    }

    /**
     *
     * @author
     *
     * @todo 用于处理excel文件返回成有效的数组
     */
    public static function getDataArr ($rows)
    {
        /*
         * $customerAuth = new Zend_Session_Namespace("customerAuth");
         * $customer = $customerAuth->data;
         * $customerId = $customer['id'];
         * $customer_code = $customer['code'];
         */
        $PayOrderRows = array();
        // 键名--中文对照
        $title = array_flip(Service_PayOrderProcess::getTitle());
        foreach ($rows as $key => $rowData) {
            foreach ($title as $k => $v) {
                if (isset($rowData[$k])) {
                    $PayOrderRows[$key][$v] = $rowData[$k];
                }
                if ($v == 'cosignee_country_id'){
                    $country = Service_Country::getByField($rowData[$k], 'country_name', array('country_id'));
                    if(!empty($country)){
                        $PayOrderRows[$key][$v] = $country['country_id'];
                    //未匹配到国家
                    }else {
                        $PayOrderRows[$key][$v] = 'unkown country';
                    }
                }
                
            }
        }
        return $PayOrderRows;
    }
}
