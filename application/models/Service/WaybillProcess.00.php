<?php
class Service_WaybillProcess {
	protected $_error = array();
	protected $_param = null;
	public $_date = null;
	protected $_customerId = null;
	protected $_customer = null;
	protected $_addData = null;
	protected $_updateData;

	public function __construct($data = array()) {
		$this->setUser();
		$this->_date = date('Y-m-d H:i:s');
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$p = '_' . $key;
				$this->$p = $value;
			}
		}
	}
	/**
	 * 初始化用户
	 */
	public function setUser() {
		$session = new Zend_Session_Namespace("customerAuth");
		$customer = $session->data;
		$this->_customerId = $customer['id'];
		$this->_customer = $customer;
	}

	/**
	 * 数据表字段
	 * @return multitype:string
	 */
	public static function getTitle() {
		return array(
			'customerCode' => '电商平台代码',
			'ebp_name' => '电商平台名称',
			'referenceNo' => '交易单号',
			'wbStatus' => '状态',
			'logNo' => '物流运单编号',
			'trafMode' => '运输方式',
			'shipName' => '运输工具名称',
			'voyageNo' => '航班航次号',
			'billNo' => '提运单号',
			'freight' => '运费',
			'goodsValue' => '订单商品货款',
			'currencyCode' => '币种',
			'insureFee' => '保价费',
			'weight' => '毛重',
			'netWeight' => '净重',
			'packNo' => '件数',
			'parcelInfo' => '包裹单信息',
			'goodsInfo' => '商品信息',
			'consignee' => '收货人名称',
			'consigneeCountry' => '收货人所在国',
			'consigneeProvince' => '收货人地址（省）',
			'consigneeCity' => '收货人地址（市）',
			'consigneeDistrict' => '收货人地址（区）',
			'consigneeAddress' => '收货人地址',
			'consigneeTelephone' => '收货人电话',
			'shipper' => '发货人',
			'shipperAddress' => '发货人地址',
			'shipperTelephone' => '发货人电话',
			'shipperCountry' => '发货人所在国',
			'note' => '备注',
			'appStatus' => '申报状态',
			'customsCode' => '主管海关代码',
			'logisticCustomerCode' => '物流企业客户代码',
			'ieType' => '进出口业务',
			'account_code' => '子账号代码',
		);
	}

	/**
	 * 字段对应关系
	 * @return multitype:string
	 */
	public static function getMap() {
		return array(
			'customerCode' => 'customer_code',
			'referenceNo' => 'reference_no',
			'logNo' => 'log_no',
			'trafMode' => 'traf_mode',
			'shipName' => 'ship_name',
			'voyageNo' => 'voyage_no',
			'billNo' => 'bill_no',
			'freight' => 'freight',
			'goodsValue' => 'goods_value',
			'currencyCode' => 'currency_code',
			'insureFee' => 'insure_fee',
			'weight' => 'weight',
			'netWeight' => 'net_weight',
			'packNo' => 'pack_no',
			'parcelInfo' => 'parcel_info',
			'goodsInfo' => 'goods_info',
			'consignee' => 'consignee',
			'consigneeCountry' => 'consignee_country',
			'consigneeProvince' => 'consignee_province',
			'consigneeCity' => 'consignee_city',
			'consigneeDistrict' => 'consignee_district',
			'consigneeAddress' => 'consignee_address',
			'consigneeTelephone' => 'consignee_telephone',
			'shipper' => 'shipper',
			'shipperAddress' => 'shipper_address',
			'shipperTelephone' => 'shipper_telephone',
			'shipperCountry' => 'shipper_country',
			'note' => 'note',
			'customsCode' => 'customs_code',
			'ebp_name' => 'ebp_name',
			//'logisticCustomerCode' => 'logistic_customer_code',
			'ieType' => 'ie_type',
			'account_code' => 'account_code',
			'logistic_customer_code' => 'logistic_customer_code',
			'logistic_enp_name' => 'logistic_enp_name',
		);
	}

	/**
	 * @author william-fan
	 * @todo 不判定是否匹配
	 */
	public static function notcheck() {
		return array(
            'note',
            'voyageNo',
        //    'billNo',
        	'trafMode',
        	'shipName'
        );
	}
	/**
	 * 验证数据
	 */
	protected function check($isInterface = false) {
		if (!$this->_param) {
			$this->_error[] = '请填写创建信息';
			return;
		}

		/*
			        $ieTypes = array(
			        'I' => '进口',
			        'E' => '出口'
			        );
		*/

		if (isset($this->_param['id']) && !empty($this->_param['id'])) {
			$row = Service_Waybill::getByField($this->_param['id'], 'wb_id');
			if ($row instanceof Zend_Db_Table_Row) {
				$row = $row->toArray();
			}
			if (empty($row)) {
				$this->_error[] = '单号不存在';
			} else {
				if ($row['wb_status'] == 0) {
					$this->_error[] = '状态不允许修改错误';
				}
			}
		}

		$title = self::getTitle();
		$map = self::getMap();
		//验证金额数字类型
		$amountRegular = '/^(([1-9]\d{0,9})|0)(\.\d{1,4})?$/';
		$amountRegKeyArr = array(
			'freight',
			'goodsValue',
			'insureFee',
			'weight',
			'netWeight',
			//    'packNo'
		);

		//不检测为空
		$noCheck = self::notcheck();
		foreach ($map as $key => $value) {
			if (!in_array($key, $noCheck)) {
				if (!isset($this->_param[$key]) || $this->_param[$key] === '') {
					$this->_error[] = '' . $title[$key] . '为必填项';
				}
			}
			if (isset($this->_param[$key]) && !empty($this->_param[$key])) {
				$this->_addData[$value] = $this->_param[$key];
				if ($key == 'note') {
					continue;
				}
				if (in_array($key, $amountRegKeyArr)) {
					if (!preg_match($amountRegular, $this->_param[$key])) {
						$this->_error[] = '' . $title[$key] . '格式错误';
					}
				}
			} else {
				$this->_addData[$value] = '';
			}
		}
		if (!empty($this->_error)) {
			return;
		}
		//
		$ieTypeArr = array_keys(self::getIeType());
		//接口判断
		if (!in_array($this->_addData['ie_type'], $ieTypeArr)) {
			$this->_error[] = '进出口类型错误';
		}
		//子账号
		$account_code = isset($this->_addData['account_code']) ? $this->_addData['account_code'] : '';
		if (!empty($account_code)) {
			$account = Service_Account::getByField($account_code, 'account_code');
			if (empty($account)) {
				$this->_error[] = '账号不存在';
			} else {
				if ($account['account_level'] != '1') {
					$this->_error[] = '不为子账号,不能操作';
				} else {
					//找到主账号信息
					$opFather = Service_Customer::getByField($account['customer_code'], 'customer_code');
					if (empty($opFather)) {
						$this->_error[] = '找不到子账号父账号信息';
					} else {
						if ($opFather['customer_status'] != '2') {
							$this->_error[] = '父账号非正常状态';
						} else {
							if ($opFather['customer_code'] != $this->_addData['logistic_customer_code']) {
								$this->_error[] = "物流企业代码:{$this->_addData['logistic_customer_code']}和备案名称:{$opFather['customer_code']}不一致";
							}
							if ($opFather['trade_name'] != $this->_addData['logistic_enp_name']) {
								$this->_error[] = "物流企业名称:{$this->_addData['logistic_enp_name']}和备案名称:{$opFather['trade_name']}不一致";
							}
						}
					}
					//  $this->_addData['logistic_customer_code'] = $this->_addData['account_code'];
					$this->_addData['account_name'] = $account['account_name'];
				}
			}
		}

		//检查运单表里的交易单号是否存在
		if (empty($this->_param['id'])) {
			$tmpRow = Service_Waybill::getByCondition(array('reference_no' => $this->_param['referenceNo']), array('wb_code'));
			if ($tmpRow) {
				$this->_error[] = '交易单号(' . $this->_param['referenceNo'] . ')已存在';
				return;
			}
			$tmpRow = Service_Waybill::getByCondition(array('log_no' => $this->_param['logNo']), array('wb_code'));
			if ($tmpRow) {
				$this->_error[] = '物流运单编号(' . $this->_param['logNo'] . ')已存在';
				return;
			}
		}

		if ($this->_addData['customer_code'] == '') {
			$this->_error[] = '电商平台代码必填';
		} else {
			$customer = Service_Customer::getByField($this->_addData['customer_code'], 'customer_code'); //电商企业
			if (!empty($customer)) {
				if ($customer['customer_status'] != '2') {
					$this->_error[] = '电商平台代码:' . $this->_addData['customer_code'] . '暂未审核通过';
				}
				if ($customer['is_ecommerce'] != '1') {
					$this->_error[] = '电商平台代码:' . $this->_addData['customer_code'] . '不是电商企业';
				}
				if ($customer['trade_name'] != $this->_addData['ebp_name']) {
					$this->_error[] = '电商平台名称:' . $this->_addData['ebp_name'] . '和备案名称:' . $customer['trade_name'] . '不一致';
				}
				/*
					                if($customer['ie_type']!=$this->_addData['ie_type']){
					                $this->_error [] = '电商企业进出口类型:'.$ieTypes[$this->_addData['ie_type']].'和备案进出口类型:'.$ieTypes[$customer['ie_type']].'不一致';
					                }
				*/
				if ($customer['customs_code'] != $this->_addData['customs_code']) {
					$this->_error[] = '电商的主管海关代码:' . $customer['customs_code'] . '和选择的:' . $this->_addData['customs_code'] . '不一致';
				}
			} else {
				$this->_error[] = '电商平台代码:' . $this->_addData['customer_code'] . '不存在';
			}
		}
		/*
			        if($opFather['customs_code']!=$this->_addData['customs_code']){
			        $this->_error [] = "物流企业的主管海关代码和所选的不一致";
			        }
			        if(!empty($opFather)){
			        if($opFather['ie_type']!=$this->_addData['ie_type']){
			        $this->_error[] = '物流企业代码的进出口类型和选择的不一致';
			        }
			        }
		*/
		// customs_code
		/*$iePorts = Service_IePort::getByField($this->_param['customsCode'], 'ie_port', array('ie_port'));
	        if(!$iePorts){
	        $this->_error[] = '主管海关代码('.$this->_param['customsCode'].')不存在';
*/

		// customs_code
		$customerData = Service_Customer::getByCondition(array('customer_code' => $this->_param['customerCode'], 'customs_code' => $this->_param['customsCode']), array('is_business_in', 'is_business_export', 'is_normal_in', 'is_normal_export'));
		if (empty($customerData)) {
			$this->_error[] = '申请企业编码与企业主管海关代码不一致';
		} else {
			// 进出口业务
			$customerData = $customerData[0];
			//    $eiTypes = array($customerData['business_type'], $customerData['is_business_in'], $customerData['is_business_export'], $customerData['is_normal_export']);
			$flag = true;
			$ieType = trim($this->_param['ieType']);
			switch ($ieType) {
			case $ieTypeArr[0]:
				if ($customerData['is_business_in']) {
					$flag = false;
				}
				break;
			case $ieTypeArr[1]:
				if ($customerData['is_business_export']) {
					$flag = false;
				}
				break;
			default:
				$flag = true;
				break;
			}
			//    if($customerData['ie_type'] != $this->_param['ieType']){
			if ($flag) {
				$this->_error[] = '企业进出口业务不相符';
			}
		}

		//traf_mode
		if (!is_numeric($this->_param['trafMode']) && $this->_param['trafMode'] != '-' ) {
			$trmData = Service_TrafMode::getByField($this->_param['trafMode'], 'traf_mode_name', array('tfm_id'));
			if (empty($trmData) || !is_array($trmData)) {
				$this->_error[] = '运输方式不存在';
			} else {
				$this->_addData['traf_mode'] = $trmData['tfm_id'];
			}
		}

		//接口调用 验证国家
		if ($isInterface) {
			if (isset($this->_addData['consignee_country']) && !empty($this->_addData['consignee_country'])) {
				$countryData = Service_Country::getByField($this->_addData['consignee_country'], 'country_code', array('country_id'));
				if (empty($countryData) || !is_array($countryData)) {
					$this->_error[] = '收货人所在国简码错误';
				}
			}

			if (isset($this->_addData['shipper_country']) && !empty($this->_addData['shipper_country'])) {
				$countryData = Service_Country::getByField($this->_addData['shipper_country'], 'country_code', array('country_id'));
				if (empty($countryData) || !is_array($countryData)) {
					$this->_error[] = '发货人所在国简码错误';
				}
			}
		}

		//ship_name 空值为 - 
        if($this->_param['shipName'] != '-'){
			$trafTools = Service_TrafTool::getByField($this->_param['shipName'], 'traf_tool_name', array('traf_tool_name'));
			if (!$trafTools) {
				$this->_error[] = '运输方式(' . $this->_param['shipName'] . ')不存在';
			}
        }
		//检查订单表里的交易单号是否存在
		$order = Service_Orders::getByCondition(array('reference_no' => $this->_param['referenceNo'], 'ecommerce_platform_customer_code' => $this->_param['customerCode']), array('order_code'));
		if (!$order) {
			$this->_addData['order_code'] = '';
			//$this->_error[] = '交易单订单号('.$this->_param['referenceNo'].')不存在';
		} else {
			$this->_addData['order_code'] = $order[0]['order_code'];
		}

		if (!empty($this->_error)) {
			return;
		}
	}

	/**
	 * 运单数据封装
	 */
	public static function conversionParameter($wbData) {

		if (empty($wbData)) {
			return false;
		}

		//traf_mode
		if (!empty($wbData['traf_mode'])) {
			$trafData = Service_TrafMode::getByField($wbData['traf_mode'], 'tfm_id');
			if (!empty($trafData)) {
				$wbData['traf_mode_name'] = $trafData['traf_mode_name'];
			} else {
				$wbData['traf_mode_name'] = '未知';
			}
		}

		//customs_code
		if (!empty($wbData['customs_code'])) {
			$iePortData = Service_IePort::getByField($wbData['customs_code'], 'ie_port', array('ie_port', 'ie_port_name'));
			if (!empty($iePortData)) {
				$wbData['customs_code'] = $iePortData['ie_port'] . '-' . $iePortData['ie_port_name'];
			} else {
				$wbData['customs_code'] = '未知';
			}
		}

		//currency_code
		if (!empty($wbData['currency_code'])) {
			$currencyData = Service_Currency::getByField($wbData['currency_code'], 'currency_code', array('currency_code', 'currency_name'));
			if (!empty($currencyData)) {
				// $wbData['currency_code'] = $currencyData['currency_code'].'-'.$currencyData['currency_name'];
				$wbData['currency_code'] = $currencyData['currency_code'];
			} else {
				$wbData['currency_code'] = '未知币种';
			}
		}
		//customer_code - trade_name
		if (!empty($wbData['customer_code'])) {
			$customerData = Service_Customer::getByField($wbData['customer_code'], 'customer_code', array('trade_name'));
			if (!empty($customerData)) {
				$wbData['customer_code'] = $wbData['customer_code'] . '-' . $customerData['trade_name'];
			}
		}
		//logistic_customer_code - trade_name
		if (!empty($wbData['logistic_customer_code'])) {
			$customerData = Service_Customer::getByField($wbData['logistic_customer_code'], 'customer_code', array('trade_name'));
			if (!empty($customerData)) {
				$wbData['logistic_customer_code'] = $wbData['logistic_customer_code'] . '-' . $customerData['trade_name'];
			}
		}

		$appTypes = self::getAppType();
		$appStatus = self::getAppStatus();
		$ciqStatus = Service_Waybill::getCiqStatus();
		//$wbData['app_type'] = $appTypes[$wbData['app_type']];
		$wbData['app_status'] = $appStatus[$wbData['app_status']];
		$wbData['ciq_status'] = $ciqStatus[$wbData['ciq_status']];

		return $wbData;
	}

	/**
	 * 创建运单
	 */
	public function create($isInterface = false) {
		$return = array('ask' => 0, 'message' => '');
		$this->check($isInterface);
		if (!empty($this->_error)) {
			$return['message'] = $this->_error;
			return $return;
		}
		$result = 0;

		if (empty($this->_param['id'])) {
			$this->_addData['wb_status'] = 1;
			$addRow = $this->_addData;
			$wb_code = Common_GetNumbers::getCode('waybill', 10, 'WB', '运单编号');
			//重写
			$addRow = array(
				'wb_code' => $wb_code,
				'ie_type' => $this->_addData['ie_type'],
				'customs_code' => $this->_addData['customs_code'],
				'order_code' => $this->_addData['order_code'],
				'reference_no' => $this->_addData['reference_no'],
				'customer_code' => $this->_addData['customer_code'],
				'ebp_name' => $this->_addData['ebp_name'],
				'logistic_customer_code' => $this->_addData['logistic_customer_code'],
				'logistic_enp_name' => $this->_addData['logistic_enp_name'],
				'logistic_account_code' => $this->_addData['account_code'],
				//'wb_status'=>$this->_addData['logistic_customer_code'],
				'log_no' => $this->_addData['log_no'],
				'traf_mode' => $this->_addData['traf_mode'],
				'ship_name' => $this->_addData['ship_name'],
				'voyage_no' => $this->_addData['voyage_no'],
				'bill_no' => $this->_addData['bill_no'],
				'freight' => $this->_addData['freight'],
				'goods_value' => $this->_addData['goods_value'],
				'currency_code' => $this->_addData['currency_code'],
				'insure_fee' => $this->_addData['insure_fee'],
				'weight' => $this->_addData['weight'],
				'net_weight' => $this->_addData['net_weight'],
				'pack_no' => $this->_addData['pack_no'],
				'parcel_info' => $this->_addData['parcel_info'],
				'goods_info' => $this->_addData['goods_info'],
				'consignee' => $this->_addData['consignee'],
				'consignee_country' => $this->_addData['consignee_country'],
				'consignee_province' => $this->_addData['consignee_province'],
				'consignee_city' => $this->_addData['consignee_city'],
				'consignee_district' => $this->_addData['consignee_district'],
				'consignee_address' => $this->_addData['consignee_address'],
				'consignee_telephone' => $this->_addData['consignee_telephone'],
				'shipper' => $this->_addData['shipper'],
				'shipper_address' => $this->_addData['shipper_address'],
				'shipper_telephone' => $this->_addData['shipper_telephone'],
				'shipper_country' => $this->_addData['shipper_country'],
				'note' => $this->_addData['note'],
				'wb_add_time' => $this->_date,
				'wb_update_time' => $this->_date,
				'app_type' => $this->_addData['app_type'],
				'update_time' => $this->_date,
			);
			$db = Common_Common::getAdapter();
			$db->beginTransaction();
			try {
				//验证只有子账号才能操作
				if (!$isInterface) {
					Service_Account::getAccountTypeException($addRow['logistic_account_code']);
				}
				$wbId = Service_Waybill::add($addRow);
				if (!$wbId) {
					throw new Exception('新增运单异常', 500);
				}

				$acData = Service_Account::getByField($addRow['logistic_account_code'], 'account_code', array('account_id', 'account_name'));
				$userId = !empty($this->_customer['id']) ? $this->_customer['id'] : $acData['account_id'];
				$userName = !empty($this->_customer['account_name']) ? $this->_customer['account_name'] : $acData['account_name'];

				$wblData = array(
					'wb_id' => $wbId,
					'wb_code' => $wb_code,
					'wb_status_from' => 1,
					'wb_status_to' => 1,
					'wb_add_time' => $this->_date,
					'user_id' => empty($userId) ? 0 : $userId,
					'wb_ip' => Common_Common::getRealIp(),
					'wb_comments' => '新增运单',
					'account_name' => empty($userName) ? 'interface' : $userName,
				);
				$wlId = Service_WaybillLog::add($wblData);
				if (!$wlId) {
					throw new Exception("运单日志写入异常", 501);
				}
				$db->commit();
				//    $db->rollback();
				$return['ask'] = 1;
				$return['wb_code'] = $wb_code;
				$return['message'] = '添加成功';
			} catch (Exception $e) {
				$db->rollback();
				$return = array('ask' => 0, 'message' => $e->getMessage(), 'errorCode' => $e->getCode());
			}
		} else {
			//    $updateRow = $this->_addData;
			$updateRow = array(
				'ie_type' => $this->_addData['ie_type'],
				'customs_code' => $this->_addData['customs_code'],
				'order_code' => $this->_addData['order_code'],
				'reference_no' => $this->_addData['reference_no'],
				'customer_code' => $this->_addData['customer_code'],
				'ebp_name' => $this->_addData['ebp_name'],
				'logistic_customer_code' => $this->_addData['logistic_customer_code'],
				'logistic_enp_name' => $this->_addData['logistic_enp_name'],
				'logistic_account_code' => $this->_addData['account_code'],
				//'wb_status'=>$this->_addData['logistic_customer_code'],
				'log_no' => $this->_addData['log_no'],
				'traf_mode' => $this->_addData['traf_mode'],
				'ship_name' => $this->_addData['ship_name'],
				'voyage_no' => $this->_addData['voyage_no'],
				'bill_no' => $this->_addData['bill_no'],
				'freight' => $this->_addData['freight'],
				'goods_value' => $this->_addData['goods_value'],
				'currency_code' => $this->_addData['currency_code'],
				'insure_fee' => $this->_addData['insure_fee'],
				'weight' => $this->_addData['weight'],
				'net_weight' => $this->_addData['net_weight'],
				'pack_no' => $this->_addData['pack_no'],
				'parcel_info' => $this->_addData['parcel_info'],
				'goods_info' => $this->_addData['goods_info'],
				'consignee' => $this->_addData['consignee'],
				'consignee_country' => $this->_addData['consignee_country'],
				'consignee_province' => $this->_addData['consignee_province'],
				'consignee_city' => $this->_addData['consignee_city'],
				'consignee_district' => $this->_addData['consignee_district'],
				'consignee_address' => $this->_addData['consignee_address'],
				'consignee_telephone' => $this->_addData['consignee_telephone'],
				'shipper' => $this->_addData['shipper'],
				'shipper_address' => $this->_addData['shipper_address'],
				'shipper_telephone' => $this->_addData['shipper_telephone'],
				'shipper_country' => $this->_addData['shipper_country'],
				'note' => $this->_addData['note'],
				'app_type' => $this->_addData['app_type'],
				'update_time' => $this->_date,
			);
			$db = Common_Common::getAdapter();
			$db->beginTransaction();
			try {
				//验证只有子账号才能操作
				Service_Account::getAccountTypeException($updateRow['logistic_account_code']);
				$result = Service_Waybill::update($updateRow, $this->_param['id']);
				if ($result) {
					$db->commit();
					//    $db->rollback();
					$return['ask'] = 1;
					$return['message'] = '修改成功';
				} else {
					throw new Exception('更新运单异常', 500);
				}
			} catch (Exception $e) {
				$db->rollback();
				$return = array('ask' => 0, 'message' => $e->getMessage(), 'errorCode' => $e->getCode());
			}
		}
		return $return;
	}

	/**
	 * [updateTransaction 更新]
	 * @return [type] [description]
	 */
	public function updateTransaction($where) {
		$return = array('ask' => 0, 'message' => '');
		if (empty($where) || !is_array($where)) {
			$return['message'] = '参数错误';
			return $return;
		}
		$this->updateCheck();
		if (!empty($this->_error)) {
			$return['message'] = $this->_error;
			return $return;
		}
		$waybillData = Service_Waybill::getByWhere($where, array('wb_id', 'wb_code', 'app_status'));
		//不存在 -- 运单状态为草单
		if (empty($waybillData) || !is_array($waybillData) || $waybillData['app_status'] != 3) {
			$return['message'] = '运单不存在或者状态不可修改(异常状态可修改)';
			return $return;
		}
		$db = Common_Common::getAdapter();
		$db->beginTransaction();
		try {
			$result = Service_Waybill::update($this->_updateData, $waybillData['wb_id']);
			if (!$result) {
				throw new Exception('更新运单异常或者未做修改', 500);
			}
			$wblData = array(
				'wb_id' => $waybillData['wb_id'],
				'wb_code' => $waybillData['wb_code'],
				'wb_status_from' => $waybillData['app_status'],
				'wb_status_to' => $waybillData['app_status'],
				'wb_add_time' => $this->_date,
				'user_id' => -1,
				'wb_ip' => Common_Common::getRealIp(),
				'wb_comments' => '接口修改运单',
				'account_name' => 'interface',
			);
			$wlId = Service_WaybillLog::add($wblData);
			if (!$wlId) {
				throw new Exception("运单日志写入异常", 501);
			}
			$db->commit();
			//    $db->rollback();
			$return['ask'] = 1;
			$return['wb_code'] = $waybillData['wb_code'];
			$return['message'] = '修改成功';
		} catch (Exception $e) {
			$db->rollback();
			$return = array('ask' => 0, 'message' => $e->getMessage(), 'errorCode' => $e->getCode());
		}
		return $return;
	}

	/**
	 * -- simple
	 * [updateStatusTransaction 更新妥投状态]
	 * @return [type] [description]
	 */
	public function updateStatusTransaction() {
		$return = array('ask' => 0, 'message' => '');
		$appStatus = self::getAppStatus();
		//条件
		$where = array(
			'log_no' => trim($this->_param['logNo']),
			'logistic_customer_code' => trim($this->_param['logisticsCode']),
			'logistic_enp_name' => trim($this->_param['logisticsName']),
			//'app_type' => trim($this->_param['appType']),
			'ie_type' => strtoupper((trim($this->_param['ieType']))),
			'wb_status' => 1,
		);

		$waybillData = Service_Waybill::getByWhere($where, array('wb_id', 'wb_code', 'app_status'));

		if (empty($waybillData) || !is_array($waybillData)) {
			$return['message'] = '运单不存在或者状态不可用';
			return $return;
		}

		// 海关已接收才能更新为妥投
		if ($waybillData['app_status'] != 5) {
			$return['message'] = '运单状态不为' . $appStatus[5] . ', 当前状态：' . $appStatus[$waybillData['app_status']];
			return $return;
		}
		$wbStatusTo = $waybillData['app_status'];
		$db = Common_Common::getAdapter();
		$db->beginTransaction();
		try {
			$wbCommit = 'interface更新妥投状态,';
			//已妥投
			if (isset($this->_param['deliveredStatus']) && $this->_param['deliveredStatus'] == 1) {
				$wbStatusTo = 6;
				$updateData = array(
					'app_status' => $wbStatusTo,
					'delivered_time' => $this->_param['deliveredDate'],
					'delivered_comment' => $this->_param['deliveredNote'],
				);
				$result = Service_Waybill::update($updateData, $waybillData['wb_id'], 'wb_id');
				if (!$result) {
					throw new Exception('更新运单异常', 500);
				}
				$wbCommit .= '妥投状态：已妥投;';
				//未妥投
				//}else if(isset($this->_param['deliveredStatus']) && $this->_param['deliveredStatus'] == 2){
			} else {
				$wbCommit .= '妥投状态：未妥投;';
			}

			if (isset($this->_param['deliveredDate']) && !empty($this->_param['deliveredDate'])) {
				$wbCommit .= '时间:' . $this->_param['deliveredDate'] . ';';
			}
			if (isset($this->_param['deliveredNote']) && !empty($this->_param['deliveredNote'])) {
				$wbCommit .= '备注:' . $this->_param['deliveredNote'];
			}

			$wblData = array(
				'wb_id' => $waybillData['wb_id'],
				'wb_code' => $waybillData['wb_code'],
				'wb_status_from' => $waybillData['app_status'],
				'wb_status_to' => $wbStatusTo,
				'wb_add_time' => $this->_date,
				'user_id' => -1,
				'wb_ip' => Common_Common::getRealIp(),
				'wb_comments' => $wbCommit,
				'account_name' => 'interface',
			);
			$wlId = Service_WaybillLog::add($wblData);
			if (!$wlId) {
				throw new Exception("运单日志写入异常", 501);
			}
			$db->commit();
			$return['ask'] = 1;
			$return['wb_code'] = $waybillData['wb_code'];
			$return['message'] = '妥投状态更新成功';
		} catch (Exception $e) {
			$db->rollback();
			$return = array('ask' => 0, 'message' => $e->getMessage(), 'errorCode' => $e->getCode());
		}
		return $return;
	}

	/**
	 * [updateCheck 更新检测]
	 * @return [type] [description]
	 */
	protected function updateCheck() {
		$title = self::getTitle();
		$map = self::getMap();
		//验证金额数字类型
		$amountRegular = '/^\d+(\.\d+)?$/';
		$amountRegKeyArr = array(
			'freight',
			'goodsValue',
			'insureFee',
			'weight',
			'netWeight',
			'packNo',
		);

		foreach ($map as $key => $value) {
			if (isset($this->_param[$key]) && !empty($this->_param[$key])) {
				$this->_updateData[$value] = $this->_param[$key];
				if (in_array($key, $amountRegKeyArr)) {
					if (!preg_match($amountRegular, $this->_param[$key])) {
						$this->_error[] = '' . $title[$key] . '格式错误';
					}
				}
			}
		}

		//账号信息
		$customerData = Service_Customer::getByField($this->_updateData['logistic_customer_code'], 'customer_code', array('customer_status', 'customer_code', 'trade_name', 'customs_code'));
		if (empty($customerData)) {
			$this->_error[] = '暂无该账号信息';
		} else {
			if ($customerData['customer_status'] != '2') {
				$this->_error[] = '账号非正常状态';
			}
		}

		//customs_code
		if (isset($this->_updateData['customs_code']) && !empty($this->_updateData['customs_code'])) {
			if ($customerData['customs_code'] != $this->_updateData['customs_code']) {
				$this->_error[] = "物流企业的主管海关代码不一致";
			}
		}

		//customer_code
		if (isset($this->_updateData['customer_code']) && !empty($this->_updateData['customer_code'])) {
			//电商企业
			$customer = Service_Customer::getByField($this->_updateData['customer_code'], 'customer_code', array('customer_status', 'is_ecommerce', 'trade_name', 'customs_code'));
			if (!empty($customer)) {
				if ($customer['customer_status'] != '2') {
					$this->_error[] = '电商平台代码:' . $this->_updateData['customer_code'] . '暂未审核通过';
				}
				if ($customer['is_ecommerce'] != '1') {
					$this->_error[] = '电商平台代码:' . $this->_updateData['customer_code'] . '不是电商企业';
				}
				if (isset($this->_updateData['ebp_name']) && !empty($this->_updateData['ebp_name'])) {
					if ($customer['trade_name'] != $this->_updateData['ebp_name']) {
						$this->_error[] = '电商平台名称:' . $this->_updateData['ebp_name'] . '和备案名称:' . $customer['trade_name'] . '不一致';
					}
				}
				/*
					            if($customer['customs_code']!=$this->_updateData['customs_code']){
					            $this->_error [] = '电商的主管海关代码:'.$customer['customs_code'].'和选择的:'.$this->_updateData['customs_code'].'不一致';
					            }
				*/
			} else {
				$this->_error[] = '电商平台代码:' . $this->_updateData['customer_code'] . '不存在';
			}
		}

		//traf_mode
		if (isset($this->_updateData['trafMode']) && !empty($this->_updateData['trafMode'])) {
			$trmData = Service_TrafMode::getByField($this->_updateData['trafMode'], 'traf_mode_name', array('tfm_id'));
			if (empty($trmData) || !is_array($trmData)) {
				$this->_error[] = '运输方式不存在';
			} else {
				$this->_updateData['trafMode'] = $trmData['tfm_id'];
			}
		}

		//currency_code
		/*
	    if(isset($this->_updateData['currency_code']) && !empty($this->_updateData['currency_code'])){
	    if(Service_Currency::getByField($this->_updateData['currency_code'], 'currency_code', array('currency_id')) === false){
	    $this->_error[] = '币种不存在';
	    }
	    }
*/
	}
	/**
	 * [getPayWaybillBywhere 接口返回数据]
	 * @param  [type] $where [description]
	 * @return [type]        [description]
	 */
	public static function getPayWaybillBywhere($where) {
		if (empty($where) && is_array($where)) {
			return false;
		}
		$waybillData = Service_Waybill::getByWhere($where, array('log_no', 'wb_code', 'app_status'));
		/*
		if (isset($waybillData['app_status']) && !empty($waybillData['app_status'])) {
			$appStatus = self::getAppStatus();
			$waybillData['app_status'] = $appStatus[$waybillData['app_status']];
		}
		*/
		return $waybillData;
	}

	/**
	 * @author
	 * @todo 用于处理excel文件返回成有效的数组
	 */
	public static function getDataArr($rows) {
		/*
			         * $customerAuth = new Zend_Session_Namespace("customerAuth");
			         * $customer = $customerAuth->data;
			         * $customerId = $customer['id'];
			         * $customer_code = $customer['code'];
		*/
		$waybillRows = array();
		// 键名--中文对照
		$title = array_flip(self::getTitle());
		foreach ($rows as $key => $rowData) {
			foreach ($title as $k => $v) {

				if (isset($rowData[$k])) {
					$waybillRows[$key][$v] = $rowData[$k];
				}

				if ($v == 'consigneeCountry' || $v == 'shipperCountry') {
					$country = Service_Country::getByField($rowData[$k], 'country_name', array('country_id'));
					if (!empty($country)) {
						$waybillRows[$key][$v] = $country['country_id'];
						//未匹配到国家
					} else {
						$waybillRows[$key][$v] = 'unkown country';
					}
				}

				if ($v == 'ieType') {
					switch ($rowData[$k]) {
					case '进口':
						$ieType = 'I';
						break;
					case '出口':
						$ieType = 'E';
						break;
					default:
						$ieType = 'I';
						break;
					}
					$waybillRows[$key][$v] = $ieType;
				}

			}
		}
		return $waybillRows;
	}

	/**
	 * [getIeType 进出口类型]
	 * @param  string $lang [description]
	 * @return [type]       [description]
	 */
	public static function getIeType($lang = 'zh_CN') {
		/* 12-12 改成 进口出口
			        $tmpArr = array(
			            'zh_CN' => array(
			                'BI' => '保税进口',
			                'BE' => '保税出口',
			            ),
			            'en_US' => array(
			                'BI' => 'import',
			                'BE' => 'export',
			            )
			        );
		*/
		$tmpArr = array(
			'zh_CN' => array(
				'I' => '进口',
				'E' => '出口',
			),
			'en_US' => array(
				'I' => 'import',
				'E' => 'export',
			),
		);
		if ($lang == 'auto') {
			$lang = Ec::getLang();
		}
		return isset($tmpArr[$lang]) ? $tmpArr[$lang] : $tmpArr;
	}
	/**
	 * 申报类型
	 * @param string $lang 语言类型
	 * @return multitype:multitype:string
	 */
	public static function getAppType($lang = 'auto') {
		$tmp = array(
			'zh_CN' => array(
				'1' => '新增',
				'2' => '变更',
				'3' => '删除',
			),
			'en_US' => array(
				'1' => 'Newly added',
				'2' => 'Change',
				'3' => 'Delete',
			),
		);
		if ($lang == 'auto') {
			$lang = Ec::getLang();
		}
		return isset($tmp[$lang]) ? $tmp[$lang] : $tmp;
	}

	/**
	 * 业务状态
	 * @param string $lang 语言类型
	 * @return multitype:multitype:string
	 */
	public static function getAppStatus($lang = 'auto') {
		$tmp = array(
			'zh_CN' => array(
				'1' => '草稿',
				'2' => '已关联',
				'3' => '异常',
				'4' => '已发送',
				'5' => '已接收',
				'6' => '已妥投',
				'7' => '妥投已接收',
			),
			'en_US' => array(
				'1' => '草稿',
				'2' => '已关联',
				'3' => '异常',
				'4' => '已发送',
				'5' => '已接收',
				'6' => '已妥投',
				'7' => '妥投已接收',
			),
		);
		if ($lang == 'auto') {
			$lang = Ec::getLang();
		}
		return isset($tmp[$lang]) ? $tmp[$lang] : $tmp;
	}
}
