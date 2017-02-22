<?php
class Service_InventoryModifyProccess
{
    protected $_customerId = null;
    protected $_customerInfo = null;
    protected $_warehouseId = null;
    protected $_error;
    protected $_pro;
    protected $_receiving = array();
    protected $_date = '';

	public static function getStatus(){
		$status['0'] = '全部';
		$status['1'] = '待发送海关';
		$status['2'] = '已发送海关';
		$status['3'] = '海关已接收';
		$status['5'] = '海关已审核';
		$status['6'] = '审核不通过';
		return $status;
	}
    
    public function __construct($pro = 'I')
    {
        $this->setCustomer();
        $this->_pro = $pro;
        $this->_date = date('Y-m-d H:i:s');
    }

    private function setCustomer($customerId = '')
    {
        $customerService = new Service_Customer();
        if (!isset($this->_customerId) && $customerId == '') {
            $customerInfo = $customerService->getLoginInfo();
            $customerRow = $customerInfo->customer;
        } elseif ($customerId != '') {
            $customerRow = $customerService->getByField($customerId);
        }
        $this->_customerId = $customerRow['customer_id'];
        $this->_customerInfo = $customerRow;
    }
	
	public static function validateProduct($data,$customerId = '')
	{
		$error 		= array();
		$goodIds	= array();
		//$hsCode		= Common_DataCache::getHsCode();
		//$prouctUom	= Common_DataCache::getProductUomCode();
		//$currencyCode		= Common_DataCache::getCurrencyCode();
		$customerInfo	= Service_Customer::getByField($customerId,'customer_id');
		$condition = array(
				'customer_code'=>$customerInfo['customer_code'],
				'warehouse_status'=>'5',
				'ie_type'=>'I',
		);
		$warehouseInfos = Service_Warehouse::getByCondition($condition,'*');
		if(empty($warehouseInfos)){
			$error[] ='未找到账册信息';
		}
		$warehouseInfo = $warehouseInfos[0];
		foreach($data as $key=>$val){
			if(empty($val['goodsId'])){
				$error[]	= '第'.$key.'条料件号不能为空';
			}else{
				if(in_array($val['goodsId'],$goodIds)){
					$error[]	= '第'.$key.'条料件号重复';
				}else{
					$goodIds[]	= $val['goodsId'];
				}
			}
			if(empty($val['registerId'])){
				$error[]	= '第'.$key.'条商品备案号不能为空';
			}
			if(empty($val['codeTs'])){
				$error[]	= '第'.$key.'条海关商品编码不能为空';
			}
			if(empty($val['nameCn'])){
				$error[]	= '第'.$key.'条商品名称不能为空';
			}
			if(0> $val['stockAll'] || !is_numeric($val['stockAll'])){
				$error[]	= '第'.$key.'条库存数量必须大于0';
			}
			if(empty($val['gUnit'])){
				$error[]	= '第'.$key.'条申报单位不能空';
			}
			if(empty($val['gModel'])){
				$error[]	= '第'.$key.'条规格型号不能为空';
			}
			if($val['declPrice']<=0){
				$error[]	= '第'.$key.'条申报价值必须大于0';
			}
			if(empty($val['currency'])){
				$error[]	= '第'.$key.'条申报币种不能空';
			}
			$productInventory	= Service_ProductInventory::getByWhere(
				array('goods_id'=>$val['goodsId'],
					'cus_goods_id'=>$val['registerId'],
				)
			);
			if(empty($productInventory) || $warehouseInfo['warehouse_code'] != $productInventory['warehouse_code']){
				$error[]	= '第'.$key.'条料件级库存不存在';
			}else{
				if($productInventory['stock_unit'] != $val['gUnit']){
					$error[]	= '第'.$key.'条申报单位和库存申报单位不一致';
				}
				if($productInventory['g_model'] != $val['gModel']){
					$error[]	= '第'.$key.'条规格型号和库存规格型号不一致';
				}
				if($productInventory['g_name_cn'] != $val['nameCn']){
					$error[]	= '第'.$key.'条商品名称和库存商品名称不一致';
				}
				if($productInventory['curr'] != $val['currency']){
					$error[]	= '第'.$key.'条币制和库存币制不一致';
				}
				if($productInventory['code_ts'] != $val['codeTs']){
					$error[]	= '第'.$key.'条海关商品编码和库存海关商品编码不一致';
				}
				if($productInventory['unit_1'] != $val['unit1']){
					$error[]	= '第'.$key.'条第一法定单位和库存第一法定单位不一致';
				}
			}
		}
		return $error;
	}
	
	public static function validateMerger($data,$customerId = '')
	{
		$error 			= array();
		$i 				= 1;
		$prouctUom		= Common_DataCache::getProductUomCode();
		$currencyCode	= Common_DataCache::getCurrencyCode();
		$country		= Common_DataCache::getCountryCode();
		$hsCode			= Common_DataCache::getHsCode();
		foreach($data as $key=>$val){
			$receivingInfo = array();
			if($i != $val['gNo']){
				$error[]	= '第'.$key.'条顺序号填写错误';
			}
			if('' == $val['declNum']){
				$error[]	= '第'.$key.'条报关单号不能为空';
			}else{
				$receivingInfo	= Service_Receiving::getByField($val['declNum'],'declaration_number');
				if(empty($receivingInfo)){
					$error[]	= '第'.$key.'条报关单号不存在';
				}
			}
			if('' == $val['mergerNo']){
				$error[]	= '第'.$key.'条入区报关单项号不能为空';
			}
			if(empty($val['codeTs'])){
				$error[]	= '第'.$key.'条海关商品编码不能为空';
			}
			if('' == $val['nameCn']){
				$error[]	= '第'.$key.'条商品名称不能为空';
			}
			if('' == $val['gModel']){
				$error[]	= '第'.$key.'条规格型号不能为空';
			}
			if('' == $val['gUnit']){
				$error[]	= '第'.$key.'条申报单位不能为空';
			}
			if(0 > $val['stockAll'] || !is_numeric($val['stockAll'])){
				$error[]	= '第'.$key.'条申报数量填写错误';
			}
			if(0 >= $val['declTotal'] || !is_numeric($val['declTotal'])){
				$error[]	= '第'.$key.'条总价填写错误';
			}
			if(empty($val['currency'])){
				$error[]	= '第'.$key.'条申报币种不能空';
			}
			if(!empty($val['originCountry'])){
				if(!isset($country[$val['originCountry']])){
					$error[]	= '第'.$key.'条原产国填写错误';
				}
			}
			if('' != $val['mergerNo'] && !empty($receivingInfo)){
				$receivingInventory = Service_ReceivingInventory::getByWhere(array('receiving_code'=>$receivingInfo['receiving_code'],'merge_g_no'=>$val['mergerNo']));
				if(empty($receivingInventory)){
					$error[]	= '第'.$key.'条项号级库存不存在';
				}else{
					if($receivingInventory['code_ts'] != $val['codeTs']){
						$error[]	= '第'.$key.'条海关商品编码和库存海关商品编码不一致';
					}else{
						$uomMap = Service_HsUom::getByField($val['codeTs'],'hs_code');
						if($val['unit1'] != $uomMap['pu_code_law']){
							$error[]	= '第'.$key.'条法定单位填写错误';
						}
						if(0 > $val['qty1'] || !is_numeric($val['qty1'])){
							$error[]	= '第'.$key.'条法定数量填写错误';
						}
					}
					if($receivingInventory['stock_unit'] != $val['gUnit']){
						$error[]	= '第'.$key.'条申报单位和库存申报单位不一致';
					}
					if($receivingInventory['curr'] != $val['currency']){
						$error[]	= '第'.$key.'条币制和库存币制不一致';
					}
				}
			}
			$i ++;
		}
		return $error;
	}
	
	public static function validate($data,$customerId = '')
	{
		$error 	= array();
		$customerInfo	= Service_Customer::getByField($customerId,'customer_id');
		if(1 != $customerInfo['is_storage']){
			$error[] = "仓储企业才能新增账册调整";
		}
		if('' == $data['customs_code']){
			$error[] = '申报海关不能为空';
		}else{
			$ieport = Service_IePort::getByField($data['customs_code'],"ie_port");
			if(empty($ieport)){
				$error[] = '申报海关填写错误';
			}
		}
		if('' == $data['ie_port']){
			$error[] = '进出口岸不能为空';
		}else{
			$ieport = Service_IePort::getByField($data['ie_port'],"ie_port");
			if(empty($ieport)){
				$error[] = '进出口岸填写错误';
			}
		}
		if('' == $data['ie_flag']){
			$error[] = '进出口类型不能为空';
		}else{
			if('I' != $data['ie_flag'] && 'E' != $data['ie_flag']){
				$error[] = '进出口类型填写错误';
			}
		}
		if('' == $data['ems_no']){
			$error[] = '账册号不能为空';
		}else{
			$warehouseInfo	= Service_Warehouse::getByField($data['ems_no'],'warehouse_code');
			if(empty($warehouseInfo)){
				$error[] = '账册号不存在';
			}else{
				if($warehouseInfo['customer_code'] != $customerInfo['customer_code']){
					$error[] = '账册号填写错误';
				}
				if(5 != $warehouseInfo['warehouse_status']){
					$error[] = '账册号不可用';
				}
			}
		}
		if('' == $data['wh_code']){
			$error[] = '仓储企业代码不能为空';
		}else{
			$storageInfo	= Service_Customer::getByField($data['wh_code'],'customer_code');
			if(empty($storageInfo)){
				$error[] = '仓储企业代码不存在';
			}
		}
		if('' == $data['wh_name']){
			$error[] = '仓储企业名称不能为空';
		}
		if('' == $data['agent_code']){
			$error[] = '仓储企业代码不能为空';
		}else{
			$agentInfo	= Service_Customer::getByField($data['agent_code'],'customer_code');
			if(empty($agentInfo)){
				$error[] = '仓储企业代码不存在';
			}
		}
		if('' == $data['agent_name']){
			$error[] = '仓储企业名称不能为空';
		}
		if(!preg_match('/^[0-9a-zA-Z]{10}$/',$data['ebc_code'])){
			$error[] = '电商企业编码必须是10位数字或字母';
		}
		if('' == $data['ebc_name']){
			$error[] = '电商企业名称不能为空';
		}
		if('' == $data['decl_by']){
			$error[] = '申报人不能为空';
		}
		if('' == $data['decl_time']){
			$error[] = '申报日期人不能为空';
		}
		if('' == $data['note']){
			$error[] = '调整原因不能为空';
		}
		return $error;
	}
	
    public function createTransaction($data,$customerId = '')
    {
        $result = array('ask' => 0, 'msg' => '', 'error' => array(), 'code' => '');
        $error = self::validate($data,$customerId);
		$inventoryUpload	= new Zend_Session_Namespace('inventoryUpload');
		if(isset($inventoryUpload->productUploadData)){
			$products			= $inventoryUpload->productUploadData;
		}else{
			$products			= @$data['products'];
		}
		if(isset($inventoryUpload->mergerUploadData)){
			$mergers	= $inventoryUpload->mergerUploadData;
		}else{
			$mergers	= @$data['mergers'];
		}
		if(empty($products)){
			$error[] = '料件级库存不能为空';
		}
		if(empty($mergers)){
			$error[] = '项号级库存不能为空';
		}
        if(!empty($error)){
        	$result['error'] = $error;
        	return $result;
        }
        try {
            $DB = Common_Common::getAdapter();
            $DB->beginTransaction();
			unset($data['module']);
			unset($data['controller']);
			unset($data['action']);
			unset($data['customerId']);
            $date = date('Y-m-d H:i:s');
            if ($customerId) {
            	$this->setCustomer($customerId);
            }
            $code = self::createCode();
            $inventoryParam['im_code']			= $code;
            $inventoryParam['customer_id']		= $customerId;
            $inventoryParam['customer_code'] 	= $this->_customerInfo['customer_code'];
            $inventoryParam['add_time']			= $date;
            $inventoryParam['update_time']		= $date;
            $inventoryParam['status'] 			= '1';
            
			foreach($data as $key=>$val){
				if(!is_array($val)){
					$inventoryParam[$key]	= trim($val);
				}
			}
            $lastId = Service_InventoryModify::add($inventoryParam);
			if(!$lastId){
				throw new Exception('账册调整添加失败');
			}
			$warehouseInfo	= Service_Warehouse::getByField(trim($data['ems_no']),'warehouse_code');
			if(!Service_Warehouse::update(
				array(
					'warehouse_status'=>1,
					'update_time'=>$date
				),$warehouseInfo['warehouse_id'])){
					throw new Exception('账册暂停失败');
			}
			$aWarehouse = array(
				'warehouse_id'	=> $warehouseInfo['warehouse_id'],
				'warehouse_code'=> $warehouseInfo['warehouse_code'],
				'type'			=> 0,
				'status_from'	=> $warehouseInfo['warehouse_status'],
				'status_to'		=> 1,
				'ip'			=> Common_Common::getIP(),
				'comments'		=> '账册调整，状态变更',
				'user_id'		=> -1,
				'account_code'	=> $this->_customerInfo['customer_code'],
				'add_time'		=> $date,
			);
			if(!Service_WarehouseLog::add($aWarehouse)){
				throw new Exception('账册日志添加失败');
			}
			$log = array(
				'im_code'=>$code,
				'type' => 0,
				'user_id'=>'0',
				'customer_code'=>$this->_customerInfo['customer_code'],
				'status_from'=>1,
				'status_to'=>1,
				'note' => 'create',
				'add_time'=>$date,
				'ip'=>Common_Common::getIP(),
			);
			if(!Service_InventoryModifyLog::add($log)){
				throw new Exception('账册调整日志添加失败');
			}
			$receivingConditon	= array(
				'customer_code' => $this->_customerInfo['customer_code'],
				'status_array'	=> array('4','5','6'),
			);
			$onwayProduct	= array();
			$receivingAll	=	Service_Receiving::getByCondition($receivingConditon);
			foreach($receivingAll as $key=>$val){
				$receivingDetail = Service_ReceivingDetail::getByCondition(array('receiving_code'=>$val['receiving_code']));
				foreach($receivingDetail as $k=>$v){
					if(isset($onwayProduct[$v['goods_id']])){
						$onwayProduct[$v['goods_id']] += $v['g_qty'];
					}else{
						$onwayProduct[$v['goods_id']] = $v['g_qty'];
					}
				}
			}
			foreach($products as $key=>$val){
				$productInventory	= Service_ProductInventory::getByWhere(
					array('goods_id'=>$val['goodsId'],
						'cus_goods_id'=>$val['registerId'],
					)
				);
				if($productInventory['stock_frozen'] >0 ){
					throw new Exception('料件号'.$val['goodsId'].'有冻结库存,不能调整');
				}
				if(isset($onwayProduct[$val['goodsId']])){
					throw new Exception('料件号'.$val['goodsId'].'有在途库存,不能调整');
				}
				
				$productParam = array(
					'im_code'			=> $code,
					'cus_goods_id'		=> $val['registerId'],
					'goods_id'			=> $val['goodsId'],
					'code_ts'			=> $val['codeTs'],
					'g_name'			=> $val['nameCn'],
					'stock_all'			=> $val['stockAll'],
					'stock_all_bf'		=> $productInventory['stock_qty'],
					'unit_1'			=> $val['unit1'],
					'g_model'			=> $val['gModel'],
					'g_unit'			=> $val['gUnit'],
					'decl_price'		=> $val['declPrice'],
					'curr'				=> $val['currency'],
            	);
            	if(!Service_InventoryModifyProduct::add($productParam)){
					throw new Exception('料件号'.$val['goodsId'].'添加失败');
            	}
			}
			if(!empty($mergers)){
				foreach($mergers as $key=>$val){
					$receivingInfo	= Service_Receiving::getByField($val['declNum'],'declaration_number');
					$receivingInventory = Service_ReceivingInventory::getByWhere(array('receiving_code'=>$receivingInfo['receiving_code'],'merge_g_no'=>$val['mergerNo']));
					$mergersParam = array(
						'im_code'			=> $code,
						'seq_id'			=> $val['gNo'],
						'i_form_id'			=> $val['declNum'],
						'i_form_item'		=> $val['mergerNo'],
						'code_ts'			=> $val['codeTs'],
						'g_name'			=> $val['nameCn'],
						'stock_all'			=> $val['stockAll'],
						'stock_all_bf'		=> $receivingInventory['qty'],
						'g_unit'			=> $val['gUnit'],
						'qty_1'				=> $val['qty1'],
						'qty_1_bf'			=> $receivingInventory['qty_1'],
						'unit_1'			=> $val['unit1'],
						'g_model'			=> $val['gModel'],
						'total_price'		=> $val['declTotal'],
						'curr'				=> $val['currency'],
						'origin_country'	=> $val['originCountry'],
					);
					if($receivingInventory['stock_frozen'] >0 ){
						throw new Exception('入库单号:'.$receivingInfo['receiving_code'].'项号:'.$val['mergerNo'].'有冻结库存,不能调整');
					}
					if('I' == $inventoryParam['ie_flag']){
						if('' == $val['originCountry']){
							throw new Exception('第'.$key.'条原产国不能为空');
						}
					}
					if(!Service_InventoryModifyMerger::add($mergersParam)){
						throw new Exception('项号级库存'.$val['mergerNo'].'添加失败');
					}
				}
			}
            $result['ask']='1';
            $result['msg'] = sprintf('账册调整新增成功',$code);
            $result['code'] = $code;
            $DB->commit();
			unset($inventoryUpload->productUploadData);
			unset($inventoryUpload->mergerUploadData);
        }  catch (Exception $e) {
            $DB->rollBack();
            $result['error'][] = $e->getMessage();
            $result['msg'] = $e->getMessage();
            return $result;
        }
        return $result;    
    }
	
    public function createCode()
    {
        $this->_pro = strtoupper($this->_pro);
        return Common_GetNumbers::getCode('inventoryModify', 8, 'I'.$this->_customerInfo['customer_code']);
    }
	
    public static function createAsnLog($row)
    {
        $row['rl_add_time'] = date('Y-m-d H:i:s');
        $row['rl_ip'] = Common_Common::getIP();
        Service_ReceivingLog::add($row);
    }
}

?>