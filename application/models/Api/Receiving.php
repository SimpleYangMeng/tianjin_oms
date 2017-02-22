<?php
/* @desc 入库单接口
 *
 */
class Api_Receiving extends Api_Web
{

    protected $fields = null;
	protected $productFields = null;

    public function __construct($paramString = '')
    {
        parent::__construct($paramString);
        $this->setFields();
		$this->setProductFields();
    }

    protected function setFields()
    {
        $this->fields = array(
            'declPort'			=> 'decl_port',
            'iePort'			=> 'ie_port',
            'tradeCountry'		=> 'trade_country',
            'destinationPort'	=> 'destination_port',
            'ieType'			=> 'ie_flag',
            'tradeMode'			=> 'trade_mode',
            'transMode'			=> 'trans_mode',
            'trafMode'			=> 'traf_mode',
            'formType'			=> 'form_type',
            'ieMode'			=> 'ie_mode',
            'wrapType'			=> 'wrap_type',
            'refReceivingNo'	=> 'list_no',
            'trafName'			=> 'traf_name',
            'voyageNo'			=> 'voyage_no',
            'tradeCode'			=> 'trade_co',
            'tradeName'			=> 'trade_name',
            'storageCode'		=> 'storage_co',
            'storageName'		=> 'storage_name',
            'agentCode'			=> 'agent_code',
            'agentName'			=> 'agent_name',
			'ownerCode'			=> 'owner_code',
			'ownerName'			=> 'owner_name',
            'billNo'			=> 'bill_no',
            'warehouseCode'		=> 'warehouse_code',
            'grossWeight'		=> 'roughweight',
            'netWeight'         => 'net_weight',
            'packNumber'		=> 'pack_no',
            'importDate'		=> 'import_date',
			'wasteFlag'			=> 'waste_flag',
			'packFlag'			=> 'pack_flag',
			'lawNo'				=> 'law_no',
			'ebcNo'				=> 'ebc_no',
			'despPort'			=> 'desp_port',
			'entryPort'			=> 'entry_port',
			'checkOrgCode'		=> 'check_org_code',
			'orgCode'			=> 'org_code',
			'declPerson'		=> 'decl_person',
			'ciqBillNo'			=> 'ciq_bill_no',
			'contractNo'		=> 'contract_no',
			'transTypeNo'		=> 'trans_type_no',
			'goodsAddress'		=> 'goods_address',
            'note'				=> 'notes',
        );
    }
	
	protected function setProductFields()
    {
        $this->productFields = array(
			'hsCode'			=> 'codeTs',
			'productName'		=> 'nameCn',
			'productModel'		=> 'gModel',
			'productEnName'		=> 'nameEn',
			'quantity'			=> 'gQty',
			'unit'				=> 'gUnit',
			'currencyCode'		=> 'currency',
			'legalQty'			=> 'qty1',
			'legalUnit'			=> 'unit1',
			'legalQty2'			=> 'qty2',
			'legalUnit2'		=> 'unit2',
			'note'				=> 'notes',
        );
    }
	
    public function run()
    {
        $opType = ucfirst($this->_param['opType']);
        // 操作类型
		$error		  = array();
		$ansProcess		= new Service_AsnProccess();
        switch ($opType) {
            case 'Add':
                if (!isset($this->_param['data'])) {
                    $this->_error[] = '缺少[data]参数';
                    return false;
                }
                $postData = $this->_param['data'];
				$conData	= array();
				$productData = $this->productFields;
				if(!empty($postData['products'])){
					foreach($postData['products'] as $key=>$val){
						foreach($val as $k=>$v){
							if(isset($productData[$k])){
								$conData[$key][$productData[$k]] = $v;
							}else{
								$conData[$key][$k]	= $v;
							}
						}
					}
					unset($postData['products']);
				}
				$postData['products'] = $conData;
				$productVaildate =  Service_AsnProccess::validateDetail($postData['products']);
				if(!empty($productVaildate)){
					$error = array_merge($error,$productVaildate);
				}
				$containers	= array();
				if(isset($postData['containers']) && !empty($postData['containers'])){
					foreach($postData['containers'] as $key=>$val){
						$containers[$key]['conta_id']	= $val['containerNo'];
						$containers[$key]['conta_model']= $val['containerModel'];
						$containers[$key]['conta_wt']	= $val['containerWeight'];
						$containers[$key]['conta_num']	= $val['containerNum'];
					}
					$containerVaildate =  Service_AsnProccess::validateBoat($containers);
					if(!empty($containerVaildate)){
						$error = array_merge($error,$containerVaildate);
					}
				}
				$this->_error = $error;
                if (!empty($this->_error)) {
                    return false;
                }
				$mainData	= $this->translate($postData);
				$mainData['products']	= $postData['products'];
				if(!empty($containers))$mainData['containers']	= $containers;
				$asn = $ansProcess->createTransaction($mainData,$this->_customer['customer_id']);
                if(1 != $asn['ask']){
					if(!empty($asn['error'])){
						$this->_error = $asn['error'];
						return false;
					}
				}
                $result['receivingCode']	= $asn['ASNCode'];
				$result['ask']	= 1;
                break;
            case 'Get':
                if (!isset($this->_param['data']['refReceivingNo'])) {
                    $this->_error[] = '缺少内部清单号';
                    return false;
                }
                $receivingInfo = Service_Receiving::getByWhere(
					array(
						'list_no'			=> $this->_param['data']['refReceivingNo'],
						'customer_code'		=> $this->_customer['customer_code'],
					)
				);
                if (empty($receivingInfo)) {
                    $this->_error[] = '入库单不存在';
                    return false;
                }
                $result['ask']				= 1;
                break;
            default:
                $this->_error[] = '操作类型错误,只能是Add、Get';
                return false;
        }
        if ($result['ask'] == 0) {
            $this->_error = $result['error'];
            return false;
        }
        switch ($opType) {
            case 'Add':
                $this->_message = '添加入库单成功';
				$this->_success['receivingCode'] = $result['receivingCode'];
                break;
            case 'Get':
				$this->_message = '获取入库单信息成功';
				$this->_success['status'] = $receivingInfo['receiving_status'];
                $this->_success['customsStatus'] = $receivingInfo['customs_status'];
                $this->_success['ciqStatus'] = $receivingInfo['ciq_status'];
				$this->_success['refReceivingNo'] = $receivingInfo['list_no'];
				$this->_success['receivingCode'] = $receivingInfo['receiving_code'];
				$this->_success['declarationNumber'] = $receivingInfo['declaration_number'];
                break;
        }
        return true;
    }

    /* @desc 验证产品数据正确性
     * @param $params 产品数据
     * @param  $param 原始产品数据
     */
    protected function verification($data, $originalData)
    {
        return $data;
    }

}
