<?php
/**
 * 生成入库单报文XML 
 * @author william
 */
class Service_ReceiptXmlProcess
{
	public $version = '1.0';
	public $sendtime = '';
	
	private $dom = null;
	private $elMessage = null;
	private $elHead = null;
	private $elDeclaration = null;
	private $elBillHead = null;
	
	private $receiving_code = ''; //ASN单号
	private $receivingRow = array();	//ASN信息
	private $fmtRow = array();	//ftp_message_type
	private $productList = array(); //入库单产品信息
	private $UomKeyArr = array();
	private $customer = array(); //客户信息
	
	public function __construct($receiving_code) {
		$this->receiving_code = $receiving_code;
		//$this->sbaRow = Service_ShipBatchAttribute::getByField($sb_code, 'sb_code');
		//$this->fmtRow = Service_FtpMessageType::getByField(1);	//暂时取第1条
		//$aOrderCode = Service_ShipBatch::getOrderCodes($this->sb_code);
		$this->fmtRow = Service_FtpMessageType::getByField('MRK','fmt_code');	//取入库信息ftp_message_type
		$receiving=Service_Receiving::getByField($this->receiving_code,'receiving_code');
		$con = array(
				'receiving_code'=>$this->receiving_code,
		);
		$receivingDetail=Service_ReceivingDetail::getByCondition($con);		
		if(!empty($receivingDetail)){
			$weight=0;
			$skuNumber = 0;
			$hsUomNumber = 0;
			foreach($receivingDetail as $key=>$value){
				$productInfo = Service_Product::getByField($value['product_id']);
				
				$receivingDetail[$key]['hs_code'] = $productInfo['hs_code'];
				
				if($productInfo['hs_code']){
					$hsAttribute = Service_HsAttribute::getByField($productInfo['hs_code'],'hs_code'); //获取海关编码名称
				}
				
				if(!empty($hsAttribute)){
					$receivingDetail[$key]['hs_name'] = $hsAttribute['hs_name'];
				}else{
					$receivingDetail[$key]['hs_name'] = '';
				}
				if($productInfo['hs_code']){
				$hsUomRow = Service_HsUom::getByField($productInfo['hs_code'],'hs_code');
				}
				$receivingDetail[$key]['pu_code_law'] = $hsUomRow['pu_code_law'];
				$receivingDetail[$key]['pu_code_second'] = $hsUomRow['pu_code_second'];
				if($productInfo['product_id']>0){
					$conUomap = array(
						'product_id'=>$productInfo['product_id'],
						'hu_id'=>$hsUomRow['hu_id']			
					);
					$hsUomMapRows = Service_HsUomMap::getByCondition($conUomap);
					//print_r($hsUomMapRows);
					if(!empty($hsUomMapRows)){
						$receivingDetail[$key]['qty_1'] = $hsUomNumber;
						$receivingDetail[$key]['hum_quantity_second'] = $hsUomMapRows['0']['hum_quantity_second'];
					}else{
						foreach($hsUomMapRows as $keyuom=>$valueUom){
							$hsUomNumber += $valueUom['hum_quantity_law'];
						}
						$receivingDetail[$key]['qty_1'] = $hsUomNumber;
						$receivingDetail[$key]['hum_quantity_second'] = '';
						
					}
				}else{
					$receivingDetail[$key]['qty_1'] = $hsUomNumber;
					$receivingDetail[$key]['hum_quantity_second'] = '';
				}
				
				$receivingDetail[$key]['pu_code'] = $productInfo['pu_code'];
				$receivingDetail[$key]['product_declared_value'] = $productInfo['product_declared_value'];
				$receivingDetail[$key]['product_title_en'] = $productInfo['product_title_en'];
				$skuNumber++;
				$weight = $productInfo['product_weight']*$value['rd_receiving_qty'];
			}
			$receiving['weight_all'] = $weight + $receiving['conta_wt'];
			$receiving['g_ty'] = $skuNumber;
		}
		if(!empty($receiving) && $receiving['customer_id']!=''){
			$customer = Service_Customer::getByField($receiving['customer_id'],'customer_id');
			$this->customer = $customer;
		}
		//讲receinv_atribute合并到receiving表中
		
		$this->receivingRow = $receiving;
		$this->productList = $receivingDetail;
		/* if(!empty($receivingDetail)){
			foreach($receivingDetail as $kre=>$vre){
				$product=Common_DataCache::getProduct($vre['product_id'],$customerId);
				$receivingDetail[$kre]['product_sku'] = $product['product_sku'];
				$receivingDetail[$kre]['product_title'] = $product['product_title'];
				$receivingDetail[$kre]['category_name'] = $product['category_name'];
			}
		} */
		
		//$this->productList = Service_OrderProduct::getOutBillProducts($aOrderCode);
		//$this->UomKeyArr = Service_HsUom::getKeyArr();		
		//发送时间
		$this->sendtime = date('YmdHis').str_pad(rand(1,888), 3, '0', STR_PAD_LEFT);
	}
	
	/**
	 * 创建根节点Message
	 */
	private function createMessage() {
		$this->dom = new DOMDocument('1.0', 'UTF-8');
		$this->elMessage = $this->dom->createElement('Message');
		$this->elMessage->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
		$this->dom->appendChild($this->elMessage);
	}
	
	/**
	 * 创建Head节点
	 */
	private function createHead() {
		$this->elHead = $this->dom->createElement('Head');
		$this->elHead->appendChild($this->dom->createElement('MessageID', ++$this->fmtRow['fmt_form_id']));
		$this->elHead->appendChild($this->dom->createElement('FunctionCode','2')); //未知先设为2
		$this->elHead->appendChild($this->dom->createElement('MessageType', $this->fmtRow['fmt_type']));
		$this->elHead->appendChild($this->dom->createElement('SenderID', $this->fmtRow['fml_sender_id']));
		$this->elHead->appendChild($this->dom->createElement('ReceiverID', $this->fmtRow['fml_receiver_id']));
		$this->elHead->appendChild($this->dom->createElement('SendTime', $this->sendtime));
		$this->elHead->appendChild($this->dom->createElement('Version', $this->version));
		$this->elMessage->appendChild($this->elHead);
	}
	
	/**
	 * 创建Declaration节点
	 */
	private function createDeclaration() {
		$this->elDeclaration = $this->dom->createElement('Declaration');
		$this->elMessage->appendChild($this->elDeclaration);		
	}
	
	/**
	 * 创建WAREHOUSE_BILL_HEAD节点
	 */
	private function createBillHead() {
		$this->elBillHead = $this->dom->createElement('WAREHOUSE_BILL_HEAD');
		$this->elBillHead->appendChild($this->dom->createElement('SERIAL_NO'));
		$this->elBillHead->appendChild($this->dom->createElement('FORM_ID', $this->receiving_code));
		$this->elBillHead->appendChild($this->dom->createElement('DECL_PORT', $this->fmtRow['fmt_decl_port']));
		$this->elBillHead->appendChild($this->dom->createElement('I_E_PORT', $this->receivingRow['ie_port']));
		$this->elBillHead->appendChild($this->dom->createElement('I_E_MODE', $this->fmtRow['fmt_ie_mode']));
		$this->elBillHead->appendChild($this->dom->createElement('PS_TYPE', $this->fmtRow['fml_ps_type']));
		$this->elBillHead->appendChild($this->dom->createElement('RELATIVE_FORM_TYPE', $this->fmtRow['relative_form_type']));
		$this->elBillHead->appendChild($this->dom->createElement('FORM_TYPE', $this->fmtRow['fml_ps_type']));
		$this->elBillHead->appendChild($this->dom->createElement('EMS_NO', $this->fmtRow['fml_ems_no']));
		$this->elBillHead->appendChild($this->dom->createElement('EMS_COP_NO')); //从ftp_message_receivelist和ftp_message_sendlist取ems_cop_no 唯一编号7位数字，8开头。同一个出入库单是一样
		$this->elBillHead->appendChild($this->dom->createElement('TRAF_NAME', ''));
		//if($this->sbaRow['traf_name']=='truck') $this->sbaRow['voyage_no'] = '';
		$this->elBillHead->appendChild($this->dom->createElement('VOYAGE_NO', '')); //航船
		$this->elBillHead->appendChild($this->dom->createElement('BILL_NO'));
		$this->elBillHead->appendChild($this->dom->createElement('GROSS_WT', $this->receivingRow['weight_all']));
		$this->elBillHead->appendChild($this->dom->createElement('NET_WT', '0')); //receiving_attribute表中没有net_wt字段
		$this->elBillHead->appendChild($this->dom->createElement('PACK_NO', $this->receivingRow['pack_no']));
		$this->elBillHead->appendChild($this->dom->createElement('WRAP_TYPE', $this->receivingRow['wrap_type']));
		$this->elBillHead->appendChild($this->dom->createElement('I_E_DATE'));
		$this->elBillHead->appendChild($this->dom->createElement('TRAF_MODE', $this->receivingRow['traf_mode']));
		$this->elBillHead->appendChild($this->dom->createElement('TRADE_CO', $this->fmtRow['fml_receiver_id']));
		$this->elBillHead->appendChild($this->dom->createElement('TRADE_NAME', $this->fmtRow['fml_receiver_id']));
		$this->elBillHead->appendChild($this->dom->createElement('TRADE_MODE', $this->receivingRow['trade_mode']));
		$this->elBillHead->appendChild($this->dom->createElement('TRANS_MODE', $this->receivingRow['trans_mode']));
		$this->elBillHead->appendChild($this->dom->createElement('AGENT_CODE', $this->fmtRow['agent_code']));
		$this->elBillHead->appendChild($this->dom->createElement('AGENT_NAME', $this->fmtRow['agent_name']));
		$this->elBillHead->appendChild($this->dom->createElement('TRADE_COUNTRY', '142')); //写死
		$this->elBillHead->appendChild($this->dom->createElement('OWNER_CODE', $this->customer['trade_co']));
		$this->elBillHead->appendChild($this->dom->createElement('OWNER_NAME', $this->customer['trade_name']));
		$this->elBillHead->appendChild($this->dom->createElement('NOTE_S'));
		$this->elBillHead->appendChild($this->dom->createElement('RELATIVE_FORM_ID'));
		$this->elBillHead->appendChild($this->dom->createElement('RELATIVE_FORM_STATUS'));
		$this->elBillHead->appendChild($this->dom->createElement('INPUT_DATE'));
		$this->elBillHead->appendChild($this->dom->createElement('INPUT_NO'));
		$this->elBillHead->appendChild($this->dom->createElement('FORM_STATUS'));
		$this->elBillHead->appendChild($this->dom->createElement('D_DATE'));
		$this->elBillHead->appendChild($this->dom->createElement('CHK_DATE'));
		$this->elBillHead->appendChild($this->dom->createElement('CHK_STATUS'));
		$this->elBillHead->appendChild($this->dom->createElement('AUDIT_DATE'));
		$this->elBillHead->appendChild($this->dom->createElement('CAN_BINDING_DATE'));
		$this->elBillHead->appendChild($this->dom->createElement('CAN_CHANNEL_DATE'));
		$this->elBillHead->appendChild($this->dom->createElement('DEDUC_DATE'));
		$this->elBillHead->appendChild($this->dom->createElement('COP_GB_CODE', $this->customer['trade_co']));
		$this->elBillHead->appendChild($this->dom->createElement('EMC_EPORTCARD_ID'));
		$this->elBillHead->appendChild($this->dom->createElement('SIGN'));
		$this->elBillHead->appendChild($this->dom->createElement('DESTINATION_PORT'));
		$this->elBillHead->appendChild($this->dom->createElement('TURN_NO'));
		$this->elBillHead->appendChild($this->dom->createElement('CUS_CODE', $this->fmtRow['outbound_trade_co']));
		$this->elBillHead->appendChild($this->dom->createElement('CUS_NAME', $this->fmtRow['outbound_trade_name']));
		$this->elBillHead->appendChild($this->dom->createElement('DECLARE_REMARK'));
		$this->elDeclaration->appendChild($this->elBillHead);
	}
	
	/**
	 * 创建WAREHOUSE_BILL_CONTAINER节点
	 * @return DOMElement
	 */
	/* private function createBillContainer() {
		$elBillContainer = $this->dom->createElement('WAREHOUSE_BILL_CONTAINER');
		$elBillContainer->appendChild($this->dom->createElement('FORM_ID', $this->sb_code));
		$elBillContainer->appendChild($this->dom->createElement('CONTA_ID', $this->sbaRow['conta_id']));
		$elBillContainer->appendChild($this->dom->createElement('CONTA_MODEL', $this->sbaRow['conta_model']));
		$elBillContainer->appendChild($this->dom->createElement('CONTA_WT', $this->sbaRow['conta_wt']));
		$this->elBillHead->appendChild($elBillContainer);		
	} */
	
	/**
	 * 创建WAREHOUSE_BILL_LIST节点
	 * @param int $no
	 * @param array $info
	 * @return DOMElement
	 */
	private function createBillList($no, $info) {
		$elBillList = $this->dom->createElement('WAREHOUSE_BILL_LIST');
		$elBillList->appendChild($this->dom->createElement('FORM_ID', $this->receiving_code));
		$elBillList->appendChild($this->dom->createElement('G_NO', $no));
		$elBillList->appendChild($this->dom->createElement('GOODS_ID', $info['product_id']));
		$elBillList->appendChild($this->dom->createElement('MERGER_G_NO', $no));
		$elBillList->appendChild($this->dom->createElement('MERGER_MODE', 1));	//固定传1
		$elBillList->appendChild($this->dom->createElement('CODE_TS', $info['hs_code']));
		$elBillList->appendChild($this->dom->createElement('G_NAME_CN', $info['hs_name']));
		$hemList = Service_HsElementMap::getByCondition(array('product_id'=>$info['product_id']), 'hem_detail');
		$elements = array();
		foreach($hemList as $hemRow) $elements[] = $hemRow['hem_detail'];
		$elBillList->appendChild($this->dom->createElement('G_MODEL', implode('|',$elements)));
		$elBillList->appendChild($this->dom->createElement('G_NAME_EN', $info['product_title_en']));
		$elBillList->appendChild($this->dom->createElement('G_QTY', $info['rd_receiving_qty']));
		$elBillList->appendChild($this->dom->createElement('G_UNIT', $info['pu_code']));
		$elBillList->appendChild($this->dom->createElement('DECL_PRICE', $info['product_declared_value']));
		$elBillList->appendChild($this->dom->createElement('CURR', $this->customer['customer_currency']));		
		$elBillList->appendChild($this->dom->createElement('QTY_1', $info['qty_1']));
		$pu_code_law = isset($this->UomKeyArr[$info['hs_code']]) ? $this->UomKeyArr[$info['hs_code']]['pu_code_law'] : '';
		$elBillList->appendChild($this->dom->createElement('UNIT_1', $info['pu_code_law']));
		$elBillList->appendChild($this->dom->createElement('QTY_2', '0'));
		$pu_code_second = isset($this->UomKeyArr[$info['hs_code']]) ? $this->UomKeyArr[$info['hs_code']]['pu_code_second'] : '';
		$elBillList->appendChild($this->dom->createElement('UNIT_2', $pu_code_second));
		$elBillList->appendChild($this->dom->createElement('ORIGIN_COUNTRY', '110'));	//固定110
		$elBillList->appendChild($this->dom->createElement('DUTY_MODE', '一般征税'));	//写死
		$elBillList->appendChild($this->dom->createElement('USE_TO', '11'));	//固定11
		$elBillList->appendChild($this->dom->createElement('NOTE_S', ''));
		$elBillList->appendChild($this->dom->createElement('CAR_NO', ''));
		$elBillList->appendChild($this->dom->createElement('URM_NO', ''));
		$elBillList->appendChild($this->dom->createElement('BIND_DATE', ''));
		$elBillList->appendChild($this->dom->createElement('CHANNEL_DATE', ''));
		$elBillList->appendChild($this->dom->createElement('DECL_TOTAL', $info['product_declared_value']*$info['rd_receiving_qty']));
		return $elBillList;
	}
	
	/**
	 * 生成XML文档
	 * @param string $path
	 * @return int|string
	 */
	public function generate($path='') {
		$this->createMessage();
		$this->createHead();
		$this->createDeclaration();
		$this->createBillHead();
		foreach($this->productList as $no=>$product) {
			++$no;
			$this->elBillHead->appendChild($this->createBillList($no, $product));
		}
		//$this->createBillContainer();
		if($path) return $this->dom->save($path);
		return $this->dom->saveXML();
	}
	
}
