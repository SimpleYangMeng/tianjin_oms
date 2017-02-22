<?php
class Service_ShipBatchProcess{

	protected $customer		= array();
	protected $ieType		= '';
	protected $personProduct= array();
	
    public static function getStatus(){
		$status['0'] = '全部';
		$status['1'] = '海关已删除';
		$status['2'] = '待发送海关';
		$status['3'] = '已发送海关';
		$status['4'] = '海关已接收';
		$status['5'] = '海关审核中';
		$status['6'] = '海关已审核';
		$status['7'] = '审核不通过';
		return $status;
	}
	
	public static function getDeleteStatus(){
		$status['0'] = '草稿';
		$status['1'] = '待发送海关';
		$status['2'] = '已发送海关';
		$status['3'] = '海关已接收';
		$status['4'] = '海关已审核';
		return $status;
	}
	
    /**
     * [createPayOrderTransaction description]
     * @param  [type] $shipBatchInfo [description]
     * @param  [type] $customerCode  [description]
     * @return [type]                [description]
     */
    public function createPayOrderTransaction($shipBatchInfo , $customerId)
    {
		$result = array (
			"ask" => 0,
			"message" => '载货单创建失败',
			'error' => array()
        );
		$this->ieType	= $shipBatchInfo['ie_type'];
		$customerInfo	= Service_Customer::getByField($customerId,'customer_id');
		$error = $this->validate($shipBatchInfo,$customerId);
		$product= @$shipBatchInfo['product'];
		$detail	= @$shipBatchInfo['detail'];
		$personItemUpload	= new Zend_Session_Namespace('personItemUpload');
		if(!isset($personItemUpload->uploadData)){
			$tmpError	= $this->validateDetails($detail,$customerId);
			$error	= array_merge($error,$tmpError);
		}else{
			$detail	= $personItemUpload->uploadData;
		}
		if(!isset($personItemUpload->productUploadData)){
			$tmpError	= $this->validateProduct($product,$customerId);
			$error	= array_merge($error,$tmpError);
		}else{
			$product	= $personItemUpload->productUploadData;
		}
		if(empty($detail)){
			$error[]	= '请上传物品清单';
		}else if($shipBatchInfo['pack_no'] != count($detail)){
			$error[]	= '总件数和物品清单总件数不一致';
		}
		if(empty($product)){
			$error[]	= '请上传商品明细';
		}
		if('2' != $customerInfo['customer_status']){
			$error[]	= '企业未备案';
		}
		$diff				= false;
		$receivingProduct	= $personItemUpload->receivingProduct;
		$personProduct 		= $personItemUpload->personProduct;
		foreach($receivingProduct as $key=>$val){
			if(!isset($personProduct[$key]) || $personProduct[$key]['qty'] != $val['qty']){
				$diff	= true;
				break;
			}
		}
		if(!$diff){
			foreach($personProduct as $key=>$val){
				if(!isset($receivingProduct[$key]) || $receivingProduct[$key]['qty'] != $val['qty']){
					$diff	= true;
					break;
				}
			}
		}
		if($diff){
			$error[]	= '上传的商品和物品清单商品明细对应不上';
		}
		if(!empty($error)){
			$result['error']	= $error;
			return $result;
		}
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
			$sbCode		= Common_GetNumbers::getCode('shipbatch', 8, 'L'.$customerInfo['customer_code']);
			$sbParam	= array(
				'sb_code'		=> $sbCode,
				'car_no'		=> $shipBatchInfo['car_no'],
				'add_time'		=> date('Y-m-d H:i:s'),
				'ie_type'		=> $shipBatchInfo['ie_type'],
				'customer_code'	=> $customerInfo['customer_code'],
				'customer_id'	=> $customerInfo['customer_id'],
				'decl_port'		=> $shipBatchInfo['decl_port'],
				'ie_port'		=> $shipBatchInfo['ie_port'],
				'pack_no'		=> $shipBatchInfo['pack_no'],
				'total_wt'		=> $shipBatchInfo['total_wt'],
				'car_wt'		=> $shipBatchInfo['car_wt'],
				'form_num'		=> $shipBatchInfo['form_num'],
				'agent_code'	=> $shipBatchInfo['agent_code'],
				'agent_name'	=> $shipBatchInfo['agent_name'],
				'trade_code'	=> $shipBatchInfo['trade_code'],
				'trade_name'	=> $shipBatchInfo['trade_name'],
				'wh_code'		=> $shipBatchInfo['wh_code'],
				'wh_name'		=> $shipBatchInfo['wh_name'],
				'owner_code'	=> $shipBatchInfo['owner_code'],
				'owner_name'	=> $shipBatchInfo['owner_name'],
				'form_type'		=> $shipBatchInfo['form_type'],
				'ref_loader_no'	=> $shipBatchInfo['ref_loader_no'],
				'status'		=> 2,
			);
            $sbId 		= Service_ShipBatch::add($sbParam);
            if(false == $sbId){
                throw new Exception("新增载货单异常");
            }
            $shipBatchLogRow = array(
                'sb_id'         	=> $sbId,
                'sb_code'       	=> $sbCode,
                'user_id'       	=> $customerId,
                'sbl_note'      	=> '新增载货单',
                'sbl_add_time'  	=> date("Y-m-d H:i:s"),
				'sbl_status_from'	=> 2,
				'sbl_status_to'		=> 2,
				'sbl_ip'			=> Common_Common::getIP(),
            );
            if(!Service_ShipBatchLog::add($shipBatchLogRow)){
                throw new Exception('新增载货单日志异常', 500);
            }
            $condition = array(
            	'customer_code'=>$customerInfo['customer_code'],
            	'warehouse_status'=>'5',
            	'ie_type'=>$shipBatchInfo['ie_type'],
				'customs_code'=>$shipBatchInfo['decl_port'],
            );
            $warehouseInfos = Service_Warehouse::getByCondition($condition,'*');
            if (empty($warehouseInfos)) {
            	throw new Exception('账册不存在或未审核', 500);
            } else {
            	if($warehouseInfos[0]['warehouse_status']!='5'){
            		throw new Exception('账册未审核通过', 500);
            	}
            }
            foreach ($detail as $key=>$val) {
				$personItemInfo = Service_PersonItem::getByWhere(
					array('pim_reference_no'=>$val['pim_reference_no'],
					'storage_customer_code'=>$customerInfo['customer_code']));
				$shipBatchOrderRow = array(
					'sb_id'				=> $sbId,
					'sb_code'       	=> $sbCode,
					'order_code'        => $val['order_code'],
					'form_id'			=> $personItemInfo['pim_code'],
					'form_type'			=> $val['form_type'],
				);
				if($personItemInfo['declare_ie_port'] != $shipBatchInfo['decl_port']){
					throw new Exception('个人物品清单['.$val['pim_reference_no'].']申报口岸和载货单不一致');
				}
				if($personItemInfo['ie_port'] != $shipBatchInfo['ie_port']){
					throw new Exception('个人物品清单['.$val['pim_reference_no'].']进出口岸和载货单不一致');
				}
				if(!Service_ShipBatchOrder::add($shipBatchOrderRow)){
					throw new Exception('创建载货单下个人物品清单['.$val['pim_reference_no'].']异常');
				}
				if(!Service_PersonItem::update(array('status'=>9,'customs_status'=>9),$personItemInfo['pim_id'])){
					throw new Exception('个人物品清单['. $val['pim_reference_no'].']状态更新失败');
				}
				$personItemLog	= array(
					'pim_id'=>$personItemInfo['pim_id'],
					'pim_code'=>$personItemInfo['pim_code'],
					'pim_status_from'=>6,
					'pim_status_to'=>9,
					'pil_add_time'=>date("Y-m-d H:i:s"),
					'user_id'=>-1,
					'pil_ip'=>Common_Common::getIP(),
					'account_name'=>$customerInfo['customer_code'],
					'pil_comments'=>'关联载货单',
				);
				if(!Service_PersonItemLog::add($personItemLog)){
					throw new Exception('个人物品清单['. $val['pim_reference_no'].']日志创建失败');
				}
            }
			foreach ($product as $key=>$val) {
				$receivingInventory = Service_ReceivingInventory::getByWhere(array('receiving_code'=>$val['formId'],'merge_g_no'=>$val['gNo']));
				if($receivingInventory['qty'] < $val['gQty']){
					throw new Exception('第'.($key+1).'条申报数量大于库存数量');
				}
				if($receivingInventory['qty_1'] < $val['qty_1']){
					throw new Exception('第'.($key+1).'条法定数量大于库存法定数量');
				}
				if($receivingInventory['qty_2'] < $val['qty_2']){
					throw new Exception('第'.($key+1).'条第二数量大于库存第二数量');
				}
                $sbProduct	 = array(
                    'sb_code'           => $sbCode,
                    'decl_number'       => $val['declNumber'],
					'form_id'			=> $val['formId'],
					'g_no'				=> $val['gNo'],
					'code_ts'			=> $val['codeTs'],
					'g_name_cn'			=> $val['nameCn'],
					'g_model'			=> $val['gModel'],
					'g_name_en'			=> $val['nameEn'],
					'g_qty'				=> $val['gQty'],
					'g_unit'			=> $val['gUnit'],
					'decl_price'		=> $val['declPrice'],
					'curr'				=> $val['currency'],
					'qty_1'				=> $val['qty1'],
					'unit_1'			=> $val['unit1'],
					'qty_2'				=> $val['qty2'],
					'unit_2'			=> $val['unit2'],
					'origin_country'	=> $val['originCountry'],
					'duty_mode'			=> $val['dutyMode'],
					'use_to'			=> $val['useTo'],
					'decl_total'		=> $val['declTotal'],
					'note_s'			=> $val['note'],
                );
				if('I' == $shipBatchInfo['ie_type']){
					if(empty($val['originCountry'])){
						throw new Exception('第'.($key+1).'条原产国/目的地不能为空');
					}
				}
                if(!Service_ShipBatchProduct::add($sbProduct)){
                    throw new Exception('新增载货单商品异常');
                }
				$uParam	= array(
					'quantity'		=> $val['gQty'],
					'operationType'	=> 2,
					'warehouseCode'	=> $warehouseInfos[0]['warehouse_code'],
					'code_ts'		=> $val['codeTs'],
					'g_name_cn'		=> $val['nameCn'],
					'g_name_en'		=> $val['nameEn'],
					'stock_unit'	=> $val['gUnit'],
					'curr'			=> $val['currency'],
					'receiving_code'=> $val['formId'],
					'merge_g_no'	=> $val['gNo'],
					'qty_1'			=> $val['qty1'],
					'qty_2'			=> $val['qty2'],
					'unit_1'		=> $val['unit1'],
					'unit_2'		=> $val['unit2'],
				);
				$receivingInventoryProcess	= new Service_ReceivingInventoryProcess();
				$receivingInventoryState = $receivingInventoryProcess->update($uParam);
				if(1 != @$receivingInventoryState['state']){
					throw new Exception($val['formId'].':'.$val['gNo'].'项号级库存更新失败');
				}
            }
            $result['ask']=1;
            $result['message']='新增载货单成功';
            $result['sbCode'] = $sbCode;
            $db->commit();
        } catch(Zend_Db_Statement_Exception $e){
            $db->rollback();
            $result['error'][] = '更新失败,无法添加载货单';
        } catch (Exception $e) {
            $db->rollback();
            $result['error'][] = $e->getMessage();
        }
        return $result;
    }
	
	public static function generateXml($sbCode)
	{
		$result			= array('ask'=>0,'message'=>'','error'=>array());
		$genArrayData	= array();
		$shipBatchInfo	= Service_ShipBatch::getByField($sbCode,'sb_code');
		if(!empty($shipBatchInfo)){
			$body		= array();
			$sbDetail	= array();
			$sbProduct	= array();
			$shipBatchOrder	= Service_ShipBatchOrder::getByCondition(array('sb_code'=>$sbCode));
			foreach($shipBatchOrder as $key=>$val){
				$personItemInfo	= Service_PersonItem::getByField($val['order_code'],'order_code');
				$sbDetail['URM_LIST'][]		= array(
					'URM_NO'	=> $sbCode,
					'FORM_ID'	=> $val['form_id'],			//业务单证号
					'FORM_TYPE'	=> $val['form_type'],		//业务单证类型
				);
			}
			$shipBatchProdutInfo	= Service_ShipBatchProduct::getByCondition(array('sb_code'=>$sbCode));
			foreach($shipBatchProdutInfo as $key=>$val){
				$sbProduct['URM_LIST_TO_FZXT'][]	= array(
					'URM_NO'		=> $sbCode,
					'FORM_ID'		=> $sbCode,									//单证号
					'G_NO'			=> $val['g_no'],							//商品序号 
					'CODE_TS'		=> $val['code_ts'],							//商品编码 
					'G_NAME_CN'		=> $val['g_name_cn'],						//商品中文名称
					'G_MODEL'		=> $val['g_model'],							//规格型号
					'G_NAME_EN'		=> $val['g_name_en'],						//商品英文名称 
					'G_QTY'			=> $val['g_qty'],							//计量单位   
					'G_UNIT'		=> $val['g_unit'],							//申报数量   
					'DECL_PRICE'	=> $val['decl_price'],						//申报单价    
					'CURR'			=> $val['curr'],							//币制    
					'QTY_1'			=> $val['qty_1'],							//法定数量   
					'UNIT_1'		=> $val['unit_1'],							//法定单位   
					'QTY_2'			=> $val['qty_2'],							//第二数量
					'UNIT_2'		=> $val['unit_2'],							//第二单位
					'ORIGIN_COUNTRY'=> $val['origin_country'],					//原产国/目的地
					'DUTY_MODE'		=> $val['duty_mode'],						//征免方式
					'USE_TO'		=> $val['use_to'],							//用途 
					'NOTE_S'		=> $val['note_s'],							//备注  
					'DECL_TOTAL'	=> $val['decl_total'],						//用途 
				);
			}
			$sbArray		= array(
				'URM_NO'			=> $sbCode,
				'CAR_NO'			=> $shipBatchInfo['car_no'],
				'DECL_PORT'			=> $shipBatchInfo['decl_port'],
				'I_E_PORT'			=> $shipBatchInfo['ie_port'],
				'I_E_FLAG'			=> $shipBatchInfo['ie_type'],
				'PACK_NO'			=> $shipBatchInfo['pack_no'],			//总件数
				'TOTAL_WT'			=> $shipBatchInfo['total_wt'],			//总重量
				'CAR_WT'			=> $shipBatchInfo['car_wt'],			//车自重
				'FORM_NUM'			=> $shipBatchInfo['form_num'],			//单证总数
				'D_DATE'			=> date('YmdHis'),
				'SEAL_NO'			=> '',									//关锁号
				'SEAL_KEY'			=> '',									//关锁密钥
				'EMC_EPORTCARD_ID'	=> '',									//电子口岸卡号
				'SIGN'				=> 'BH',								//加签字段
				'TRAF_NAME'			=> '',									//船名
				'VOYAGE_NO'			=> '',
				'BILL_NO'			=> '',
				'AGENT_CODE'		=> $shipBatchInfo['agent_code'],		//申报单位代码
				'AGENT_NAME'		=> $shipBatchInfo['agent_name'],        //申报单位名称
				'TRADE_CODE'		=> $shipBatchInfo['agent_code'],        //经营单位代码
				'TRADE_NAME'		=> $shipBatchInfo['agent_name'],        //经营单位名称
				'WH_CODE'			=> $shipBatchInfo['agent_code'],		//仓储企业单位代码
				'WH_NAME'			=> $shipBatchInfo['agent_name'],        //仓储企业单位名称
				'OWNER_CODE'		=> $shipBatchInfo['agent_code'],		//收发货人代码
				'OWNER_NAME'		=> $shipBatchInfo['agent_name'],        //收发货人名称
			);
			$sbArray	= array_merge($sbArray,$sbDetail,$sbProduct);
			$body['URM_HEAD']	= $sbArray;
		}
		$mic = str_pad(floor(microtime()*1000), 3, '0', STR_PAD_LEFT);
		$messageId	= $shipBatchInfo['sb_id'];
		
		$header = array(
            "MessageID" => $messageId,
            "FunctionCode" => '2',
            "MessageType" => 'BUS003',
            "SenderID" => 'BH',
            "ReceiverID" => 'CUSTOMS',
            "SendTime" => date('YmdHis').$mic,
            "Version" => '1.0'
        );
		
        $genArrayData = array(
            'Head' => $header,
            'Declaration' => $body
        );
        $messageObject = new Common_Message();
        $xml = $messageObject -> cearteResult($genArrayData);
		return $xml;
	}
	

    /**
     * [validate description]
     * @param  [type] $shipBatchInfo [description]
     * @return [type]                [description]
     */
    private function validate($shipBatchInfo,$customerId)
    {
		$error	= array();
		$customerInfo	= Service_Customer::getByField($customerId,'customer_id');
		if(1 != $customerInfo['is_storage']){
			$error[] = "仓储企业才能创建载货单";
		}
		if('' == $shipBatchInfo['car_no']){
			$error[]	= '车牌号不能为空';
		}
		if('' == $shipBatchInfo['ie_type']){
			$error[]	= '进出口不能为空';
		}else{
			if('I' != $shipBatchInfo['ie_type'] && 'E' != $shipBatchInfo['ie_type']){
				$error[]	= '进出口填写错误';
			}
		}
		if('' == $shipBatchInfo['decl_port']){
			$error[]	= '申报口岸不能为空';
		}
		if('' == $shipBatchInfo['ie_port']){
			$error[]	= '进出口岸不能为空';
		}
		if('' == $shipBatchInfo['pack_no']){
			$error[]	= '总件数不能为空';
		}else{
			if($shipBatchInfo['pack_no']<=0){
				$error[]	= '总件数必须大于0';
			}
		}
		if('' == $shipBatchInfo['total_wt']){
			$error[]	= '总重量不能为空';
		}else{
			if($shipBatchInfo['total_wt']<=0){
				$error[]	= '总重量必须大于0';
			}
		}
		if('' == $shipBatchInfo['car_wt']){
			$error[]	= '车自重不能为空';
		}else{
			if($shipBatchInfo['car_wt']<=0){
				$error[]	= '车自重必须大于0';
			}
		}
		if('' == $shipBatchInfo['form_num']){
			$error[]	= '单证总数不能为空';
		}else{
			if($shipBatchInfo['form_num']<=0){
				$error[]	= '单证总数必须大于0';
			}
		}
		if('' == $shipBatchInfo['agent_code']){
			$error[]	= '申报单位代码不能为空';
		}
		if('' == $shipBatchInfo['agent_name']){
			$error[]	= '申报单位名称不能为空';
		}
		if('' == $shipBatchInfo['trade_code']){
			$error[]	= '经营单位代码不能为空';
		}
		if('' == $shipBatchInfo['trade_name']){
			$error[]	= '经营单位名称不能为空';
		}
		if('' == $shipBatchInfo['wh_code']){
			$error[]	= '仓储企业单位代码不能为空';
		}
		if('' == $shipBatchInfo['wh_name']){
			$error[]	= '仓储企业单位名称不能为空';
		}
		if(!preg_match('/^[0-9a-zA-Z]{10}$/',$shipBatchInfo['owner_code'])){
			$error[] = '收发货人代码必须是10位数字或字母';
		}
		if('' == $shipBatchInfo['owner_name']){
			$error[] = '收发货人名称不能为空';
		}
		if('' == $shipBatchInfo['ref_loader_no']){
			$error[]	= '企业内部清单编号不能为空';
		}else{
			$shipBatchInfo	= Service_ShipBatch::getByField($shipBatchInfo['ref_loader_no'],'ref_loader_no');
			if(!empty($shipBatchInfo) && $customerInfo['customer_code'] == $shipBatchInfo['customer_code']){
				$error[]	= '企业清单编号已存在';
			}
		}
		return $error;
    }
	
	public function validateProduct($product ,$customerId)
	{
		$error				= array();
		$receivingProduct	= array();
		$country			= Common_DataCache::getCountryCode();
		$hsCode				= Common_DataCache::getHsCode();
		$personItemUpload	= new Zend_Session_Namespace('personItemUpload');
		$formType			= '';	//业务类型
		if(!empty($product)){
			foreach($product as $key=>$val){
                $line = $key+1;
				if(empty($val['declNumber'])){
					$error[]	= '第'.$line.'条报关号不能为空';
				}
				if(empty($val['formId'])){
					$error[]	= '第'.$line.'条入库单号不能为空';
				}else{
					$receivingInfo	= Service_Receiving::getByField($val['formId'],'receiving_code');
					if(empty($receivingInfo)){
						$error[]	= '第'.$line.'条入库单不存在';
					}else{
						if('' != $formType){
							if($receivingInfo['form_type'] != $formType){
								$error[]	= $val['pim_reference_no'].'业务类型不一致';
							}
						}else{
							$formType = $receivingInfo['form_type'];
						}
						if(empty($val['gNo'])){
							$error[]	= '第'.$line.'条项号不能为空';
						}else{
							$receivingInventory = Service_ReceivingInventory::getByWhere(array('receiving_code'=>$val['formId'],'merge_g_no'=>$val['gNo']));
							if(empty($receivingInventory)){
								$error[]	= '第'.$line.'条未找到对应项号库存';
							}else{
								if($receivingInventory['warehouse_code'] != $receivingInfo['warehouse_code']){
									$error[]	= '第'.$line.'条不属于该仓储企业';
								}
								if(empty($val['codeTs'])){
									$error[]	= '第'.$line.'条商品编码不能为空';
								}else{
									if(!isset($hsCode[$val['codeTs']])){
										$error[]	= '第'.$line.'条商品编码填写错误';
									}else{
										$uomMap = Service_HsUom::getByField($val['codeTs'],'hs_code');
										if(empty($val['unit1'])){
											$error[]	= '第'.$line.'条法定单位不能空';
										}
										else{
											if($val['unit1'] != $uomMap['pu_code_law']){
												$error[]	= '第'.$line.'条法定单位填写错误';
											}
										}
										if($uomMap['pu_code_second']!=''){
											if(empty($val['unit2'])){
												$error[]	= '第'.$line.'条第二单位不能空';
											}else{
												if($uomMap['pu_code_second'] != $val['unit2']){
													$error[]	= '第'.$line.'条第二单位填写错误';
												}
											}
											if($val['qty2']<=0){
												$error[]	= '第'.$line.'条第二数量必须大于0';
											}
										}else{
											if(!empty($val['unit2'])){
												$error[]	= '第'.$line.'条商品编码对应的第二单位必须为空';
											}
											if('' != $val['qty2']){
												$error[]	= '第'.$line.'条商品编码对应的第二数量必须为空';
											}
										}
										if($receivingInventory['code_ts'] != $val['codeTs']){
											$error[]	= '第'.$line.'条商品编码与库存记录商品编码不一致';
										}
										$receivingDetail= Service_ReceivingDetail::getByWhere(array('receiving_code'=>$val['formId'],'merge_g_no'=>$val['gNo']));
										if(empty($receivingDetail)){
											$error[]	= '第'.$line.'条商品未找到入库单明细';
										}else{
											$mergeNo = $val['formId'].$val['gNo'];
											if(isset($receivingProduct[$mergeNo])){
												$receivingProduct[$mergeNo]['qty'] += $val['gQty'];
											}else{
												$receivingProduct[$mergeNo]['qty'] = $val['gQty'];
											}
										}
									}
								}
								if($val['declNumber'] != $receivingInfo['declaration_number']){
									$error[]	= '第'.$line.'条报关单号填写错误';
								}
								if(empty($val['gUnit'])){
									$error[]	= '第'.$line.'条申报单位不能空';
								}else{
									if($val['gUnit'] != $receivingInventory['stock_unit']){
										$error[]	= '第'.$line.'条申报单位与库存记录申报单位不一致';
									}
								}
								if(empty($val['currency'])){
									$error[]	= '第'.$line.'条申报币种不能空';
								}else{
									if($val['currency'] != $receivingInventory['curr']){
										$error[]	= '第'.$line.'条币制与库存记录币制不一致';
									}
								}
							}
						}
					}
				}
				if($val['qty1']<=0){
					$error[]	= '第'.$line.'条法定数量必须大于0';
				}
				if(empty($val['gModel'])){
					$error[]	= '第'.$line.'条规格型号不能为空';
				}
				if(empty($val['nameCn'])){
					$error[]	= '第'.$line.'条产品中文名称不能为空';
				}
				if(!is_numeric($val['gQty']) || $val['gQty']<=0){
					$error[]	= '第'.$line.'条申报数量必须大于0';
				}
				if($val['declPrice']<=0){
					$error[]	= '第'.$line.'条申报价值必须大于0';
				}
				if(!empty($val['originCountry'])){
					if(!isset($country[$val['originCountry']])){
						$error[]	= '第'.$line.'条原产国填写错误';
					}
				}
				if(empty($val['dutyMode'])){
					$error[]	= '第'.$line.'条免征方式不能空';
				}else{
					if(3 != $val['dutyMode']){
						$error[]	= '第'.$line.'条免征方式填写错误';
					}
				}
				if(empty($val['useTo'])){
					$error[]	= '第'.$line.'条用途不能空';
				}else{
					if(11 != $val['useTo']){
						$error[]	= '第'.$line.'条用途填写错误';
					}
				}
				if($val['declTotal']<=0){
					$error[]	= '第'.$line.'条总价必须大于0';
				}
			}
		}
		$personItemUpload->receivingProduct	= $receivingProduct;
		return $error;
	}
    /**
     * [validateDetails description]
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function validateDetails(&$details ,$customerId)
    {
        $error 				= array();
		$formType			= '';
		$personItemUpload	= new Zend_Session_Namespace('personItemUpload');
		$customerInfo		= Service_Customer::getByField($customerId,'customer_id');
		if(!empty($details)){
			foreach($details as $key=>&$val){
				$personItemInfo	= Service_PersonItem::getByWhere(
					array('pim_reference_no'=>$val['pim_reference_no'],
					'storage_customer_code'=>$customerInfo['customer_code']));
				if(empty($personItemInfo) || 6 != $personItemInfo['status']){
					$error[]	= $val['pim_reference_no'].'不存在';
				}else{
					if('' != $formType){
						if($personItemInfo['form_type'] != $formType){
							$error[]	= $val['pim_reference_no'].'业务类型不一致';
							continue;
						}
					}else{
						$formType = $personItemInfo['form_type'];
					}
					$val['wb_code']	= $personItemInfo['wb_code'];
					$val['order_code']	= $personItemInfo['order_code'];
					$val['po_code']	= $personItemInfo['po_code'];
					$val['order_reference_no']	= $personItemInfo['order_reference_no'];
					$val['pim_code']	= $personItemInfo['pim_code'];
					$val['form_id']		= $personItemInfo['pim_reference_no'];
					$val['form_type']	= $personItemInfo['form_type'];
					$personItemProduct	= Service_PersonItemProduct::getByCondition(array('pim_id'=>$personItemInfo['pim_id']));
					foreach($personItemProduct as $k=>$v){
						$receivingDetail = Service_ReceivingDetail::getByField($v['ciq_g_no'],'ciq_g_no');
						$mergeNo = $receivingDetail['receiving_code'].$receivingDetail['merge_g_no'];
						if(isset($personProduct[$mergeNo])){
							$personProduct[$mergeNo]['qty'] += $v['g_qty'];
						}else{
							$personProduct[$mergeNo]['qty'] = $v['g_qty'];
						}
					}
				}
			}
		}
		$personItemUpload->personProduct	= $personProduct;
		return $error;
    }
	
	public function markDelete($sbCode,$reson)
	{
		$result = array('ask'=>0,'message'=>'');
		$shipBatch = Service_ShipBatch::getByField($sbCode,'sb_code');
		$sbDleteCode = Common_GetNumbers::getCode('shipbatchDelete', 7, $shipBatch['ie_port'].date("Y"));
		$db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
			$uParam	= array(
				'mark_delete'	=> 1,
				'mark_delete_reason' => $reson,
				'mark_delete_code' => $sbDleteCode,
			);
			if(!Service_ShipBatch::update($uParam,$shipBatch['sb_id'])){
				throw new Exception('载货单更新失败');
			}
			$shipBatchLogRow = array(
                'sb_id'         	=> $shipBatch['sb_id'],
                'sb_code'       	=> $sbCode,
                'user_id'       	=> $shipBatch['customer_id'],
                'sbl_note'      	=> '申请删除载货单,原因:'.$reson,
                'sbl_add_time'  	=> date("Y-m-d H:i:s"),
				'sbl_status_from'	=> $shipBatch['status'],
				'sbl_status_to'		=> $shipBatch['status'],
				'sbl_ip'			=> Common_Common::getIP(),
            );
            if(!Service_ShipBatchLog::add($shipBatchLogRow)){
                throw new Exception('新增载货单日志异常', 500);
            }
			$result['ask'] = 1;
			$result['message'] = "操作成功";
			$db->commit();
		}catch(Exception $e){
			$db->rollback();
			$result['message'] = $e->getMessage();
		}
		return $result;
	}
}
