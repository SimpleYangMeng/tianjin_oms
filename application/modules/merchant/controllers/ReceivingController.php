<?php
class Merchant_ReceivingController extends Ec_Controller_Action
{

    public function preDispatch()
    {
	set_time_limit(300);
        $this->tplDirectory = "merchant/views/receiving/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
        //print_r($this->customerAuth);
        //$this->customerId = Service_Login::getLoginInfo()->customer['customer_id'];
        $this->customerId = $this->_customerAuth['id'];
    }

    public function indexAction()
    {
        $this->listbhAction();
    }
		
	/**
	 * @author william-fan
	 * @todo  创建ASN 及 编辑ASN （备货模式）
	 */
	public function createAction() {
		set_time_limit(1800);
		$customer = $this->_customerAuth;
		$ASNCode = $this->_request->getParam('ASNCode', '');
        $result = array(
        		'ask' => '0', 
        		'msg' => '', 
        		'ASNCode' => '',
        		'navTabId'=> 'asnAdd',
        		'callbackType'	=> 'forward',
        		'forwardUrl'	=> '/merchant/receiving/list'
        	);
        $customerId = $customer['id'];
        if ($this->_request->isPost()) {
            $data = $this->getRequest()->getParams();
            
            $ASNObj = new Service_AsnProccess();
			$data['customerId'] = $customerId;      
            $doresult = $ASNObj->createTransaction($data, $customerId);
            if (isset($doresult['msg'])) {
                $result['msg'] = $doresult['msg'];
            }
            $result['error']=$doresult['error'];
            $result['ask']=$doresult['ask'];
            $result['ASNCode'] = $doresult['ASNCode'];
			die(json_encode($result));
        }
        $ecg_category = Common_DataCache::getProductCategory();
        $this->view->ecg_category = $ecg_category;

        $this->view->receiving_code = $ASNCode;
        
        $receivingDetail = '';
        $tpl = 'receiving-create.tpl'; 
        
        $receivemodel = $this->_request->getParam('receivemodel','');
		$receive_type = $this->_request->getParam('receive_type','');
		
        $type = $this->_request->getParam('type','');
		$this->view->actionLabel="add";
        $this->view->receivingDetail = $receivingDetail;
  
        $this->view->country = Service_Country::getAll();

        $wrapTypes = Service_WrapType::getAll(); //包装种类
        $this->view->wrapTypes = $wrapTypes;

        $iePorts = Service_IePort::getAll();
        $this->view->iePorts = $iePorts;
		
		$this->view->trafTool	= Service_TrafTool::getAll();
        $contrafModes = array(
        	'is_display'=>'1'
        );
        $trafModes = Service_TrafMode::getByCondition($contrafModes); //出入港区运输方式
        $this->view->trafModes=$trafModes;
        $tradeModes = Service_TradeMode::getAll(); //监管方式
        $this->view->tradeModes=$tradeModes;

        $transModes = Service_TransMode::getByCondition(array('is_display'=>'1')); //成交方式
        $this->view->transModes=$transModes;
		
		$conformtypes = array(
        	'is_display'=>'1'
        );
        $formtypes = Service_FormType::getByCondition($conformtypes);
        $this->view->organization = Service_Organization::getByCondition(array('is_display'=>1));
        $this->view->dPort =  Service_Port::getByCondition(array('port_type'=>'1'));
        $this->view->ePort =  Service_Port::getByCondition(array('port_type'=>'0'));
        $this->view->formtypes=$formtypes;
		$this->view->customer	= $customer;
        $warehouseAll = Common_DataCache::getWarehousebh();
		$this->view->warehouseArr = $warehouseAll;
		$tpl = 'bh-receiving-create.tpl';
		$receivingUpload	= new Zend_Session_Namespace('receivingUpload');
		if(isset($receivingUpload->uploadData))unset($receivingUpload->uploadData);
		if(isset($receivingUpload->boatUploadData))unset($receivingUpload->boatUploadData);
		echo Ec::renderTpl($this->tplDirectory . $tpl,  'noleftlayout');
    }
    /*
     * 验证参考号
     * @return ask,msg
     */
    public function checkRefcodeAction()
    {
		$Customer_Reference_exists_lang = Ec_Lang::getInstance()->getTranslate('Customer_Reference_exists');
        $result = array('ask' => '0', 'msg' => $Customer_Reference_exists_lang);
        if ($this->_request->isPost()) {
            $refCode = $this->_request->refCode;
            if (Service_AsnProccess::checkReferenceNo(array('reference_no'=>$refCode,'customer_id'=>$this->customerId))) {
                $result = array('ask' => '1', 'msg' => 'Success');
            }
        }
        die(json_encode($result));
    }

    /**
     * @author william-fan
     * @todo ASN 列表(备货模式)
     */
    public function listbhAction()
    {
    	$customer = $this->_customerAuth;
        $allStatus = Service_AsnProccess::getAsnStatus();
		$customerId = $customer['id'];
		$page = $this->_request->getParam('page', 1);
		$pageSize = $this->_request->getParam('pageSize', 20);

		$listNo = trim($this->_request->getParam('list_no', ''));
		$receiving_type	= $this->_request->getParam('receiving_type', '');
		$receiving_status = $this->_request->getParam('receiving_status', '0');
		$declaration_number = trim($this->_request->getParam('declaration_number', ''));
		$declPort = $this->_request->getParam('decl_port', '');
        $ciq_status = $this->_request->getParam('ciqStatus', '');
        $customs_status = $this->_request->getParam('customsStatus', '');
		
		$created_start_s = $created_start	= $this->_request->getParam('created_start','');
		$created_end_s = $created_end	= $this->_request->getParam('created_end','');
		$created_start	= ($created_start)?$created_start.' 00:00:00':'';
		$created_end	= ($created_end)?$created_end.' 59:59:59':'';
		$page = $page ? $page : 1;
		$pageSize = $pageSize ? $pageSize : 20;
		$condition = array(
			'list_no'	=> $listNo,
			'decl_port'=>$declPort,
			'receiving_status' => $receiving_status,
			'created_start'=>$created_start,
			'created_end'  =>$created_end,
			'declaration_number'=>$declaration_number,
			'customer_id'=>$customerId,
			'receiving_type'=>$receiving_type,
            'customs_status'=>$customs_status,
            'ciq_status'=>$ciq_status,
		);
		$count = Service_Receiving::getByCondition($condition, 'count(*)');
		$result='';
		if ($count > 0) {
			$result = Service_Receiving::getByCondition($condition, '*', $pageSize, $page, array('receiving_id desc'));
		}
		$this->view->status	= $allStatus;
		if(!empty($allStatus)){
			$numConditon = $condition;
			foreach($allStatus as $keys=>$values){
				$numConditon['receiving_status'] = $keys;
				$countstatus = Service_Receiving::getByCondition($numConditon, 'count(*)');
				$allStatus[$keys] = $values."({$countstatus})";
			}
		}
		$iePortsCode	= array();
		$iePorts = Service_IePort::getAll();
		foreach($iePorts as $key=>$val){
			$iePortsCode[$val['ie_port']]	= $val;
		}
        $this->view->ciqStatus = Service_AsnProccess::getCiqStatus();
        $this->view->customsStatus = Service_AsnProccess::getCustomsStatus();
        $this->view->iePorts = $iePorts;
		$this->view->iePortsCode = $iePortsCode;
		$this->view->page		= $page;
		$this->view->pageSize	= $pageSize;
        $this->view->count		= $count;
        $this->view->AsnStatusArr = $allStatus;
        $this->view->receiving_status = $receiving_status;		
        $this->view->result = $result;
        $this->view->params = $condition;
        $this->view->customerLogin = $customer;
        echo Ec::renderTpl($this->tplDirectory . "bh-receiving-list.tpl",  'noleftlayout');
    }
	
	public function uploadListnoAction()
	{
		$result = array('ask' => '0', 'message' => '');
		$customer = $this->_customerAuth;
		$receivingNo	= $this->_request->getParam('ASNCode');
		$type	= $this->_request->getParam('type','');
		$declaration_number	= $this->_request->getParam('declaration_number','');
		$ASNObj = new Service_AsnProccess();
		$result	= $ASNObj->uploadListno($receivingNo,$type,$declaration_number,$customer);
		die(json_encode($result));
		exit;
	}
  	
    /*
    * 获取ASN 详细产品
    */
    public function detailAction()
    {
        $ASNCode = $this->_request->getParam('ASNCode', '');

        $asnRow = Service_Receiving::getByField($ASNCode,'receiving_code',"*");
		if($asnRow['receiving_add_user']=='0'){
			$receivingAddUser = Service_User::getByField($asnRow['receiving_add_user'],"user_id","*");
			$asnRow['add_user'] = Ec_Lang::getInstance()->getTranslate('Customer');
		}else{
			$receivingAddUser = Service_User::getByField($asnRow['receiving_add_user'],"user_id","*");
			$asnRow['add_user'] =$receivingAddUser['user_code'];
		}
        $lastUpdateUser = Service_User::getByField($asnRow['receiving_update_user'],"user_id","*");
        $asnRow['luuser'] = $lastUpdateUser['user_code'];
		if($asnRow['ie_port']){
			$ieport = Service_IePort::getByField($asnRow['ie_port'],"ie_port","*");
			$asnRow['ie_port_name'] = $ieport['ie_port_name'];
		}
		if($asnRow['decl_port']){
			$ieport = Service_IePort::getByField($asnRow['decl_port'],"ie_port","*");
			$asnRow['decl_port_name'] = $ieport['ie_port_name'];
		}
		/*
		if($asnRow['destination_port']){
			$port = Service_Port::getByField($asnRow['destination_port'],"port_code","*");
			$asnRow['destination_port_name'] = $port['port_name'];
		}
		*/
		if($asnRow['destination_port']){
			$country = Service_Country::getByField($asnRow['destination_port'],"trade_country","*");
			$asnRow['destination_port_name'] = $country['country_name'];
		}
		if($asnRow['form_type']){
			$fromType = Service_FormType::getByField($asnRow['form_type'],"form_type","*");
			$asnRow['form_type_name'] = $fromType['form_type_name'];
		}
		if($asnRow['wrap_type']){
			$wrapType = Service_WrapType::getByField($asnRow['wrap_type'],"wrap_type","*");
			$asnRow['wrap_type_name'] = $wrapType['wrap_type_name'];
		}
		if('' !== $asnRow['traf_mode']){
			$traf_mode = Service_TrafMode::getByField($asnRow['traf_mode'],"traf_mode","*");
			$asnRow['traf_mode_name'] = $traf_mode['traf_mode_name'];
		}
		if($asnRow['trade_mode']){
			$trade_mode = Service_TradeMode::getByField($asnRow['trade_mode'],"trade_mode","*");
			$asnRow['trade_mode_name'] = $trade_mode['trade_mode_name'];
		}
		if($asnRow['trans_mode']){
			$trans_mode = Service_TransMode::getByField($asnRow['trans_mode'],"trans_mode","*");
			$asnRow['trans_mode_name'] = $trans_mode['trans_mode_name'];
		}
		if($asnRow['trade_country']){
			$countryInfo = Service_Country::getByField($asnRow['trade_country'],"country_code","*");
			$asnRow['trade_country_code'] = $countryInfo['trade_country'];
			$asnRow['trade_country_name'] = $countryInfo['country_name'];
		}
		if($asnRow['desp_port']){
			$portInfo = Service_Port::getByField($asnRow['desp_port'],"port_code","*");
			$asnRow['desp_port_name'] = $portInfo['port_name'];
		}
		if($asnRow['entry_port']){
			$portInfo = Service_Port::getByField($asnRow['entry_port'],"port_code","*");
			$asnRow['entry_port_name'] = $portInfo['port_name'];
		}
		if($asnRow['check_org_code']){
			$organizationInfo = Service_Organization::getByField($asnRow['check_org_code'],"organization_code");
			$asnRow['check_org_code_name'] = $organizationInfo['organization_name'];
		}
		if($asnRow['org_code']){
			$organizationInfo = Service_Organization::getByField($asnRow['org_code'],"organization_code");
			$asnRow['org_code_name'] = $organizationInfo['organization_name'];
		}
        $this->view->asnStatus = Service_AsnProccess::getAsnStatus();
        $this->view->ciqStatus = Service_AsnProccess::getCiqStatus();
        $this->view->customsStatus = Service_AsnProccess::getCustomsStatus();
        $this->view->receivingType = array(
			'0'=>'',
            '1'=>"报关",
            '2'=>"转关",
        );
        $detail = Service_ReceivingDetail::getByCondition(array('receiving_code'=>$ASNCode),"*");
		
		$merge	= Service_ReceivingDetailMerge::getByCondition(array('receiving_code'=>$ASNCode));
		$container	= Service_ReceivingContainer::getByCondition(array('receiving_code'=>$ASNCode));
		$this->view->merge = $merge;
		$this->view->container = $container;
		$this->view->productUom	= Common_DataCache::getProductUomCode();
		$this->view->countryCache	= Common_DataCache::getCountryCode();
        $this->view->detail = $detail;
        $logs = Service_ReceivingLog::getByCondition(array('receiving_code'=>$ASNCode),"*",0,0,'rl_id desc');
        foreach($logs as $k=>$v){
            if($v['user_id']>0){
                $user = Service_User::getByField($v['user_id'],"user_id","*");
                $logs[$k]['user_code'] = $user['user_code'];
            }
        }
        $this->view->logs = $logs;
		$this->view->asnRow = $asnRow;
        echo Ec::renderTpl($this->tplDirectory . "receiving-detail.tpl",  'noleftlayout');
    }

    //下载清单
        public function downloadAction(){
        set_time_limit(300);
        ini_set('memory_limit', '1024M');
        require_once APPLICATION_PATH . '/../libs/PHPExcel.php';
        require_once APPLICATION_PATH . '/../libs/PHPExcel/IOFactory.php';
        $objLoad   = PHPExcel_IOFactory::load(APPLICATION_PATH."/../data/file/ASN-invoice.xls");
        $objWriter = PHPExcel_IOFactory::createWriter($objLoad, 'Excel5');
        //print_r($receivingCode);exit;
        $receivingCode = $this->_request->getParam("receiving_code","");
         $receivingXml=Service_ReceivingXml::getByCondition(array('receiving_code'=>$receivingCode),"*");
           $receivingInfo = Service_Receiving::getByField($receivingCode,"receiving_code","*");
      
        $ReceivingAttribute = Service_ReceivingAttribute::getByField($receivingCode,'receiving_code');
         if (empty($receivingXml)) {
             $receivingDetail = Service_ReceivingDetail::getByCondition(array('receiving_code'=>$receivingCode));
              $objSheeti  = $objLoad->setActiveSheetIndex(0);
              //invoice信息
            $time=explode(" ",$receivingInfo['receiving_add_time']);
            $objSheeti->setCellValueExplicit('E4',$receivingInfo['reference_no'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheeti->setCellValueExplicit('F4',$time[0], PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheeti->setCellValueExplicit('E7',$receivingInfo['trake_code'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheeti->setCellValueExplicit('F7',$receivingInfo['cabinet_no'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheeti->setCellValueExplicit('E10',$receivingCode, PHPExcel_Cell_DataType::TYPE_STRING);
           
        $index=15;
        $qty=0; //数量
        $sum=0;  //总价
        $weight=0;  //总重量
        $rouweight=0; //总毛重
        foreach ($receivingDetail as $key => $value) {
            $products=Service_Product::getByField($value['product_id'],"product_id");
            if (!empty($products)) {
                $objSheeti->setCellValueExplicit('B'.$index,$products['product_sku'], PHPExcel_Cell_DataType::TYPE_STRING);
                $objSheeti->setCellValueExplicit('C'.$index,$products['product_title'], PHPExcel_Cell_DataType::TYPE_STRING);
                $objSheeti->setCellValueExplicit('D'.$index,$value['rd_receiving_qty'], PHPExcel_Cell_DataType::TYPE_STRING);
                $objSheeti->setCellValueExplicit('E'.$index,$products['product_declared_value'], PHPExcel_Cell_DataType::TYPE_STRING);
                $objSheeti->setCellValueExplicit('F'.$index,$value['rd_receiving_qty']*$products['product_declared_value'], PHPExcel_Cell_DataType::TYPE_STRING);
            }
            $qty+=$value['rd_receiving_qty'];
            $sum+=$value['rd_receiving_qty']*$products['product_declared_value'];
            $weight+=$products['product_weight']*$value['rd_receiving_qty'];
            $rouweight+=$value['rouweight'];
            $index++;
        } 
        $sum=number_format($sum,2);
        $weight=number_format($weight,4);
        if ($receivingInfo['wrap_type']=='2') {
           $objSheeti->setCellValueExplicit('B'.($index+2),'TOTAL: '.$receivingInfo['pack_no'].'(CARTONS)', PHPExcel_Cell_DataType::TYPE_STRING); 
        }
         if ($receivingInfo['wrap_type']=='5') {
           $objSheeti->setCellValueExplicit('B'.($index+2),'TOTAL: '.$receivingInfo['pack_no'].'(Pallets)', PHPExcel_Cell_DataType::TYPE_STRING); 
        }
        $objSheeti->getStyle('B'.($index+2))->getFont()->setBold(true);
        //设置边框
        $objSheeti->getStyle('A'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('B'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('C'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('D'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('E'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('F'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->setCellValueExplicit('D'.($index+2),$qty, PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('F'.($index+2),'CNY '.$sum, PHPExcel_Cell_DataType::TYPE_STRING);  
        $objSheeti->setCellValueExplicit('D'.($index+5),'TOTAL NET WEIGHT : ', PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('D'.($index+6),'TOTAL GROSS WEIGHT : ', PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('D'.($index+7),'TOTAL CBM : ', PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('E'.($index+7),$receivingInfo['volumnweight'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('E'.($index+5),$weight, PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('E'.($index+6),$rouweight, PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('F'.($index+5),'KG', PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('F'.($index+6),'KG', PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('D'.($index+10),$receivingInfo['receiving_name'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->getStyle('E'.($index+5))->getFont()->setBold(true);
        $objSheeti->getStyle('E'.($index+6))->getFont()->setBold(true);
        //设置底部边框
        $objSheeti->getStyle('E'.($index+14))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('F'.($index+14))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->mergeCells('D'.($index+10).":F".($index+13));
        $objSheeti->getStyle('D'.($index+10))->getAlignment()->setWrapText(true);
        $objSheeti->getStyle('D'.($index+5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objSheeti->getStyle('D'.($index+6))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objSheeti->getStyle('D'.($index+7))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objSheeti->getStyle('D'.($index+10))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objSheeti->setTitle('INVOICE');
         }else{
            foreach ($receivingXml as $k => $v) { 

             $receivingDetail =Service_ReceivingXmlDetail::getByCondition(array('sub_receiving_code'=>$v['sub_receiving_code']));
                $objLoad->createSheet();
                $objSheeti  = $objLoad->setActiveSheetIndex($k);
                if ($k>0) {
                   $objSheeti->setCellValueExplicit('A1', 'INVOICE');
                   $objSheeti->mergeCells('A1:F1');
                   $objSheeti->getStyle('A1')->getFont()->setSize(22);
                   $objSheeti->getStyle('A1')->getFont()->setBold(true);
                   $objSheeti->getStyle('A1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
                   $objSheeti->setCellValueExplicit('A3', 'Sold by Order and for Account and risk of');
                   $objSheeti->setCellValueExplicit('A4', 'MESSRS:  (CONSIGNEE’S NAME AND ADDRESS)');
                   $objSheeti->setCellValueExplicit('A5', 'Shenzhen Globex e-Services Limited');
                   $objSheeti->setCellValueExplicit('A6', '4/F, Block 5, Qianhaiwan Free Trade Port Area, No.53 Linhai Rd. ');
                   $objSheeti->setCellValueExplicit('A7', 'Nanshan District, Shenzhen, P.R.C');
                   $objSheeti->setCellValueExplicit('A8', 'Tel: 0755-21629175');
                   $objSheeti->setCellValueExplicit('E3', 'Invoice No.');
                   $objSheeti->setCellValueExplicit('F3', 'Date');
                   $objSheeti->setCellValueExplicit('E6', 'B/L No.');
                   $objSheeti->setCellValueExplicit('F6', '柜号：');
                   $objSheeti->setCellValueExplicit('A9', 'Shipped per');
                   $objSheeti->setCellValueExplicit('C9', 'Sailing on or about');
                   $objSheeti->setCellValueExplicit('E9', 'ASN');
                   $objSheeti->setCellValueExplicit('A11', 'From');
                   $objSheeti->setCellValueExplicit('C11', 'To');
                   $objSheeti->setCellValueExplicit('E11', 'Terms/Method of Payment');
                   $objSheeti->setCellValueExplicit('C12', 'Shenzhen,China');
                   $objSheeti->setCellValueExplicit('A14', 'Marks & Numbers');
                   $objSheeti->setCellValueExplicit('B14', 'SKU #');
                   $objSheeti->setCellValueExplicit('C14', 'Description of Goods');
                   $objSheeti->setCellValueExplicit('D14', 'Quantity');
                   $objSheeti->setCellValueExplicit('E14', 'Unit Price');
                   $objSheeti->setCellValueExplicit('F14', 'Total Amount');
                   $objSheeti->getColumnDimension('A')->setWidth('10.1');
                   $objSheeti->getColumnDimension('B')->setWidth('12');
                   $objSheeti->getColumnDimension('C')->setWidth('60');
                   $objSheeti->getColumnDimension('D')->setWidth('16');
                   $objSheeti->getColumnDimension('E')->setWidth('16');
                   $objSheeti->getColumnDimension('F')->setWidth('16');
                   $objSheeti->getRowDimension('1')->setRowHeight(51);
                   $objSheeti->getRowDimension('3')->setRowHeight(27);
                   $objSheeti->getRowDimension('9')->setRowHeight(28.5);
                   $objSheeti->getRowDimension('11')->setRowHeight(28.5);
                   $objSheeti->getRowDimension('12')->setRowHeight(28.5);
                   $objSheeti->getRowDimension('14')->setRowHeight(29.5);
                   //设置边框
                    $sharedStyle1 = new PHPExcel_Style();
                    $sharedStyle1->applyFromArray(
                    array('borders' => array(
                        'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
                        ));
                $objSheeti->setSharedStyle($sharedStyle1, "A3:F3");
                $objSheeti->setSharedStyle($sharedStyle1, "E6:F6");
                $objSheeti->setSharedStyle($sharedStyle1, "A9:D9");
                $objSheeti->setSharedStyle($sharedStyle1, "A11:F11");
                $objSheeti->setSharedStyle($sharedStyle1, "A13:F13");
                $objSheeti->setSharedStyle($sharedStyle1, "A14:F14");
                $objSheeti->setSharedStyle($sharedStyle1, "A15:F15");
                    $sharedStyle2 = new PHPExcel_Style();
                    $sharedStyle2->applyFromArray(
                    array('borders' => array(
                        'left'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
                        ));
                $objSheeti->setSharedStyle($sharedStyle2, "D9:D12");
                $objSheeti->setSharedStyle($sharedStyle2, "E3:E12");
                $objSheeti->getStyle('E3')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objSheeti->getStyle('E6')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objSheeti->getStyle('D9')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objSheeti->getStyle('D11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objSheeti->getStyle('E11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objSheeti->getStyle('A14:F14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objSheeti->getStyle('C14:F14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objSheeti->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
                $objSheeti->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objSheeti->getDefaultStyle()->getFont()->setName('Times New Roman'); 
               }
               //invoice信息
            $time=explode(" ",$receivingInfo['receiving_add_time']);
            $objSheeti->setCellValueExplicit('E4',$receivingInfo['reference_no'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheeti->setCellValueExplicit('F4',$time[0], PHPExcel_Cell_DataType::TYPE_STRING);          
            $objSheeti->setCellValueExplicit('E7',$receivingInfo['trake_code'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheeti->setCellValueExplicit('F7',$receivingInfo['cabinet_no'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheeti->setCellValueExplicit('E10',$v['sub_receiving_code'], PHPExcel_Cell_DataType::TYPE_STRING);      
        $index=15;
        $qty=0; //数量
        $sum=0;  //总价
        $weight=0;  //总重量
        $rouweight=0; //总毛重
        foreach ($receivingDetail as $key => $value) {
            $products=Service_Product::getByField($value['goods_id'],"goods_id");
           $receivings = Service_ReceivingDetail::getByCondition(array('receiving_code'=>$receivingCode,'product_id'=>$products['product_id']));
            if (!empty($products)) {
                $objSheeti->setCellValueExplicit('B'.$index,$products['product_sku'], PHPExcel_Cell_DataType::TYPE_STRING);
                $objSheeti->setCellValueExplicit('C'.$index,$products['product_title'], PHPExcel_Cell_DataType::TYPE_STRING);
                $objSheeti->setCellValueExplicit('D'.$index,$receivings[0]['rd_receiving_qty'], PHPExcel_Cell_DataType::TYPE_STRING);
                $objSheeti->setCellValueExplicit('E'.$index,$products['product_declared_value'], PHPExcel_Cell_DataType::TYPE_STRING);
                $objSheeti->setCellValueExplicit('F'.$index,$receivings[0]['rd_receiving_qty']*$products['product_declared_value'], PHPExcel_Cell_DataType::TYPE_STRING);
            }
            $qty+=$receivings[0]['rd_receiving_qty'];
            $sum+=$receivings[0]['rd_receiving_qty']*$products['product_declared_value'];
            $weight+=$products['product_weight']*$receivings[0]['rd_receiving_qty'];
            $rouweight+=$receivings[0]['rouweight'];
            $index++;
        } 
        $sum=number_format($sum,2);
        $weight=number_format($weight,4);
        if ($receivingInfo['wrap_type']=='2') {
           $objSheeti->setCellValueExplicit('B'.($index+2),'TOTAL: '.$v['receiving_pack_no'].'(CARTONS)', PHPExcel_Cell_DataType::TYPE_STRING); 
        }
         if ($receivingInfo['wrap_type']=='5') {
           $objSheeti->setCellValueExplicit('B'.($index+2),'TOTAL: '.$v['receiving_pack_no'].'(Pallets)', PHPExcel_Cell_DataType::TYPE_STRING); 
        }
        $objSheeti->getStyle('B'.($index+2))->getFont()->setBold(true);
        //设置边框
        $objSheeti->getStyle('A'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('B'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('C'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('D'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('E'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('F'.($index+2))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->setCellValueExplicit('D'.($index+2),$qty, PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('F'.($index+2),'CNY '.$sum, PHPExcel_Cell_DataType::TYPE_STRING);  
        $objSheeti->setCellValueExplicit('D'.($index+5),'TOTAL NET WEIGHT : ', PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('D'.($index+6),'TOTAL GROSS WEIGHT : ', PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('D'.($index+7),'TOTAL CBM : ', PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('E'.($index+7),$receivingInfo['volumnweight'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('E'.($index+5),$weight, PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('E'.($index+6),$rouweight, PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('F'.($index+5),'KG', PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('F'.($index+6),'KG', PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->setCellValueExplicit('D'.($index+10),$receivingInfo['receiving_name'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objSheeti->getStyle('E'.($index+5))->getFont()->setBold(true);
        $objSheeti->getStyle('E'.($index+6))->getFont()->setBold(true);
        //设置底部边框
        $objSheeti->getStyle('E'.($index+14))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->getStyle('F'.($index+14))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objSheeti->mergeCells('D'.($index+10).":F".($index+13));
        $objSheeti->getStyle('D'.($index+10))->getAlignment()->setWrapText(true);
        $objSheeti->getStyle('D'.($index+5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objSheeti->getStyle('D'.($index+6))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objSheeti->getStyle('D'.($index+7))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objSheeti->getStyle('D'.($index+10))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objSheeti->setTitle($v['sub_receiving_code']);
            }
         }
        header('pragma: public');
        header('expires: 0');
        header('accept-ranges: bytes');
        header('cache-control: must-revalidate');
        header('content-type: application/vnd.ms-excel; charset=utf-8');
        header('content-disposition: attachment; filename='.$receivingCode.'-invoice.xls');
        $objWriter->save('php://output');
        exit(); 
    }
	
	 public function downpackAction(){
		set_time_limit(300);
        ini_set('memory_limit', '1024M');
        require_once APPLICATION_PATH . '/../libs/PHPExcel.php';
        require_once APPLICATION_PATH . '/../libs/PHPExcel/IOFactory.php';
        $objLoadp   = PHPExcel_IOFactory::load(APPLICATION_PATH."/../data/file".'/packinglist.xls');
        $objWriterp = PHPExcel_IOFactory::createWriter($objLoadp, 'Excel5');
        $receivingCode = $this->_request->getParam("receiving_code","");
        $receivingInfo = Service_Receiving::getByField($receivingCode,"receiving_code","*");   
        $receivingXml=Service_ReceivingDetail::getByCondition(array('receiving_code'=>$receivingCode),"*");
		$result = Service_AsnProccess::printAsn($receivingCode,$this->customerId);
		$start = 15;
        if (!empty($receivingXml)) {
			$objLoadp->createSheet();
            $objSheetp  = $objLoadp->setActiveSheetIndex(0);
			$objSheetp->setTitle('PACKING LIST');
			foreach($receivingXml as $key=>$val){
				$objSheetp->setCellValueExplicit('A'.($start+$key),$key, PHPExcel_Cell_DataType::TYPE_STRING);
				$objSheetp->setCellValueExplicit('B'.($start+$key),$val['g_no'], PHPExcel_Cell_DataType::TYPE_STRING);
				$objSheetp->setCellValueExplicit('C'.($start+$key),$val['goods_id'], PHPExcel_Cell_DataType::TYPE_STRING);
				$objSheetp->setCellValueExplicit('D'.($start+$key),$val['g_name_cn'], PHPExcel_Cell_DataType::TYPE_STRING);
				$objSheetp->setCellValueExplicit('E'.($start+$key),$val['g_qty'], PHPExcel_Cell_DataType::TYPE_STRING);
				$objSheetp->setCellValueExplicit('F'.($start+$key),$val['decl_price'], PHPExcel_Cell_DataType::TYPE_STRING);
				$objSheetp->setCellValueExplicit('G'.($start+$key),$val['decl_total'], PHPExcel_Cell_DataType::TYPE_STRING);
			}
        }
        header("Content-Type: application/vnd.ms-excel; charset=utf-8"); 
		header('pragma: public');
        header('content-disposition: attachment; filename='.$receivingCode.'-packinglist.xls');
        $objWriterp->save('php://output');
		exit();
	 }
    /*
     *获取ASN 日志
     */
    public function detailLogAction()
    {
        if ($this->_request->isPost()) {
            $page = $this->_request->getParam('page', 1);
            $pageSize = $this->_request->getParam('pageSize', 20);

            $page = $page ? $page : 1;
            $pageSize = $pageSize ? $pageSize : 20;
            $condition = array();
            /* 以下为提交数据整理 */

            $ASNCode = $this->_request->getParam("ASNCode", "");
            $condition["receiving_code"] = $ASNCode;
            $condition["customer_id"] = $this->customerId;

            $return = array(
                "ask" => 0,
                "msg" => "No Data."
            );

            /* 以下为业务逻辑方法调用 */
            $count = Merchant_Service_ReceivingLog::getByCondition($condition, 'count(*)');
            $return['count'] = $count;

            if ($count) {
                $rows = Merchant_Service_ReceivingLog::getByCondition($condition, '*', $pageSize, $page, array('rl_id desc'));
                $return['result'] = $rows;
                $return['ask'] = 1;
                $return['msg'] = "Success";
            }

            die(Zend_Json::encode($return));
        }
    }
	/**
	 * @author william-fan
	 * @todo ASN收货信息
	 */
    public function receivingBatchAction(){
    	if ($this->_request->isPost()) {
    		$page = $this->_request->getParam('page', 1);
    		$pageSize = $this->_request->getParam('pageSize', 20);
    	
    		$page = $page ? $page : 1;
    		$pageSize = $pageSize ? $pageSize : 20;
    		$condition = array();
    		/* 以下为提交数据整理 */
    	
    		$ASNCode = $this->_request->getParam("ASNCode", "");
    		$condition["receiving_code"] = $ASNCode;
    		$condition["customer_id"] = $this->customerId;
    	
    		$return = array(
    				"ask" => 0,
    				"msg" => "No Data."
    		);
    	
    		/* 以下为业务逻辑方法调用 */
    		$count = Service_ReceivingBatch::getByCondition($condition,'count(*)');;
    		$return['count'] = $count;
    	
    		if ($count) {
    			$rows = Service_ReceivingBatch::getByCondition($condition, '*', $pageSize, $page, array('rb_id desc'));
    			//print_r($rows);
    			foreach($rows as $key=>$value){
    				$product=Merchant_Service_Product::getByField($value['product_id']);
    				$rows[$key]['product_sku'] = $product['product_sku'];
    			}
    			$return['result'] = $rows;
    			$return['ask'] = 1;
    			$return['msg'] = "Success";
    		}
    			
    		die(Zend_Json::encode($return));
    	}
    }
    /*
     * Print packing List
     */
    public function printAction()
    {
        $ASNCode = $this->_request->getParam('ASNCode', '');
        if (!empty($ASNCode)) {
			$receivingInfo = Service_Receiving::getByField($ASNCode, 'receiving_code');
			if(empty($receivingInfo) || $this->customerId != $receivingInfo['customer_id']){
				exit('无数据');
			}
			if($receivingInfo['decl_port']){
				$ieport = Service_IePort::getByField($receivingInfo['decl_port'],"ie_port","*");
				$receivingInfo['decl_port_name'] = $ieport['ie_port_name'];
			}
			if($receivingInfo['ie_port']){
				$ieport = Service_IePort::getByField($receivingInfo['ie_port'],"ie_port","*");
				$receivingInfo['ie_port_name'] = $ieport['ie_port_name'];
			}
            $customerinfo = $this->_customerAuth;
            $trade_mode = Service_TradeMode::getByField($receivingInfo['trade_mode'],'trade_mode');
            if(!empty($trade_mode)){
            	$receivingInfo['trade_mode_name'] = $trade_mode['trade_mode_name'];
            }else{
            	$receivingInfo['trade_mode_name'] = '';
            }
			$countryInfo = Service_Country::getByField($receivingInfo['destination_port'],'trade_country');
            if(!empty($countryInfo)){
            	$receivingInfo['destination_port_name'] = $countryInfo['country_name'];
            }else{
            	$receivingInfo['destination_port_name'] = '';
            }
            $form_type = Service_FormType::getByField($receivingInfo['form_type'],'form_type');
            if(!empty($form_type)){
            	$receivingInfo['form_type_name'] = $form_type['form_type_name'];
            }else{
            	$receivingInfo['form_type_name'] = '';
            }
			if('' !== $receivingInfo['traf_mode']){
				$trafMode = Service_TrafMode::getByField($receivingInfo['traf_mode'],"traf_mode","*");
				$receivingInfo['traf_mode_name'] = $trafMode['traf_mode_name'];
			}
            $wrap_type = Service_WrapType::getByField($receivingInfo['wrap_type'],'wrap_type');
            if(!empty($wrap_type)){
            	$receivingInfo['wrap_type_name'] = $wrap_type['wrap_type_name'];
            }else{
            	$receivingInfo['wrap_type_name'] = '';
            }
			$trans_mode = Service_TransMode::getByField($receivingInfo['trans_mode'],'trans_mode');
			if(!empty($trans_mode)){
            	$receivingInfo['trans_mode_name'] = $trans_mode['trans_mode_name'];
            }else{
            	$receivingInfo['trans_mode_name'] = '';
            }
			if($receivingInfo['trade_country']){
				$countryInfo = Service_Country::getByField($receivingInfo['trade_country'],"country_code","*");
				$receivingInfo['trade_country_code'] = $countryInfo['trade_country'];
				$receivingInfo['trade_country_name'] = $countryInfo['country_name'];
			}
			$containers		= array();
			$containerInfo	= Service_ReceivingContainer::getByCondition(array('receiving_code'=>$ASNCode));
			foreach($containerInfo as $key=>$val){
				if($key<2)
				$containers[] = $val['rc_no'];
			}
			$receivingInfo['container'] = '';
			if(!empty($containers)){
				if(count($containers)>2){
					$receivingInfo['container'] = join(" ",$containers).'..';
				}else{
					$receivingInfo['container'] = join(" ",$containers);
				}
			}
			$prouctUom				= Common_DataCache::getProductUomCode();
			$country				= Common_DataCache::getCountryCode();
			$currency				= Common_DataCache::getCurrencyCode();
			$this->view->uom		= $prouctUom;
			$this->view->country	= $country;
			$this->view->currency	= $currency;
            $this->view->customerinfo=$customerinfo;
			$detail					= Service_ReceivingDetail::getByCondition(array('receiving_code'=>$ASNCode));
            $result = Service_AsnProccess::printAsn($ASNCode,$this->customerId);
            if($result['ask']=='1'){
				$mergerDetail			= Service_ReceivingDetailMerge::getByCondition(array('receiving_code'=>$ASNCode));
				$receivingInfo['ASNDetail']	= $detail;
				$receivingInfo['mergerDetail']	= $mergerDetail;
				$this->view->asnInfo = $receivingInfo;
           		echo $this->view->render($this->tplDirectory . "receiving-print.tpl");
				exit;
            }else{
           		die($result['message']);
            }
        }
		die('操作有误');
    }
	
	public function printQrcodeAction()
	{
		$qrCodeData	= array();
		$ASNCode = $this->_request->getParam('receiving_code', '');
		$receivingInfo = Service_Receiving::getByField($ASNCode, 'receiving_code');
		if(empty($receivingInfo) || $this->customerId != $receivingInfo['customer_id']){
			exit('无数据');
		}
		$receivingDetailQrcode	= Service_ReceivingDetailQrcode::getByCondition(array('receiving_code'=>$ASNCode));
		foreach($receivingDetailQrcode as $key=>$val){
			$receivingDetail	= Service_ReceivingDetail::getByField($val['rd_id'],'ciq_g_no');
			$qrCodeData[$val['seq_no']]['qty']		= $receivingDetail['g_qty'];
			$qrCodeData[$val['seq_no']]['seqNo']	= $val['seq_no'];
			$qrCodeData[$val['seq_no']]['qrCode']	= $val['qr_code'];
		}
		if(empty($qrCodeData)){exit('无数据');}
		$this->view->qrCodeData	= $qrCodeData;
        echo Ec::renderTpl($this->tplDirectory ."qcode-template.tpl", 'noleftlayout');
	}
	
    public function reprintAction(){
    	$ASNCode = $this->_request->getParam('ASNCode', '');
    	if (!empty($ASNCode)) {
    		$receivingInfo = Service_Receiving::getByField($ASNCode, 'receiving_code');
			if(empty($receivingInfo) || $this->customerId != $receivingInfo['customer_id']){
				exit('无数据');
			}
			if($receivingInfo['decl_port']){
				$ieport = Service_IePort::getByField($receivingInfo['decl_port'],"ie_port","*");
				$receivingInfo['decl_port_name'] = $ieport['ie_port_name'];
			}
			if($receivingInfo['ie_port']){
				$ieport = Service_IePort::getByField($receivingInfo['ie_port'],"ie_port","*");
				$receivingInfo['ie_port_name'] = $ieport['ie_port_name'];
			}
            $customerinfo = $this->_customerAuth;
            $trade_mode = Service_TradeMode::getByField($receivingInfo['trade_mode'],'trade_mode');
            if(!empty($trade_mode)){
            	$receivingInfo['trade_mode_name'] = $trade_mode['trade_mode_name'];
            }else{
            	$receivingInfo['trade_mode_name'] = '';
            }
			$countryInfo = Service_Country::getByField($receivingInfo['destination_port'],'trade_country');
            if(!empty($countryInfo)){
            	$receivingInfo['destination_port_name'] = $countryInfo['country_name'];
            }else{
            	$receivingInfo['destination_port_name'] = '';
            }
            $form_type = Service_FormType::getByField($receivingInfo['form_type'],'form_type');
            if(!empty($form_type)){
            	$receivingInfo['form_type_name'] = $form_type['form_type_name'];
            }else{
            	$receivingInfo['form_type_name'] = '';
            }
			if('' !== $receivingInfo['traf_mode']){
				$trafMode = Service_TrafMode::getByField($receivingInfo['traf_mode'],"traf_mode","*");
				$receivingInfo['traf_mode_name'] = $trafMode['traf_mode_name'];
			}
            $wrap_type = Service_WrapType::getByField($receivingInfo['wrap_type'],'wrap_type');
            if(!empty($wrap_type)){
            	$receivingInfo['wrap_type_name'] = $wrap_type['wrap_type_name'];
            }else{
            	$receivingInfo['wrap_type_name'] = '';
            }
			$trans_mode = Service_TransMode::getByField($receivingInfo['trans_mode'],'trans_mode');
			if(!empty($trans_mode)){
            	$receivingInfo['trans_mode_name'] = $trans_mode['trans_mode_name'];
            }else{
            	$receivingInfo['trans_mode_name'] = '';
            }
			if($receivingInfo['trade_country']){
				$countryInfo = Service_Country::getByField($receivingInfo['trade_country'],"country_code","*");
				$receivingInfo['trade_country_code'] = $countryInfo['trade_country'];
				$receivingInfo['trade_country_name'] = $countryInfo['country_name'];
			}
			$containers		= array();
			$containerInfo	= Service_ReceivingContainer::getByCondition(array('receiving_code'=>$ASNCode));
			foreach($containerInfo as $key=>$val){
				if($key<2)
				$containers[] = $val['rc_no'];
			}
			$receivingInfo['container'] = '';
			if(!empty($containers)){
				if(count($containers)>2){
					$receivingInfo['container'] = join(" ",$containers).'..';
				}else{
					$receivingInfo['container'] = join(" ",$containers);
				}
			}
			$prouctUom				= Common_DataCache::getProductUomCode();
			$country				= Common_DataCache::getCountryCode();
			$currency				= Common_DataCache::getCurrencyCode();
			$this->view->uom		= $prouctUom;
			$this->view->country	= $country;
			$this->view->currency	= $currency;
            $this->view->customerinfo=$customerinfo;
			$detail					= Service_ReceivingDetail::getByCondition(array('receiving_code'=>$ASNCode));
			$receivingInfo['ASNDetail']	= $detail;
			$this->view->asnInfo = $receivingInfo;
			
    		$result = Service_AsnProccess::printAsn($ASNCode,$this->customerId);
			if (1 == $result['ask']) {
    			$this->view->asnInfo = $receivingInfo;
				echo $this->view->render($this->tplDirectory . "receiving-print.tpl");
    		}else{
				exit($result['message']);
			}
    	}
		exit('操作有误');
    }
}