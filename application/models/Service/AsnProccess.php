<?php
class Service_AsnProccess
{
    protected $_orderCode = null;
    protected $_products = null;
    protected $_customerId = null;
    protected $_customerInfo = null;
    protected $_warehouseId = null;
    protected $_error;
    protected $_pro;
    protected $_receiving = array();
    protected $_date = '';

	public static function getAsnStatus(){
		$status['0'] = '全部';
		$status['1'] = '草稿';
		$status['2'] = '确认';
		$status['3'] = '待发送';
		$status['4'] = '已发送';
		$status['5'] = '已接收';
		$status['6'] = '审核中';
		$status['8'] = '已审核';
		$status['7'] = '审核不通过';
		return $status;
	}
    
	public static function getCiqStatus(){
		$status['-2'] = '未发送';
		$status['-1'] = '草稿';
		$status['0'] = '已发送';
		$status['1'] = '电子审单通过';
		$status['2'] = '人工审单通过';
		$status['3'] = '退单';
		$status['4'] = '放行';
		$status['5'] = '部分放行';
		$status['6'] = '截留';
		$status['7'] = '销毁';
		$status['8'] = '退运';
		$status['9'] = '电子审单未通过';
		return $status;
	}
	
	public static function getCustomsStatus(){
		$status['0'] = '未发送';
		$status['1'] = '已发送';
		$status['2'] = '已接收';
		$status['3'] = '辅助系统已接收';
		$status['4'] = '辅助系统已审核';
		$status['5'] = '审核失败';
		return $status;
	}
	
    public function __construct($pro = 'R')
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
	
	public static function validateBoat(&$data,$customerId = '')
	{
		$contaIds			= array();
		$error 				= array();
		$container			= Common_DataCache::getContainer();
		if(empty($data)){
			$error[]	= '请填写集装箱信息';
		}else{
			foreach($data as $key=>$val){
				if(empty($val['conta_id'])){
					$error[]	= '第'.$key.'条集装箱号不能为空';
				}else{
					if(in_array($val['conta_id'],$contaIds)){
						$error[]	= '第'.$key.'条集装箱号重复';
					}else{
						$contaIds[]	= $val['conta_id'];
					}
				}
				if(empty($val['conta_model'])){
					$error[]	= '第'.$key.'条集装箱规格不能为空';
				}else{
					if(!isset($container[$val['conta_model']])){
						$containerInfo = Service_Container::getByField($val['conta_model'],'container_desc');
						if(empty($containerInfo)){
							$error[]	= '第'.$key.'条集装箱规格填写错误,请按业内常用字符输入';
						}else{
							$data[$key]['conta_model'] = $containerInfo['container_code'];
						}
					}
				}
				if($val['conta_wt'] <= 0){
					$error[]	= '第'.$key.'条集装箱重量必须大于0';
				}
				if(!is_numeric($val['conta_num']) || $val['conta_num'] <= 0){
					//$error[]	= '第'.$key.'条集装箱数量必须大于0';
				}
			}
		}
		return $error;
	}
	public static function validateDetail($data,$customerId = '')
	{
		$goodIds			= array();
		$ciqGNos			= array();
		$error 				= array();
		$prouctUom			= Common_DataCache::getProductUomCode();
		$country			= Common_DataCache::getCountryCode();
		$hsCode				= Common_DataCache::getHsCode();
		$currencyCode		= Common_DataCache::getCurrencyCode();
		if(empty($data)){
			$error[]	= '请填写入库明细';
		}else{
			$i = 1;
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
					$error[]	= '第'.$key.'条商品备案号填写错误';
				}
				if(empty($val['gNo']) || $i != $val['gNo']){
					$error[]	= '第'.$key.'条商品序号填写错误';
				}
				if(empty($val['ciqGNo'])){
					$error[]	= '第'.$key.'条商品流水号不能为空';
				}else{
					if(in_array($val['ciqGNo'],$ciqGNos)){
						$error[]	= '第'.$key.'条商品流水号重复';
					}else{
						$ciqGNos[]	= $val['ciqGNo'];
					}
				}
				if(empty($val['gModel'])){
					$error[]	= '第'.$key.'条规格型号不能为空';
				}
				if(empty($val['nameCn'])){
					$error[]	= '第'.$key.'条产品中文名称不能为空';
				}
				if(empty($val['hsName'])){
					$error[]	= '第'.$key.'条海关品名不能为空';
				}
				if(!is_numeric($val['gQty']) || $val['gQty']<=0){
					$error[]	= '第'.$key.'条申报数量必须大于0';
				}
				if(empty($val['gUnit'])){
					$error[]	= '第'.$key.'条申报单位不能空';
				}else{
					if(!isset($prouctUom[$val['gUnit']])){
						$error[]	= '第'.$key.'条申报单位填写错误';
					}
				}
				if($val['declPrice']<=0){
					$error[]	= '第'.$key.'条申报价值必须大于0';
				}
				if(empty($val['currency'])){
					$error[]	= '第'.$key.'条申报币种不能空';
				}else{
					if(!isset($currencyCode[$val['currency']])){
						$error[]	= '第'.$key.'条申报币种填写错误';
					}
				}
				if($val['qty1']<=0){
					$error[]	= '第'.$key.'条法定数量必须大于0';
				}
				if(empty($val['codeTs'])){
					$error[]	= '第'.$key.'条商品编码不能为空';
				}else{
					if(!isset($hsCode[$val['codeTs']])){
						$error[]	= '第'.$key.'条商品编码填写错误';
					}else{
						$uomMap = Service_HsUom::getByField($val['codeTs'],'hs_code');
						if(empty($val['unit1'])){
							$error[]	= '第'.$key.'条法定单位不能空';
						}
						else{
							if($val['unit1'] != $uomMap['pu_code_law']){
								$error[]	= '第'.$key.'条法定单位填写错误';
							}
						}
						if($uomMap['pu_code_second']!=''){
							if(empty($val['unit2'])){
								$error[]	= '第'.$key.'条第二单位不能空';
							}else{
								if($uomMap['pu_code_second'] != $val['unit2']){
									$error[]	= '第'.$key.'条第二单位填写错误';
								}
							}
							if($val['qty2']<=0){
								$error[]	= '第'.$key.'条第二数量必须大于0';
							}
						}else{
							if(!empty($val['unit2'])){
								$error[]	= '第'.$key.'条商品编码对应的第二单位必须为空';
							}
							if('' != $val['qty2']){
								$error[]	= '第'.$key.'条商品编码对应的第二数量必须为空';
							}
						}
					}
				}
				if(!empty($val['originCountry'])){
					if(!isset($country[$val['originCountry']])){
						$error[]	= '第'.$key.'条原产国填写错误';
					}
				}
				if(empty($val['dutyMode'])){
					$error[]	= '第'.$key.'条免征方式不能空';
				}
				//照章全免
				else if(3 != $val['dutyMode']){
					$error[]	= '第'.$key.'条免征方式填写错误';
				}
				if(empty($val['useTo'])){
					$error[]	= '第'.$key.'条用途不能空';
				}
				//其他
				else if(11 != $val['useTo']){
					$error[]	= '第'.$key.'条用途填写错误';
				}
				if($val['declTotal']<=0){
					$error[]	= '第'.$key.'总价必须大于0';
				}
				$i++;
			}
		}
		return $error;
	}

    /**
     * @author william-fan
     * @todo 创建一条新的 ASN 信息 事务处理 (备货模式)
     * @param $order ASN ,$item ASN产品 ,$customerId 客户ID
     * @return array('ask' => 0, 'msg' => '','Error'=>array(array('errorCode'=>'','errorMessage')), 'ASNCode' => '');
     */
    public function createTransaction($data,$customerId = '')
    {
        $result = array('ask' => 0, 'msg' => '', 'error' => array(), 'ASNCode' => '');
        $error = self::validate($data,$customerId);
		$receivingUpload	= new Zend_Session_Namespace('receivingUpload');
		if(isset($receivingUpload->uploadData)){
			$detail			= $receivingUpload->uploadData;
		}else{
			$detail			= @$data['products'];
		}
		if(isset($receivingUpload->boatUploadData)){
			$boatContainer	= $receivingUpload->boatUploadData;
		}else{
			$boatContainer	= @$data['containers'];
		}
		if(empty($detail)){
			$error[] = '入库单明细不能为空';
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
            $ASNCode = self::createCode();
            $receiving['receiving_code']	= $ASNCode;
            $receiving['customer_id']		= $customerId;
            $receiving['customer_code'] 	= $this->_customerInfo['customer_code'];
            $receiving['receiving_status']	= '1';
            $receiving['receiving_add_time']= $date;
			$receiving['ciq_status'] = -2;
			$receiving['customs_status'] = 0;
            $status = '1';
            
			foreach($data as $key=>$val){
				if(!is_array($val)){
					$receiving[$key]	= trim($val);
				}
			}
            if(!isset($receiving['customer_id']) || $receiving['customer_id'] == '') {
            	$receiving['customer_id'] = $this->_customerId;
			}
			$elecInfo	= Service_Customer::getByField($data['ebc_no'],'ciq_reg_num');
            $receiving_id = Service_Receiving::add($receiving);
			foreach($detail as $key=>$val){
				$receivingDetail = array(
					'receiving_code'	=> $ASNCode,
					'cus_goods_id'		=> $val['registerId'],
					'goods_id'			=> $val['goodsId'],
					'g_no'				=> $val['gNo'],
					'ciq_g_no'			=> $val['ciqGNo'],
					'code_ts'			=> $val['codeTs'],
					'g_name_cn'			=> $val['nameCn'],
					'g_model'			=> $val['gModel'],
					'hs_name'			=> $val['hsName'],
					'g_name_en'			=> $val['nameEn'],
					'g_qty'				=> $val['gQty'],
					'g_unit'			=> $val['gUnit'],
					'decl_price'		=> $val['declPrice'],
					'curr'				=> $val['currency'],
					'qty_1'				=> $val['qty1']>0?$val['qty1']:0,
					'unit_1'			=> $val['unit1'],
					'qty_2'				=> $val['qty2']>0?$val['qty2']:0,
					'unit_2'			=> $val['unit2'],
					'origin_country'	=> $val['originCountry'],
					'duty_mode'			=> $val['dutyMode'],
					'use_to'			=> $val['useTo'],
					'decl_total'		=> $val['declTotal'],
					'note_s'			=> $val['notes'],
            	);
				$receivingDetailInfo	= Service_ReceivingDetail::getByField($val['ciqGNo'],'ciq_g_no');
				if(!empty($receivingDetailInfo)){
					throw new Exception('商品流水号'.$val['ciqGNo'].'已存在');
				}
				$productInfo = Service_Product::getByWhere(array('registerID'=>$val['registerId']));
				if(empty($productInfo)){
					throw new Exception('商品备案号'.$val['registerId'].'不存在');
				}else{
					if(1 != $productInfo['product_status']){
						throw new Exception('商品备案号'.$val['registerId'].'未备案');
					}
					if($data['ie_flag'] != $productInfo['ie_type']){
						throw new Exception($val['registerId'].'进出口类型和填写的进出口类型不一致');
					}
					if($elecInfo['customer_code'] != $productInfo['customer_code']){
						throw new Exception('商品备案号'.$val['registerId'].'不属于该电商');
					}
				}
				$productInventory = Service_ProductInventory::getByWhere(
					array('warehouse_code'=>$receiving['warehouse_code'],'goods_id'=>$val['goodsId'])
				);
				if(!empty($productInventory)){
					if($productInventory['code_ts'] != $val['codeTs']){
                        throw new Exception('料件号'.$val['goodsId'].'海关编码和库存资料不一致');
                    }
					if($productInventory['g_name_cn'] != $val['nameCn']){
                        throw new Exception('料件号'.$val['goodsId'].'中文名称和库存资料不一致');
                    }
					if($productInventory['hs_name'] != $val['hsName']){
                        throw new Exception('料件号'.$val['goodsId'].'海关品名和库存资料不一致');
                    }
					if($productInventory['curr'] != $val['currency']){
                        throw new Exception('料件号'.$val['goodsId'].'币种和库存资料不一致');
                    }
					if($productInventory['stock_unit'] != $val['gUnit']){
                        throw new Exception('料件号'.$val['goodsId'].'申报单位和库存资料不一致');
                    }
					if($productInventory['g_model'] != $val['gModel']){
                        throw new Exception('料件号'.$val['goodsId'].'规格型号和库存资料不一致');
                    }
					if('I' == $data['ie_flag'] && $productInventory['origin_country'] != $val['originCountry']){
                        throw new Exception('料件号'.$val['goodsId'].'原产国和库存资料不一致');
                    }
					if($productInventory['unit_1'] != $val['unit1']){
                        throw new Exception('料件号'.$val['goodsId'].'法定单位和库存资料不一致');
                    }
					if($productInventory['unit_2'] != $val['unit2']){
                        throw new Exception('料件号'.$val['goodsId'].'法定第二单位和库存资料不一致');
                    }
				}else{
                    if($productInfo['hs_code'] != $val['codeTs']){
                        throw new Exception('料件号'.$val['goodsId'].'海关编码和备案信息不一致');
                    }
                    if($productInfo['product_title'] != $val['nameCn']){
                        throw new Exception('料件号'.$val['goodsId'].'中文名称和备案信息不一致');
                    }
                    if($productInfo['currency_code'] != $val['currency']){
                        throw new Exception('料件号'.$val['goodsId'].'币种和备案信息不一致');
                    }
                    if( 'I' == $data['ie_flag'] && $productInfo['country_code_of_origin'] != $val['originCountry']){
                        throw new Exception('料件号'.$val['goodsId'].'原产国和备案信息不一致');
                    }
                    if($productInfo['product_model'] != $val['gModel']){
                        throw new Exception('料件号'.$val['goodsId'].'规格型号和备案信息不一致');
                    }
				}
            	if(!Service_ReceivingDetail::add($receivingDetail)){
					throw new Exception('料件号'.$val['goodsId'].'添加失败');
            	}
			}
			if(!empty($boatContainer)){
				foreach($boatContainer as $key=>$val){
					$receivingContainer = array(
						'receiving_code'	=> $ASNCode,
						'rc_no'				=> $val['conta_id'],
						'rc_model'			=> $val['conta_model'],
						'rc_weight'			=> $val['conta_wt'],
						'rc_num'			=> intval($val['conta_num']),
					);
					if(!Service_ReceivingContainer::add($receivingContainer)){
						throw new Exception('集装箱'.$val['conta_id'].'添加失败');
					}
				}
			}
			$note = 'create';
            $session	= new Zend_Session_Namespace('customerAuth');
            $sessionData = $session->data;
            $ASNLog = array(
				'receiving_id'=>$receiving_id,
				'receiving_code' => $ASNCode,
				'user_id'=>'-1',
				'customer_code' => $this->_customerInfo['customer_code'],
				'rl_status_from'=>$status,
				'rl_status_to'=>$status,
				'rl_note' => $note,
				'rl_add_time'=>$date,
				'rl_ip'=>Common_Common::getIP(),
				'account_name'=>isset($sessionData['account_name'])?$sessionData['account_name']:'',
            );
            self::createAsnLog($ASNLog);
            $result['ask']='1';
            $result['msg'] = sprintf('入库单创建成功',$ASNCode);
            $result['ASNCode'] = $ASNCode;
            $DB->commit();
			unset($receivingUpload->uploadData);
			unset($receivingUpload->boatUploadData);
        }  catch (Exception $e) {
            $DB->rollBack();
            $result['error'][] = $e->getMessage();
            $result['msg'] = $e->getMessage();
            return $result;
        }
        return $result;    
    }
	

    /*
     * 针对指定用户，生成一个新的相应 AsnCode
     * @return ASNCode
     */
    public function createCode()
    {
        if ($this->_pro == '') {
            $this->_pro = 'RE';
        }
        $this->_pro = strtoupper($this->_pro);
        return Common_GetNumbers::getCode('ASN', 8, 'R'.$this->_customerInfo['customer_code']);
    }

  
    /*
     *  创建日志
     */
    public static function createAsnLog($row)
    {
        $row['rl_add_time'] = date('Y-m-d H:i:s');
        $row['rl_ip'] = Common_Common::getIP();
        Service_ReceivingLog::add($row);
    }

    /**
     * @author william-fan
     * @todo 表单数据验证
     * @param array $data
     * @return array('ask' => 0, 'msg' => array(), 'data' => array());
     */
    public static function validate($data = array(),$customerId)
    {
		$customerInfo	= Service_Customer::getByField($customerId,'customer_id');
    	$error = array();
        if (empty($data)) {
        	$error[]=Ec_Lang::getInstance()->getTranslate('DataError');//'数据出错';
        	return $error;
        }
		if(1 != $customerInfo['is_storage']){
			$error[] = "仓储企业才能创建入库单";
		}
        if((!is_numeric($data['net_weight']) && $data['net_weight']<=0)){
            $error[] = "净重必须是大于0的数字";
		}
		if((!is_numeric($data['roughweight']) && $data['roughweight']<=0)){
            $error[] = "毛重必须是大于0的数字";
		}
		if($data['net_weight']>$data['roughweight']){
			$error[] = "净重不能大于毛重";
		}
		if($data['decl_port']==''){
			$error[] = '申报海关不能为空';
		}else{
			$ieport = Service_IePort::getByField($data['decl_port'],"ie_port");
			if(empty($ieport)){
				$error[] = '申报海关填写错误';
			}
		}
		if($data['ie_port']==''){
			$error[] = '进出口岸不能为空';
		}else{
			$ieport = Service_IePort::getByField($data['ie_port'],"ie_port");
			if(empty($ieport)){
				$error[] = '进出口岸填写错误';
			}
		}
		if($data['list_no']==''){
        	$error[] = '企业清单内部编号不能为空';
        }else{
			$receiving = Service_Receiving::getByField($data['list_no'],'list_no');
			if(!empty($receiving) && $receiving['customer_code'] == $customerInfo['customer_code']){
				$error[] = '企业清单内部编号已存在';
			}
		}
        if($data['destination_port']==''){
        	$error[] = '目的港不能为空';
        }else{
			$country = Service_Country::getByField($data['destination_port'],"trade_country");
			if(empty($country)){
				$error[] = '目的港填写错误';
			}
		}
		if($data['trade_country']==''){
        	$error[] = '起运国不能为空';
        }else{
			$country = Service_Country::getByField($data['trade_country'],"country_code");
			if(empty($country)){
				$error[] = '起运国填写错误';
			}
			if('' == $country['b_bbd_country_code']){
				$error[] = "起运国:".$country['country_name']."商检编码为空";
			}
		}
		if($data['ie_mode']==''){
        	$error[] = '出入库类型不能为空';
        }
		if($data['ie_flag']==''){
        	$error[] = '进出口类型不能为空';
        }else{
			if('I' != $data['ie_flag'] && 'E' != $data['ie_flag']){
				$error[] = '进出口类型填写错误';
			}
		}
		if($data['waste_flag']==''){
        	$error[] = '是否有废旧物品不能为空';
        }else{
			if('Y' != $data['waste_flag'] && 'N' != $data['waste_flag']){
				$error[] = '是否有废旧物品填写错误';
			}
		}
		if($data['pack_flag']==''){
        	$error[] = '是否带有植物性包装及铺垫材料不能为空';
        }else{
			if('Y' != $data['pack_flag'] && 'N' != $data['pack_flag']){
				$error[] = '是否带有植物性包装及铺垫材料填写错误';
			}
		}
		if($data['form_type']==''){
        	$error[] = '业务类型不能为空';
        }else{
			if('I1A' != $data['form_type'] && 'I2A' != $data['form_type']){
				$error[] = '业务类型填写错误';
			}
		}
		if($data['trade_mode']==''){
        	$error[] = '监管方式不能为空';
        }else{
			$trade_mode = Service_TradeMode::getByField($data['trade_mode'],"trade_mode","*");
			if(empty($trade_mode)){
				$error[] = '监管方式填写错误';
			}
		}
		if($data['trans_mode']==''){
        	$error[] = '成交方式不能为空';
        }else{
			$trans_mode = Service_TransMode::getByField($data['trans_mode'],"trans_mode","*");
			if(empty($trans_mode)){
				$error[] = '成交方式填写错误';
			}
		}
		if($data['form_type']==''){
        	$error[] = '业务类型不能为空';
        }else{
			$fromType = Service_FormType::getByField($data['form_type'],"form_type","*");
			if(empty($fromType)){
				$error[] = '业务类型填写错误';
			}
		}
		if($data['wrap_type']==''){
        	$error[] = '包装种类不能为空';
        }else{
			$wrapType = Service_WrapType::getByField($data['wrap_type'],"wrap_type","*");
			if(empty($wrapType)){
				$error[] = '包装种类填写错误';
			}
		}
		if($data['traf_name']==''){
        	$error[] = '运输工具名称不能为空';
        }
		if($data['trade_co']==''){
        	$error[] = '经营单位代码不能为空';
        }
		if($data['trade_name']==''){
        	$error[] = '经营单位名称不能为空';
        }
		if($data['storage_co']==''){
        	$error[] = '仓储企业代码不能为空';
        }
		if($data['storage_name']==''){
        	$error[] = '仓储企业名称不能为空';
        }
		if($data['agent_code']==''){
        	$error[] = '申报单位代码不能为空';
        }
		if($data['agent_name']==''){
        	$error[] = '申报单位名称不能为空';
        }
		if(!preg_match('/^[0-9a-zA-Z]{10}$/',$data['owner_code'])){
			$error[] = '收（发）货单位必须是10位数字或字母';
		}
		if($data['owner_name']==''){
			$error[] = '收（发）货单位名称不能为空';
		}
		if($data['bill_no']==''){
        	$error[] = '提运单号不能为空';
        }
		if($data['warehouse_code']==''){
        	$error[] = '仓库账册号不能为空';
        }else{
			$warehouseInfo	= Service_Warehouse::getByField($data['warehouse_code'],'warehouse_code');
			if(empty($warehouseInfo) || $warehouseInfo['customer_code'] != $customerInfo['customer_code']){
				$error[] = '仓库账册号填写错误';
			}
			else{
				if($data['ie_flag'] != $warehouseInfo['ie_type']){
					$error[] = '进出口类型和账册进出口类型不一致';
				}
				if($warehouseInfo['warehouse_status']!='5'){
					$error[] = '账册未审核通过';
				}
				if($data['decl_port'] != $warehouseInfo['customs_code']){
					$error[] = '申报海关'.$data['decl_port'].'和账册主管海关不一致';
				}
			}
		}
		if($data['import_date']==''){
        	$error[] = '入出库日期不能为空';
        }
		if(!is_numeric($data['pack_no']) || $data['pack_no']<=0 ){
        	$error[] = '总件数填写错误';
        }
        if('' == $data['ebc_no']){
        	$error[] = '检疫电商企业代码必填';
        }else{
        	$elecInfo	= Service_Customer::getByField($data['ebc_no'],'ciq_reg_num');
        	if(empty($elecInfo)){
        		$error[] = '检疫电商企业代码不存在';
        	}
        }
        if('' == $data['law_no']){
        	$error[] = '报检单号必填';
        }else{
        	$receiving = Service_Receiving::getByWhere(array('law_no'=>$data['law_no'],'receiving_status'=>8));
			if(!empty($receiving)){
				$error[] = '报检单号已存在';
			}
        }
        if('' == $data['check_org_code']){
        	$error[] = '施检机构必填';
        }else{
        	$organization = Service_Organization::getByField($data['check_org_code'],'organization_code');
        	if(empty($organization)){
        		$error[] = '施检机构不存在';
        	}
        }
        if('' == $data['desp_port']){
        	$error[] = '启运口岸必填';
        }else{
        	$port = Service_Port::getByField($data['desp_port'],'port_code');
        	if(empty($port)){
        		$error[] = '启运口岸不存在';
        	}
        }
        if('' == $data['entry_port']){
        	$error[] = '入境口岸必填';
        }else{
        	$port = Service_Port::getByField($data['entry_port'],'port_code');
        	if(empty($port)){
        		$error[] = '入境口岸不存在';
        	}
        }
    	if('' == $data['org_code']){
        	$error[] = '目的机构必填';
        }else{
        	$organization = Service_Organization::getByField($data['org_code'],'organization_code');
        	if(empty($organization)){
        		$error[] = '目的机构不存在';
        	}
        }
        if('' == $data['decl_person']){
        	$error[] = '申报人名称不能为空';
        }
		if($data['goods_address']==''){
        	$error[] = '货物存放地不能为空';
        }
		if($data['trans_type_no']==''){
        	$error[] = '运输号码不能为空';
        }
		if($data['contract_no']==''){
        	$error[] = '合同号不能为空';
        }
		/*
		if('' == $data['ciq_bill_no']){
        	$error[] = '提货单号不能为空';
        }
		*/
		return $error;
    }
	
	public function uploadListno($receivingNo,$type,$declaration_number,$customer)
	{
		$result = array('ask' => 0, 'message' => '');
		$receiving = Service_Receiving::getByField($receivingNo,'receiving_code');
		if(empty($receiving) || $receiving['customer_id'] != $customer['id']){
			$result['message']	= '入库单不存在';
			return $result;
		}
		if(!preg_match('/^[0-9a-zA-Z]{18}$/',$declaration_number)){
			$result['message']	= '报关单/转关单号必须是18位数字或字母';
			return $result;				
		}else{
			$declPort = substr($declaration_number,0,4);
			if($declPort != $receiving['decl_port']){
				$result['message']	= '报关单/转关单号和对应的申报口岸不符';
				return $result;
			}
		}
		if(1 != $type && 2 != $type){
			$result['message']	= '类型填写错误';
			return $result;
		}
		/*
		$receivingCondition = array(
			'declaration_number'=>$declaration_number,
			'customer_id'=>$customer['id'],
		);
		$receivingInfo = Service_Receiving::getByCondition($receivingCondition,"*");
		if(!empty($receivingInfo)){
			$result['message']	= '报关单/转关单号已存在';
			return $result;
		}
		*/
		try {
	   		$DB = Common_Common::getAdapter();
	   		$DB->beginTransaction();
			$customerRow = Service_Customer::getByField($customer['id']);
			$session	= new Zend_Session_Namespace('customerAuth');
			$sessionData = $session->data;
			$receivingRow	= array('ciq_status'=>'-1','receiving_status'=>3,'declaration_number'=>$declaration_number,'receiving_type'=>$type);
			if(!Service_Receiving::update($receivingRow, $receiving['receiving_id'])){
	   			throw new Exception("入库单状态更新失败");
	   		}
			$ASNLog = array(
				'receiving_id'=>$receiving['receiving_id'],
				'receiving_code' => $receivingNo,
				'rl_type'=>'-1',
				'user_id'=>'-1',
				'customer_code' => $customerRow['customer_code'],
				'rl_note' => "上传备案清单",
				'rl_add_time'=>date('Y-m-d H:i:s',time()),
				'rl_ip'=>Common_Common::getIP(),
				'rl_status_from' => 2,
				'rl_status_to' => 3,
				'account_name'=>$sessionData['account_name'],
			);
			self::createAsnLog($ASNLog);
			$result['ask']='1';
			$result['message']="上传成功";
			$DB->commit();
		} catch (Exception $e) {
			$DB->rollBack();
			$result['message']=$e->getMessage();
		}
		return $result;
   }
   
	public static function genReceivingImportXml($receivingCode)
	{
		$result			= array('ask'=>0,'message'=>'','error'=>array());
		$genArrayData	= array();
		$currencyInfo	= Common_DataCache::getCurrencyCode();
		$countryInfo	= Common_DataCache::getCountryCode();
		$receivingInfo	= Service_Receiving::getByField($receivingCode,'receiving_code');
		$tradeCountry	= isset($countryInfo[$receivingInfo['trade_country']])?$countryInfo[$receivingInfo['trade_country']]['trade_country']:$receivingInfo['trade_country'];
		if(!empty($receivingInfo)){
			$receivingDetail	= Service_ReceivingDetail::getByCondition(array('receiving_code'=>$receivingCode));
			$receivingMerge		= Service_ReceivingDetailMerge::getByCondition(array('receiving_code'=>$receivingCode));
			$receivingContainer	= Service_ReceivingContainer::getByCondition(array('receiving_code'=>$receivingCode));
			$receivingArray		= array(
				'SERIAL_NO'			=> $receivingInfo['receiving_id'],
				'DECL_PORT'			=> $receivingInfo['decl_port'],
				'I_E_PORT'			=> $receivingInfo['ie_port'],
				'FORM_ID'			=> $receivingInfo['receiving_code'],
				'I_E_MODE'			=> $receivingInfo['ie_mode'],						//出入库
				'EMS_NO'			=> $receivingInfo['warehouse_code'],				//仓库账册号 
				'EMS_COP_NO'		=> $receivingInfo['list_no'],						//清单企业内部编号
				'TRAF_NAME'			=> $receivingInfo['traf_name'],						//运输工具名称
				'VOYAGE_NO'			=> $receivingInfo['voyage_no'],						//航次号
				'BILL_NO'			=> $receivingInfo['bill_no'],						//提运单号
				'GROSS_WT'			=> $receivingInfo['roughweight'],					//毛重
				'NET_WT'			=> $receivingInfo['net_weight'],					//净重
				'PACK_NO'			=> $receivingInfo['pack_no'],						//总件数
				'WRAP_TYPE'			=> $receivingInfo['wrap_type'],						//包装种类 
				'I_E_DATE'			=> date('YmdHis',strtotime($receivingInfo['import_date'])),					//入出库日期 
				'TRAF_MODE'			=> $receivingInfo['traf_mode'],						//运输方式
				'TRADE_CODE'		=> $receivingInfo['trade_co'],						//经营单位代码
				'TRADE_MODE'		=> $receivingInfo['trade_mode'],					//监管方式
				'TRANS_MODE'		=> $receivingInfo['trans_mode'],					//成交方式
				'AGENT_CODE'		=> $receivingInfo['agent_code'],					//申报单位代码
				'TRADE_COUNTRY'		=> $tradeCountry,								//贸易国别
				'OWNER_CODE'		=> $receivingInfo['owner_code'],					//收（发）货单位代码
				'NOTE_S'			=> $receivingInfo['notes'],							//备注
				'RELATIVE_FORM_TYPE'=> $receivingInfo['receiving_type'],				//关联单证类型
				'RELATIVE_FORM_ID'	=> $receivingInfo['declaration_number'],			//关联单证号码
				'D_DATE'			=> date('YmdHis'),
				'EMC_EPORTCARD_ID'	=> '',												//电子口岸卡号
				'SIGN'				=> 'BH',											//加签
				'FORM_TYPE'			=> $receivingInfo['form_type'],
				'TRADE_NAME'		=> $receivingInfo['trade_name'],					//经营单位名称
				'OWNER_NAME'		=> $receivingInfo['owner_name'],					//收（发）货单位名称
				'AGENT_NAME'		=> $receivingInfo['agent_name'],					//申报单位名称
				'DESTINATION_PORT'	=> $receivingInfo['destination_port'],
				'DECLARE_REMARK'	=> '',												//申报提示
				'I_E_FLAG'			=> $receivingInfo['ie_flag'],						//进出口
				'WH_CODE'			=> $receivingInfo['storage_co'],					//仓储企业代码 
				'WH_NAME'			=> $receivingInfo['storage_name'],					//仓储企业名称
			);
			$receivingDetailArray		= array();
			foreach($receivingDetail as $key=>$val){
				$originCountry	= isset($countryInfo[$val['origin_country']])?$countryInfo[$val['origin_country']]['trade_country']:$val['origin_country'];
				$currencyCode	= isset($currencyInfo[$val['curr']])?$currencyInfo[$val['curr']]['currency_hs_code']:$val['curr'];
				$receivingDetailArray[]	= array(
					'FORM_ID'		=> $val['receiving_code'],
					'GOODS_ID'		=> $val['goods_id'],
					'G_NO'			=> $val['g_no'],
					'MERGER_G_NO'	=> $val['merge_g_no'],
					'CODE_TS'		=> $val['code_ts'],
					'G_NAME_CN'		=> $val['g_name_cn'],
					'G_MODEL'		=> $val['g_model'],
					'G_NAME_EN'		=> $val['g_name_en'],
					'G_QTY'			=> $val['g_qty'],
					'G_UNIT'		=> $val['g_unit'],
					'DECL_PRICE'	=> $val['decl_price'],
					'CURR'			=> $currencyCode,
					'QTY_1'			=> $val['qty_1'],
					'UNIT_1'		=> $val['unit_1'],
					'QTY_2'			=> $val['qty_2'],
					'UNIT_2'		=> $val['unit_2'],
					'ORIGIN_COUNTRY'=> $originCountry,
					'DUTY_MODE'		=> $val['duty_mode'],
					'USE_TO'		=> $val['use_to'],
					'NOTE_S'		=> $val['note_s'],
					'DECL_TOTAL'	=> $val['decl_total'],
				);
			}
			$receivingDetailMergeArray		= array();
			foreach($receivingMerge as $key=>$val){
				$receivingDetailMergeArray[]	= array(
					'FORM_ID'		=> $val['receiving_code'],
					'G_NO'			=> $val['g_no'],
					'CODE_TS'		=> $val['code_ts'],
					'G_NAME_CN'		=> $val['g_name_cn'],
					'G_MODEL'		=> $val['g_model'],
					'G_NAME_EN'		=> $val['g_name_en'],
					'G_QTY'			=> $val['g_qty'],
					'G_UNIT'		=> $val['g_unit'],
					'DECL_PRICE'	=> $val['decl_price'],
					'CURR'			=> $val['curr'],
					'QTY_1'			=> $val['qty_1'],
					'UNIT_1'		=> $val['unit_1'],
					'QTY_2'			=> $val['qty_2'],
					'UNIT_2'		=> $val['unit_2'],
					'ORIGIN_COUNTRY'=> $val['origin_country'],
					'DUTY_MODE'		=> $val['duty_mode'],
					'USE_TO'		=> $val['use_to'],
					'NOTE_S'		=> $val['note_s'],
					'DECL_TOTAL'	=> $val['decl_total'],
				);
			}
			$receivingContainerArray		= array();
			if(!empty($receivingContainer)){
				foreach($receivingContainer as $key=>$val){
					$receivingContainerArray[]	= array(
						'FORM_ID'		=> $val['receiving_code'],
						'CONTA_ID'		=> $val['rc_no'],
						'CONTA_MODEL'	=> $val['rc_model'],
						'CONTA_WT'		=> $val['rc_weight'],
					);
				}
			}
			$receivingArray['BillList']	= $receivingDetailArray;
			if(!empty($receivingContainerArray)){
				$receivingArray['BillConta']= $receivingContainerArray;
			}
			$receivingArray['BillToFZXT']= $receivingDetailMergeArray;
		}
		$mic = str_pad(floor(microtime()*1000), 3, '0', STR_PAD_LEFT);
		$messageId	= $receivingInfo['receiving_id'];
		
		$header = array(
            "MessageID" => $messageId,
            "FunctionCode" => '01',
            "MessageType" => 'BUS001',
            "SenderID" => 'BH',
            "ReceiverID" => 'CUSTOMS',
            "SendTime" => date('YmdHis').$mic,
            "Version" => '1.0'
        );
		$receivingData['BillHead'] = $receivingArray;
        $genArrayData = array(
            'Head' => $header,
            'Declaration' => $receivingData,
        );
        $messageObject = new Common_Message();
        $xml = $messageObject -> cearteResult($genArrayData);
		return $xml;
	}
	
   /**
    * @author william-fan
    * @todo 打印清单 订单到在途
    */
   public static function printAsn($ASNCode = '',$customerId){
	   	$result = array('ask' => 0, 'message' => '确认失败', 'error' => array());
	   	$receiving = Service_Receiving::getByField($ASNCode,'receiving_code');
	   	if(empty($receiving)){
			$result["message"] = '入库单无效';
	   	}else{
			if(1 != $receiving['receiving_status']){
				$result["ask"] = '1';
				return $result;
			}
	   	}
	   	if(empty($customerId)){
			$result["message"] = '客户错误';
			return $result;
	   	}
	   	if($receiving['customer_id']!=$customerId){
			$result["message"] = '入库单和客户不一致';
			return $result;
	   	}
	   	try {
	   		$DB = Common_Common::getAdapter();
	   		$DB->beginTransaction();
	   		$receivingRow = array(
				'receiving_status'=>'2',
				'receiving_update_time'=>date('Y-m-d H:i:s',time()),
	   		);
	   		if(!Service_Receiving::update($receivingRow, $ASNCode,'receiving_code')){
	   			$result["message"] = '入库单状态更新失败';
				$DB->rollBack();
				return $result;
	   		}
            $conDetail = array(
               'receiving_code'=>$ASNCode,
            );
            $receivingDetail = Service_ReceivingDetail::getByCondition($conDetail);
            if(!empty($receivingDetail)){
				$merge			= array();
				$productName	= array();
				foreach ($receivingDetail as $keyde=>$valuede){
					//$mergeRow = $valuede['code_ts'].$valuede['g_unit'].$valuede['curr'].$valuede['origin_country'].md5($valuede['g_model'].$valuede['hs_name']);
					//$mergeRow = $valuede['code_ts'].$valuede['g_unit'].$valuede['curr'].$valuede['origin_country'];
					$mergeRow = $valuede['code_ts'].$valuede['g_unit'].$valuede['curr'].$valuede['origin_country'].md5($valuede['hs_name']);
					$mergeRow = str_replace('.','',$mergeRow);
					if(isset($merge[$mergeRow])){
						$merge[$mergeRow]['g_qty']		+= $valuede['g_qty'];
						$merge[$mergeRow]['qty_1']		+= $valuede['qty_1'];
						$merge[$mergeRow]['qty_2']		+= $valuede['qty_2'];
						$merge[$mergeRow]['decl_total']	+= $valuede['decl_total'];
						$merge[$mergeRow]['merge_no'][]	= $valuede['rd_id'];
					}else{
						$merge[$mergeRow]['merge_no'][]		= $valuede['rd_id'];
						$merge[$mergeRow]['g_name_cn']		= $valuede['g_name_cn'];
						$merge[$mergeRow]['goods_id']		= $valuede['goods_id'];
						$merge[$mergeRow]['cus_goods_id']	= $valuede['cus_goods_id'];
						$merge[$mergeRow]['g_name_en']		= $valuede['g_name_en'];
						$merge[$mergeRow]['g_no']			= $valuede['g_no'];
						$merge[$mergeRow]['use_to']			= $valuede['use_to'];
						$merge[$mergeRow]['duty_mode']		= $valuede['duty_mode'];
						$merge[$mergeRow]['g_unit']			= $valuede['g_unit'];
						$merge[$mergeRow]['unit_1']			= $valuede['unit_1'];
						$merge[$mergeRow]['unit_2']			= $valuede['unit_2'];
						$merge[$mergeRow]['g_qty']			= $valuede['g_qty'];
						$merge[$mergeRow]['qty_1']			= $valuede['qty_1'];
						$merge[$mergeRow]['qty_2']			= $valuede['qty_2'];
						$merge[$mergeRow]['origin_country']	= $valuede['origin_country'];
						$merge[$mergeRow]['curr']			= $valuede['curr'];
						$merge[$mergeRow]['code_ts']		= $valuede['code_ts'];
						$merge[$mergeRow]['g_model']		= $valuede['g_model'];
						$merge[$mergeRow]['decl_price']		= $valuede['decl_price'];
						$merge[$mergeRow]['note_s']			= $valuede['note_s'];
						$merge[$mergeRow]['decl_total']		= $valuede['decl_total'];
						$merge[$mergeRow]['hs_name']		= $valuede['hs_name'];
						$productName[]						= $valuede['g_name_cn'];
					}
				}
				array_multisort($productName, SORT_ASC, $merge);
				if(count($merge) >20 ){
					$result["message"] = '归并项超过20项,不能归并';
					$DB->rollBack();
					return $result;
				}
				$i = 1;
				foreach($merge as $key=>$val){
					$mParam = array(
						'receiving_code'	=> $ASNCode,
						'goods_id'			=> $val['goods_id'],
						'cus_goods_id'		=> $val['cus_goods_id'],
						'merge_g_no'		=> $i,
						'code_ts'			=> $val['code_ts'],
						'g_no'				=> $i,
						'g_name_cn'			=> $val['g_name_cn'],
						'g_model'			=> $val['g_model'],
						'g_name_en'			=> $val['g_name_en'],
						'g_qty'				=> $val['g_qty'],
						'g_unit'			=> $val['g_unit'],
						'decl_price'		=> sprintf("%.4f", $val['decl_total']/$val['g_qty']),
						'curr'				=> $val['curr'],
						'qty_1'				=> $val['qty_1'],
						'unit_1'			=> $val['unit_1'],
						'qty_2'				=> $val['qty_2'],
						'unit_2'			=> $val['unit_2'],
						'origin_country'	=> $val['origin_country'],
						'duty_mode'			=> $val['duty_mode'],
						'use_to'			=> $val['use_to'],
						'decl_total'		=> $val['decl_total'],
						'hs_name'			=> $val['hs_name'],
						'note_s'			=> $val['note_s'],
					);
					if(!Service_ReceivingDetailMerge::add($mParam)){
						$result["message"] = '归并项新增失败';
						$DB->rollBack();
						return $result;
					}
					foreach($val['merge_no'] as $k=>$v){
						if(!Service_ReceivingDetail::update(array('merge_g_no'=>$i),$v)){
							$result["message"] = '入库单明细更新失败';
							$DB->rollBack();
							return $result;
						}
					}
					$i++;
				}
            }else{
				$result["message"] = '未上传入库明细,不能打印';
				$DB->rollBack();
				return $result;
			}
	   		$customerRow = Service_Customer::getByField($customerId);
            $session	= new Zend_Session_Namespace('customerAuth');
            $sessionData = $session->data;
	   		$ASNLog = array(
				'receiving_id'=>$receiving['receiving_id'],
				'receiving_code' => $ASNCode,
				'rl_type'=>'-1',
				'user_id'=>'-1',
				'customer_code' => $customerRow['customer_code'],
				'rl_note' => "打印入库单",
				'rl_add_time'=>date('Y-m-d H:i:s',time()),
				'rl_ip'=>Common_Common::getIP(),
				'rl_status_from' => 1,
				'rl_status_to' => 2,
				'account_name'=>$sessionData['account_name'],
	   		);
	   		self::createAsnLog($ASNLog);
	   		$result['ask']='1';
	   		$DB->commit();
	   	} catch (Exception $e) {
	   		$DB->rollBack();
	   		$result['message'] = $e->getMessage();
	   	}
	   	return $result;
   }
}

?>