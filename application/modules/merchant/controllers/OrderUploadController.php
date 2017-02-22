<?php
class Merchant_OrderUploadController extends Ec_Controller_Action{
    /**
     * excel对照
     * @var array
     */
    private $rowRelationalTitle = array(
            'order_mode_type'=>'订单模式',
            'warehouse_id' => '物流仓储企业',
            'logistic_customer_code' => '物流企业客户代码',
            'pay_customer_code' => '支付企业客户代码',
            'storage_customer_code' => '仓储企业客户代码',
            'country_id' => '收件人国家',
            'province_id' => '收件人省份',
            'city_id' => '收件人城市',
            'oab_district' => '收件人区（县）',
            'shipping_method' => '运输方式',
            'oab_firstname' => '收件人姓名',
            'reference_no' => '交易订单号',
            'oab_company' => '收件人公司名',
            'oab_postcode' => '收件人邮编',
            'oab_street_address1' => '收件人地址1',
            'oab_street_address2' => '收件人地址2',
            'oab_phone' => '收件人电话',
            'oab_email' => '收件人电子邮件',
            'grossWt' => '订单总毛重',
            'currency_code' => '币种',
            'IdType' => '收件人证件类型',
            'idNumber' => '收件人证件号码',
            'pay_no' => '支付单号',
            'remark' => '备注'
        );
    private $productRelationalTitle = array(
            'sku'=>'产品sku(\d)',
            'qty' => '数量(\d)',
            'price' => 'SKU成交单价(\d)',
            'total_price' => 'SKU成交总价(\d)'
        );

    private $shupaiProductRelationalTitle = array(
        'sku' => '产品sku',
        'qty' => '数量',
        'price' => 'SKU成交单价',
        'total_price' => 'SKU成交总价',
        );

	public function preDispatch ()
	{
		$this->tplDirectory = "merchant/views/order/";
		// $this->tplDirectory = "merchant/account_config/";
		$this->customerAuth = new Zend_Session_Namespace("customerAuth");
	}
	/**
	 * @author william-fan
	 * @todo 用于下载订单导入的模板
	 */
	public function downOrderTempleteAction(){
		$file = $this->_request->getParam('file','');
		switch($file){
			case 'orderupload':
				$fullPath = APPLICATION_PATH."/../data/file".'/orderbatch.xlsx';
				break;
            case 'orderbatchproduct':
                $fullPath = APPLICATION_PATH."/../data/file".'/orderbatchproduct.xlsx';
                break;
		}
		//方法2
		$filename = basename($fullPath);

		header("Content-Type: APPLICATION/OCTET-STREAM");
		//Force the download
		$header="Content-Disposition: attachment; filename=".$filename.";";
		header($header );
		// 	header("Content-Transfer-Encoding: binary");
		// 	header("Content-Length: ".$len);
		echo file_get_contents($fullPath);
		exit;
	}
	/**
	 * @author william-fan
	 * @todo 用于集货订单的导入
	 */
	public function batchOrderAction(){
		echo Ec::renderTpl($this->tplDirectory . "order-batch.tpl",'noleftlayout');
	}

    public function batchcheckAction()
    {
        error_reporting(E_ALL ^ E_NOTICE);
        $uploadData = Common_Upload::readEXCEL($_FILES['orderFile']['tmp_name']);

        if(!isset($uploadData[1]) || !isset($uploadData[0])){
            $this->view->errors = array('没有找到可用数据');
            echo Ec::renderTpl($this->tplDirectory . "batch-check-error.tpl",'noleftlayout');
            die();
        }
        if($this->checkModel($uploadData[0])){
            $rowRelationalData = $this->formatData($uploadData);
        }else{
            $rowRelationalData = $this->shupaiFormatData($uploadData);
        }

        $data = array();
        $error = array();
        foreach ($rowRelationalData as $key => $value) {
            $validator = $this->validator($value);

            if(!empty($validator['error'])){
                $validator['data']['error_info'] = $validator['error'];
            }else{
                $validator['data']['error_info'] = array();
            }
            $data[$key] = $validator['data'];
        }
        $session= new Zend_Session_Namespace('upload_order');
        $session -> data = $data;
        $this->view->data = $data;
        echo Ec::renderTpl($this->tplDirectory . "batch-check.tpl",'noleftlayout');
        die();
    }

    /**
     * 订单提交
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function importAction()
    {

        $session= new Zend_Session_Namespace('upload_order');
        $data = $session->data;

        $keys = $this->getRequest()->getParam('key', array());

        if(empty($keys)){
            $this->view->errorMsg = "没有找到可用数据";
            echo Ec::renderTpl($this->tplDirectory . "batch-import.tpl",'noleftlayout');
            die();
        }
        $success =0;
        $false =0;
        $failseHtml = '';
        $process = new Service_OrderProcess();
        $infos = array();
        $common_infos = array();
        $common_infos['summary'] = vsprintf(Ec_Lang::getInstance()->getTranslate('batch_import_order_summary'),array(count($keys)));
        $common_infos['successinfo'] = vsprintf(Ec_Lang::getInstance()->getTranslate('batch_order_create'),array(0));
        $common_infos['failinfo'] = vsprintf(Ec_Lang::getInstance()->getTranslate('batch_order_create_fail'),array(0));

        foreach ($keys as $key) {
            if(!isset($data[$key])){
                $false++;
                continue;
            }
            $orderRow = $data[$key];
            $orderRow['action'] = 'add';
            if($orderRow['order_mode_type']=='1'){
                //集货模式订单创建
                $result = $process->createjhOrderTransaction($orderRow);
            }elseif($orderRow['order_mode_type']=='0'){
                //备货模式的订单创建
                $result = $process->createOrderTransaction($orderRow);
            }
            if($result['ask']=='1'){
                $success++;
            }else{
                var_dump($result);
                if(isset($result['error'])){
                        $error = $result['error'];
                        if(!empty($error)){
                            foreach($error as $err){
                                $failseHtml.="<div class='error'>{$err}</div>";
                            }
                        }
                    }
                $false++;
                $info = array();
                $info['failseHtml']=$failseHtml;
                $infos[] = $info;
            }
        }

        $common_infos['successinfo'] = vsprintf(Ec_Lang::getInstance()->getTranslate('batch_order_create'),array($success));
        $common_infos['failinfo'] = vsprintf(Ec_Lang::getInstance()->getTranslate('batch_order_create_fail'),array($false));

        $this->view->common_infos=$common_infos;
        $this->view->infos=$infos;

        unset($session->data);
        echo Ec::renderTpl($this->tplDirectory . "batch-import.tpl",'noleftlayout');
    }


    private function shupaiFormatData($uploadData){
        $rowRelationalTitle = $this->rowRelationalTitle;
        $shupaiProductRelationalTitle = $this->shupaiProductRelationalTitle;

        $rowRelationalDataTitle = array();
        $productRelationalDataTitle = array();
        foreach ($uploadData[0] as $key => $value) {
            if(($rowKey = array_search($value , $rowRelationalTitle)) !== FALSE || ($rowKey = array_search($value , $shupaiProductRelationalTitle)) !== FALSE){
                $rowRelationalDataTitle[$key] = $rowKey;
            }
        }
        //

        $referenceKey = array_search('reference_no', $rowRelationalDataTitle);
        $sukKey = array_search('sku', $rowRelationalDataTitle);
        $qtyKey = array_search('qty', $rowRelationalDataTitle);
        $priceKey = array_search('price', $rowRelationalDataTitle);
        $totalPriceKey = array_search('total_price', $rowRelationalDataTitle);

        unset($uploadData[0]);
        $rowRelationalData = array();
        $productKeyArray = array();
        foreach ($uploadData as  $key => $rows) {
            ksort($rows);
            foreach ($rows as $field => $item) {
                if(!isset($rowRelationalDataTitle[$field])){
                    continue;
                }
                if($field == $sukKey || $field == $qtyKey || $field == $priceKey || $field == $totalPriceKey ){
                    if(!isset($productKeyArray[$rows[$referenceKey]])) $productKeyArray[$rows[$referenceKey]] = 0;

                    $rowRelationalData[$rows[$referenceKey]]['order_product'][$productKeyArray[$rows[$referenceKey]]][$rowRelationalDataTitle[$field]] = trim($item);
                }else{
                    $rowRelationalData[$rows[$referenceKey]][$rowRelationalDataTitle[$field]] = trim($item);
                }
            }
            $productKeyArray[$rows[$referenceKey]]++;
        }
        return $rowRelationalData;
    }

    /**
     * 格式化数据
     * @return [type] [description]
     */
    private function formatData($uploadData)
    {
        $rowRelationalTitle = $this->rowRelationalTitle;
        $productRelationalTitle = $this->productRelationalTitle;

        $rowRelationalDataTitle = array();
        $productRelationalDataTitle = array();
        foreach ($uploadData[0] as $key => $value) {
            if(($rowKey = array_search($value , $rowRelationalTitle)) !== FALSE){
                $rowRelationalDataTitle[$key] = $rowKey;
            }else{
                foreach ($productRelationalTitle as $relationalKey => $relationalValue) {
                    if(preg_match("/^{$relationalValue}$/" , $value , $matches )){
                        if(!isset($matches[1])){
                            continue;
                        }
                        $productRelationalDataTitle[$matches[1]-1][$key] = $relationalKey;
                        continue;
                    }
                }
            }
        }

        unset($uploadData[0]);
        $rowRelationalData = array();
        foreach ($uploadData as  $key => $rows) {
            ksort($rows);

            foreach ($rows as $field => $item) {
                if(isset($rowRelationalDataTitle[$field])){
                    $rowRelationalData[$key+1][$rowRelationalDataTitle[$field]] = trim($item);
                }else{
                    foreach ($productRelationalDataTitle as $productRelationalDataTitleKey => $productRelationalDataTitleValue) {
                        if(isset($productRelationalDataTitleValue[$field])){
                            if(trim($item) == ''){
                                continue;
                            }
                            // echo $productRelationalDataTitleKey;
                            $rowRelationalData[$key+1]['order_product'][$productRelationalDataTitleKey][$productRelationalDataTitleValue[$field]] = trim($item);
                            continue;
                        }
                    }

                }
            }

        }

        return $rowRelationalData;
    }


    /**
     * 验证数据
     * @param  [type] $row [description]
     * @return [type]      [description]
     */
    private function validator($row)
    {
        $error = array();
        $newData = $row;

        $requireField =  array(
            'order_mode_type','warehouse_id','logistic_customer_code','pay_customer_code','storage_customer_code','country_id', 'oab_firstname' , 'oab_street_address1' , 'oab_phone',
            'grossWt','province_id','city_id','reference_no','pay_no','shipping_method','idNumber','IdType'

         );
        $customerAuth = new Zend_Session_Namespace("customerAuth");
        $customer   = $customerAuth->data;
        $customerId = $customer['id'];
        $customerCurrency = $customer['customer_currency'];

        foreach ($requireField as $value) {
            if(!isset($row[$value])){
                $error[$value] = $rowRelationalTitle[$value] . '必须填写';
            }else{
                $valueArray = explode('_' , $value);
                $valueArray2 = array_map('ucfirst' , $valueArray);
                $valueMethod = implode('' , $valueArray2);
                $validatorMethod = "validator{$valueMethod}";
                // echo $validatorMethod."<br />";
                if(method_exists($this , $validatorMethod)){
                    if(($validator = $this->$validatorMethod($row[$value] , $newData)) !== true){
                        $error[$value] = $validator;
                    }
                }
            }
        }
        //验证产品
        $productError = $this->validatorOrderProduct($newData['order_product']);

        if(!empty($productError)){
            $error['order_product'] = $productError;
        }



        $newData['customer_id'] = $customerId;
        if($newData['currency_code'] == ''){
            $newData['customer_currency']   =   $customerCurrency;
        }else{
            $newData['customer_currency'] = $newData['currency_code'];
        }

        $newData['charge']  =   '';

        return array('data'=>$newData , 'error' => $error);

    }

    /**
     * 产品
     * @param  [type] &$products [description]
     * @return [type]            [description]
     */
    private function validatorOrderProduct(&$products){
        if(empty($products)){
            return array('产品为空！');
        }

        $customerAuth = new Zend_Session_Namespace("customerAuth");
        $customer   = $customerAuth->data;
        $customerId = $customer['id'];
        $error = array();
        foreach ($products as $key => $productInfo) {
            if(count($productInfo) != 4){
                $error[$key] = "第{$key}个产品长度不对！";
                continue;
            }

            $condition = array(
                    'customer_id'=>$customerId,
                    'product_sku'=>$productInfo['sku'],
            );
            $orderInfoAll = Service_Product::getByCondition($condition,'*','',1,1); //取一条
            if(!$orderInfoAll){
                $error[$key] = "[{$productInfo['sku']}]产品不存在！";
            }else
            {
              $products[$key]['product_id'] =   $orderInfoAll[0]['product_id'];
              // $products[$key]['']
            }

        }
        return $error;
    }

    /**
     * 证件类型
     * @param [type] $type     [description]
     * @param [type] &$newData [description]
     */
    public function validatorIdType($type , &$newData)
    {
        $array = array(
            1 => '身份证',
            2 => '军官证',
            3 => '护照',
            4 => '其它'
        );
        if($type == ''){
            return  Ec_Lang::getInstance()->getTranslate('IDType').Ec_Lang::getInstance()->getTranslate('require');
        }
        if(($key = array_search($type, $array)) !== false){
            $newData['IdType'] = $key;
            $newData['IdTypeCode'] = $type;
            return true;
        }else
            return '证件类型不正确';
    }

    /**
     * 证件号码
     * @param  [type] $type     [description]
     * @param  [type] &$newData [description]
     * @return [type]           [description]
     */
    private function validatorIdNumber($type , &$newData)
    {
        if($type != ''){
            if(!preg_match("/^[0-9]{17}[0-9Xx]$/",$type)){
                return Ec_Lang::getInstance()->getTranslate('The_recipient_identification_number_must_be_18_legitimate_number');//"地址一必须填写";
            }
            return true;
        }else{
            return '收件人证件号码必填';
        }
    }
    /**
     * 收件人地址
     * @param  [type] $type     [description]
     * @param  [type] &$newData [description]
     * @return [type]           [description]
     */
    private function validatorOabStreetAddress1($type , &$newData){
        if($type!=''){
            $newData['oab_street_address1'] = $type;
            return true;
        }else{
            return '收件人地址不能为空！';
        }
    }

    /**
     * 收件人姓名
     * @param  [type] $type     [description]
     * @param  [type] &$newData [description]
     * @return [type]           [description]
     */
    private function validatorOabFirstname($type , &$newData){
        if($type!=''){
            $newData['oab_firstname'] = $type;
            $newData['oab_lastname']    =   '';
            return true;
        }else{
            return '收件人姓名不能为空！';
        }
    }
    /**
     * 支付单号
     * @param  [type] $type     [description]
     * @param  [type] &$newData [description]
     * @return [type]           [description]
     */
    private function validatorPayNo($type , &$newData)
    {
        if($type!=''){
            $ordersCount = Service_Orders::getByCondition(array('pay_no'=>$type),'count(*)');
            if($ordersCount>0){
                return '支付单号已经存在';
            }
            return true;
        }
    }

    /**
     * 验证交易订单号
     * @param  [type] $type     [description]
     * @param  [type] &$newData [description]
     * @return [type]           [description]
     */
    private function validatorReferenceNo($type , &$newData){
        if("" != $type){
            $ordersCount = Service_Orders::getByCondition(array('reference_no'=>$type) , 'count(*)');
            if($ordersCount>0){
                 return Ec_Lang::getInstance()->getTranslate('exists_CustomerReference_in_system');
            }else{
                $newData['reference_no'] = $type;
            }
        }
        return true;
    }
    /**
     * 验证运输方式
     * @return [type] [description]
     */
    private function validatorShippingMethod($type , &$newData){
        //$type = 'count(*)';
        $shippingMethodRow = Service_ShippingMethod::getByField($type,'sm_code');

        if(!isset($shippingMethodRow['sm_code'])){
            return '该仓库不支持该运输方式或运输方式不对';
        }
        $newData['sm_code'] = $shippingMethodRow['sm_code'];
        return true;
    }

    /**
     * 验证城市
     * @param  [type] $type     [description]
     * @param  [type] &$newData [description]
     * @return [type]           [description]
     */
    private function validatorCityId($type , &$newData){
        if(!empty($type)){
            if($newData['oab_country_id']=='49' || $newData['oab_country_id']=='50' || $newData['oab_country_id']=='51'){
                $cityNameArr = self::sysSubStr($type,strlen($type));
                if(in_array("市",$cityNameArr)){
                    $Arr2 =  self::sysSubStr($type,strlen($type)-3);
                    $NewCityName = implode("",$Arr2);
                }else{
                    $NewCityName = $type;
                }
                $cityCondition = array(
                    'parent_id'=>$newData['oab_state_id'],
                    'region_name_like'=>$NewCityName
                );
                $citys = Service_Region::getByCondition($cityCondition,'*');
                //$city = Service_Region::getByField($NewCityName,'region_name');
                //$city = Service_Region::getByField($NewCityName,'region_name');
                if(!empty($citys)){
                    $newData['oab_city_id'] = $citys[0]['region_id'];
                    $newData['oab_city'] = $type;
                }else{
                    //不报错
                    $newData['oab_city'] = $type;
                }
            }else{
                //不报错
                return "收件人城市不存在";
            }
        }else{
            return "收件人城市不能为空";
        }
        return true;
    }
    /**
     * 验证省份
     * @param  [type] $type     [description]
     * @param  [type] &$newData [description]
     * @return [type]           [description]
     */
    private function validatorProvinceId($type , &$newData){
        if($type != ''){
            if($newData['oab_country_id']=='49' || $newData['oab_country_id']=='50' || $newData['oab_country_id']=='51'){
                $provinceNameArr = self::sysSubStr($type,strlen($type));
                if(in_array("省",$provinceNameArr)){
                    $Arr2 =  self::sysSubStr($type,strlen($type)-3);
                    $newprovinceName = implode("",$Arr2);
                }else{
                    $newprovinceName = $type;
                }

                $province = Service_Region::getByField($newprovinceName,'region_name');
                if(empty($province)){
                    $condition = array();
                    $condition['region_name_like'] = mb_substr($newprovinceName,0,2,'UTF-8');
                    $condition['region_type'] = '1';
                    $provinces = Service_Region::getByCondition($condition);
                    if(count($provinces)>1){ $provinces =""; $province="";}
                    if($provinces){
                        $province = $provinces[0];
                    }
                }

                if(!empty($province)){
                    if($province['region_type']=='1'){
                            //是省份
                            $newData['oab_state_id'] = $province['region_id'];
                            $newData['oab_state'] = $type;
                    }else{
                        return Ec_Lang::getInstance()->getTranslate('not_province');
                    }
                }else{
                    return Ec_Lang::getInstance()->getTranslate('DoesNotExist');
                }
            }
        }else{
            return Ec_Lang::getInstance()->getTranslate('ProvinceRequire');
        }
        return true;
    }

    /**
     * 验证订单毛重
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    private function validatorGrossWt($type , &$newData)
    {
        if($type != ''){
            if(!(is_numeric($type) && $type>=0)){
                return '订单总毛重只能为数字';
            }
        }
        $newData['grossWt'] = $type;
        return true;
    }

    /**
     * 验证手机
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    private function validatorOabPhone($type , &$newData)
    {
        if($type == ''){
            return '收件人电话不能为空！';
        }
        $newData['oab_phone'] = $type;
        return true;
    }

    /**
     * 验证国家
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    private function validatorCountryId($type , &$newData)
    {
        $countryRow = Service_Country::getByField($type , 'country_code');

        if(!isset($countryRow['country_id'])){
            return "国家代码{$type}不存在";
        }
        $newData['oab_country_id'] = $countryRow['country_id'];
        return true;
    }

    /**
     * 验证物流仓储企业
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    private function validatorWarehouseId($type , &$newData){
        $warehouseRow = Service_Warehouse::getByField($type , 'warehouse_code');

        if(!isset($warehouseRow['warehouse_id']) || !$warehouseRow['warehouse_id']){
            return "找不到[{$type}]物流仓储企业";
        }
        $newData['to_warehouse_id'] = $newData['warehouse_id'] =  $warehouseRow['warehouse_id'];
        $newData['warehouse_code']  =   $warehouseRow['warehouse_code'];
        return true;
    }

    /**
     * 验证物流企业客户代码
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    private function validatorLogisticCustomerCode($type , &$newData){
        $logisticCustomerRows = Service_Customer::getByCondition(array(
            'is_shipping' => 1,
            'customer_code' => $type
        ),'customer_code');
        if(!isset($logisticCustomerRows[0])){
            return "找不到[{$type}]物流企业客户代码";
        }
        $newData['pay_customer_code'] = $storageCustomerRows[0]['customer_code'];
        return true;
    }

    /**
     * 验证支付企业客户代码
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    private function validatorPayCustomerCode($type , &$newData){
        $payCustomerRows = Service_Customer::getByCondition(array(
            'is_pay' => 1,
            'customer_code' => $type
        ),'customer_code');
        if(!isset($payCustomerRows[0])){
            return "找不到[{$type}]支付企业客户代码";
        }
        $newData['pay_customer_code'] = $payCustomerRows[0]['customer_code'];
        return true;
    }

    /**
     * 验证仓储企业客户代码
     * @param  [type] $type [description]
     * @return [type]       [description].
     * logistic_customer_code
     *   pay_customer_code
     *  storage_customer_code
     */
    private function validatorStorageCustomerCode($type , &$newData){
        $storageCustomerRows = Service_Customer::getByCondition(array(
            'is_storage' => 1,
            'customer_code' => $type
        ),'customer_code');
        if(!isset($storageCustomerRows[0])){
            return "找不到[{$type}]仓储企业客户代码";
        }
        $newData['storage_customer_code'] = $storageCustomerRows[0]['customer_code'];
        return true;
    }


    /**
     * 验证订单模式
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    private function validatorOrderModeType($type , &$newData)
    {
        if(($key = array_search($type , array('备货模式','集货模式'))) !== false){
            $newData['order_mode_type'] = $key;
            $newData['order_mode_type_code'] = $type;
            return true;
        }
        return '订单模式只能是备货模式或者集货模式';
    }

    public static function sysSubStr($string,$length)
    {
        $i = 0;
        while ($i < $length)
        {
            $stringTMP = substr($string,$i,1);
            if ( ord($stringTMP) >=224 )
            {
                $stringTMP = substr($string,$i,3);
                $i = $i + 3;
            }
            elseif( ord($stringTMP) >=192 )
            {
                $stringTMP = substr($string,$i,2);
                $i = $i + 2;
            }
            else
            {
                $i = $i + 1;
            }
            $stringLast[] = $stringTMP;
            //$stringLast = implode("",$stringLast);
        }
        return $stringLast;
    }

    /**
     * @author william-fan
     * @todo 检查运输方式是否有效
     */
    public static function checkSmValid($sm_code,$validShipType){
        $valuelid = false;
        if(!empty($validShipType)){
            foreach ($validShipType as $key=>$shipType){
                if($sm_code==$shipType['sm_code']){
                    return true;
                }
            }
        }
        return $valuelid;
    }

    /**
     * [checkModel description]
     * @return [type] [description]
     */
    private function checkModel($titleArray){
        foreach ($titleArray as $key => $value) {
            if(preg_match("/^产品sku(\d)$/" , $value)){
                return true;
            }
        }
        return false;
    }
}
