<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-3-26
 * Time: 上午10:39
 * To change this template use File | Settings | File Templates.
 */
class Service_QualityControlProcess
{
    protected $_QcCode = null;
    protected $_QcOrder = null;
    protected $_asnItem = null;
    protected $_errorArr = array();
    protected $_params = array();
    protected $_userId = 0;
    protected $_warehouseId = 0;
    protected $_date = '';

    //QC状态
    public static function getStatus()
    {
        return array(
            0 => '在途',
            1 => '收货中',
            2 => '收货完成',
        );
    }

    public function __construct()
    {
        $this->_date = date('Y-m-d H:i:s');
    }

    /**
     * @desc 表单参数
     * @param array $params
     */
    private function setData($params = array())
    {
        $keys = array(
            'receivedQty' => 0,
            'problemQty' => 0,
            'noLabelQty' => 0,
            'qcId' => 0,
            'userId' => 0,
            'remark' => '',
            'firstReceived' => 1,
            'shelf' => 0,
            'productWeight' => 0,
            'qcQty' => array(),
            'qcNote' => array(),
            'product' => array(),
            'boxArray' =>array(),
        );
        foreach ($keys as $key => $val) {
            $this->_params[$key] = isset($params[$key]) ? $params[$key] : $val;
        }
        $this->_userId = Service_User::getUserId();
        $this->_warehouseId = Service_User::getUserWarehouseId();
        $this->_params['userId'] = $this->_params['userId'] == '0' ? $this->_userId : $this->_params['userId'];
        $this->_params['shelf'] = !empty($this->_params['shelf']) ? strtoupper(trim($this->_params['shelf'])) : '';
        $this->_QcOrder = Service_QualityControl::getByField($this->_params['qcId'], 'qc_id');
    }

    private function valid()
    {
        //当收货数量为0时,应当处理未到货
        if ($this->_params['problemQty'] > $this->_params['receivedQty'] || $this->_params['noLabelQty'] > $this->_params['receivedQty'] || !is_numeric($this->_params['receivedQty']) || $this->_params['receivedQty']<1 ) {
            $this->_errorArr[] = array('errorCode' => '10003', 'errorMsg' => Ec::Lang('quantityError'));
        }
        if (!empty($this->_params['qcQty'])) {
            foreach ($this->_params['qcQty'] as $key => $val) {
                if ($val > 0 && ($this->_params['qcNote'][$key] == '' || !isset($this->_params['qcNote'][$key]))) {
                    $this->_errorArr[] = array('errorCode' => '10004', 'errorMsg' => Ec::Lang('abnormalNote'));
                }
            }
        }
        if (empty($this->_QcOrder)) {
            $this->_errorArr[] = array('errorCode' => '10002', 'errorMsg' => Ec::Lang('paramsErrormsg'));
        }
        if ($this->_QcOrder['qc_status'] != '0' && isset($this->_QcOrder['qc_status'])) {
            $this->_errorArr[] = array('errorCode' => '10005', 'errorMsg' => Ec::Lang('errorState'));
        }
        if ($this->_params['firstReceived'] == '0' && empty($this->_params['product'])) {
            $this->_errorArr[] = array('errorCode' => '10002', 'errorMsg' => Ec::Lang('paramsErrormsg'));
        }

        if (empty($this->_params['shelf']) && $this->_params['problemQty'] > 0) {
            $this->_errorArr[] = array('errorCode' => '10006', 'errorMsg' => '货架号不能为空.');
        } elseif (!empty($this->_params['shelf']) && $this->_params['problemQty'] > 0) {
            $shelfRow = Service_Location::getByCondition(array('lc_code' => $this->_params['shelf'], 'warehouse_id' => $this->_warehouseId), '*');
            if (empty($shelfRow)) {
                $this->_errorArr[] = array('errorCode' => '10007', 'errorMsg' => '货架号不存在.');
            } else {
                if ($shelfRow[0]['lc_status'] != '1') {
                    $this->_errorArr[] = array('errorCode' => '10008', 'errorMsg' => '货架号不可用.');
                } else {
                    $areaRow = Service_WarehouseArea::getByField($shelfRow[0]['wa_code'], 'wa_code');
                    //不良品区
                    if (isset($areaRow['wa_type']) && $areaRow['wa_type'] != '2') {
                        $this->_errorArr[] = array('errorCode' => '10008', 'errorMsg' => '此货架号不属于不良品区域.');
                    }
                }
            }

        }
        $boxArr = $this->_params['boxArray'];
        $boxCodeArr=array();
        if(!empty($boxArr)){
            //校验
            $boxQty=0;
            foreach($boxArr as $key=>$val){
                $boxCode=$val['box_code'];
                if(empty($boxCode)){
                    $this->_errorArr[] = array('errorCode' => '10014', 'errorMsg'=>"分箱".($key+1)."必填");
                }else{
                    if(preg_match('/^BOX\d+/i', $val['box_code'])==false){
                        $this->_errorArr[] = array('errorCode' => '10014', 'errorMsg'=>"分箱号:".$val['box_code']."必须以box开头");
                    }
                    if(!in_array($val['box_code'],$boxCodeArr)){
                        $boxCodeArr[]=$val['box_code'];
                    }else{
                        $this->_errorArr[] = array('errorCode' => '10014', 'errorMsg'=>"分箱号:".$val['box_code']."存在重复");
                    }
                    /* if(!empty($boxCode)){
                    	$checkbox = Service_PutawayBox::getByField($boxCode,'box_code');
                    	if(!empty($checkbox)){
                    		$this->_errorArr[] = array('errorCode' => '10014', 'errorMsg'=>"分箱号:".$val['box_code']."系统已存在");
                    	}
                    } */
                    if(!is_numeric($val['quantity']) || $val['quantity']<1 || $val['quantity']=='' ){
                        $this->_errorArr[] = array('errorCode' => '10015', 'errorMsg'=>"分箱号:".$val['box_code'].'数量必填');
                    }else{
                        $boxQty+=$val['quantity'];
                    }
                }
            }
            if($boxQty!=$this->_params['receivedQty']-$this->_params['problemQty']){
                $this->_errorArr[] = array('errorCode' => '10015', 'errorMsg'=>'分箱产品总数量必须等于实收总数减不合格总数');
            }
        }
    }

    private function updateAsnItem()
    {
        $asnItem = Service_ReceivingDetail::getByCondition(array('receiving_code' => $this->_QcOrder['receiving_code']), '*');
        $asnStatus = 7;
        $rdStatus = 1;
        $asnItemStatus = array();
        foreach ($asnItem as $key => $val) {
            $asnItem[$val['rd_id']] = $val;
            $asnItemStatus[$val['rd_id']] = $val['rd_status'];
            if ($val['rd_status'] != '2' && $this->_QcOrder['rd_id'] != $val['rd_id']) {
                $asnStatus = 6;
            }
        }

        if ($this->_params['receivedQty'] + $asnItem[$this->_QcOrder['rd_id']]['rd_received_qty'] >= $asnItem[$this->_QcOrder['rd_id']]['rd_receiving_qty']) {
            $rdStatus = 2;
            $asnItem[$this->_QcOrder['rd_id']]['rd_status'] = 2;
        } else {
            $asnStatus = 6;
        }
        $asnStatus = $asnStatus == '7' && $rdStatus == '2' ? 7 : 6;

        //update AsnItem
        $updateAsnItem['rd_received_qty'] = $asnItem[$this->_QcOrder['rd_id']]['rd_received_qty'] + $this->_params['receivedQty'];
        $updateAsnItem['rd_update_time'] = $this->_date;
        $updateAsnItem['rd_status'] = $rdStatus;
        Service_ReceivingDetail::update($updateAsnItem, $this->_QcOrder['rd_id']);

        //update ASN
        Service_Receiving::update(array('receiving_status' => $asnStatus, 'receiving_update_time' => $this->_date), $this->_QcOrder['receiving_id']);


        //receiving batch
        $batch = array(
            'receiving_id' => $this->_QcOrder['receiving_id'],
            'qc_code' => $this->_QcOrder['qc_code'],
            'receiving_code' => $this->_QcOrder['receiving_code'],
            'receiving_line_no' => $asnItem[$this->_QcOrder['rd_id']]['receiving_line_no'],
            'product_barcode' => $this->_QcOrder['product_barcode'],
            'product_id' => $this->_QcOrder['product_id'],
            'rdb_weight' => $this->_params['productWeight'],
            'rdb_received_qty' => $this->_params['receivedQty'],
            'labeled' => $this->_params['noLabelQty'] > 0 ? 1 : 0,
            'non_labeled_qty' => $this->_params['noLabelQty'],
            'receiving_user_id' => $this->_QcOrder['receiving_user_id'],
            'rdb_add_time' => $this->_date,
            'rdb_update_time' => $this->_date,
        );
        Service_ReceivingDetailBatch::add($batch);

        $this->_asnItem = $asnItem;
    }

    private function updateQC()
    {
        $qcRow = array(
            'qc_received_quantity' => $this->_params['receivedQty'],
            'qc_status' => 1,
            'lc_code' => $this->_params['shelf'],
            'qc_note' => $this->_params['remark'],
            'qc_operator_id' => $this->_params['userId'],
            'qc_quantity_sellable' => $this->_params['receivedQty'] - $this->_params['problemQty'],
            'qc_quantity_unsellable' => $this->_params['problemQty'],
            'qc_update_time' => $this->_date,
            'qc_finish_time' => $this->_date,
        );
        Service_QualityControl::update($qcRow, $this->_QcOrder['qc_id']);

        //Qc Result
        if ($this->_QcOrder['qc_type'] == '1' && !empty($this->_params['qcQty'])) {
            $qcResultObj = new Service_QualityControlResult();
            foreach ($this->_params['qcQty'] as $key => $qty) {
                $add = array(
                    'qc_id' => $this->_QcOrder['qc_id'],
                    'qc_code' => $this->_QcOrder['qc_code'],
                    'pqo_id' => $key,
                    'qcr_quantity_pass' => $this->_params['receivedQty'] - $qty,
                    'qcr_quantity_problem' => $qty,
                    'qcr_description' => isset($this->_params['qcNote'][$key]) ? $this->_params['qcNote'][$key] : '',
                    'qcr_add_time' => $this->_date,
                );
                $qcResultObj->add($add);
            }
        }
    }

    private function  putaway()
    {

        $putawayRow = Service_Putaway::getByField($this->_QcOrder['receiving_code'], 'receiving_code');

        $boxArr = $this->_params['boxArray'];
        if(!empty($boxArr)){
            foreach($boxArr as $key=>$val){
                $putaway = array(
                    'putaway_id' => $putawayRow['putaway_id'],
                    'putaway_code' => $putawayRow['putaway_code'],
                    'qc_code' => $this->_QcOrder['qc_code'],
                    'box_code'=>strtoupper($val['box_code']),
                    'receiving_code' => $putawayRow['receiving_code'],
                    'pd_type' => 2,
                    'product_barcode' => $this->_QcOrder['product_barcode'],
                    'product_id' => $this->_QcOrder['product_id'],
                    'pd_quantity' =>$val['quantity'],
                    'pd_lot_number' => 1,
                    'warehouse_id' => $this->_QcOrder['warehouse_id'],
                    'pd_add_time' => $this->_date,
                );
                Service_PutawayDetail::add($putaway);
            }
        }else{
            //之前的程序 只有一条 如果 有 分箱会插入多条
            $putaway = array(
                'putaway_id' => $putawayRow['putaway_id'],
                'putaway_code' => $putawayRow['putaway_code'],
                'qc_code' => $this->_QcOrder['qc_code'],
                'receiving_code' => $putawayRow['receiving_code'],
                'pd_type' => 1,
                'product_barcode' => $this->_QcOrder['product_barcode'],
                'product_id' => $this->_QcOrder['product_id'],
                'pd_quantity' => $this->_params['receivedQty'] - $this->_params['problemQty'],
                'pd_lot_number' => 1,
                'warehouse_id' => $this->_QcOrder['warehouse_id'],
                'pd_add_time' => $this->_date,
            );
            Service_PutawayDetail::add($putaway);
        }


    }

    private function updateProduct()
    {
        $productRow = Service_Product::getByField($this->_QcOrder['product_id'], 'product_id');
        //不是首次收货，只更新重量
        if ($this->_params['firstReceived'] == '1') {
            if ($productRow['product_weight'] < $this->_params['productWeight']) {
                Service_Product::update(array('product_weight' => $this->_params['productWeight'], 'product_update_time' => $this->_date), $this->_QcOrder['product_id']);
                $note = ' Weight:' . $productRow['product_weight'] . ' to  ' . $this->_params['productWeight'];
                $log = array(
                    'product_id' => $this->_QcOrder['product_id'],
                    'pl_type' => '0',
                    'user_id' => $this->_userId,
                    'customer_id' => $this->_QcOrder['customer_id'],
                    'pl_note' => $note,
                );
                Service_ProductLog::add($log);
            }
            return true;
        }
        //首次收货,确认详细资料
        $row = array(
            'product_declared_value' => $this->_params['product']['declaredValue'],
            'product_length' => $this->_params['product']['length'],
            'product_width' => $this->_params['product']['width'],
            'product_receive_status' => 1,
            'product_height' => $this->_params['product']['height'],
            'pce_id' => $this->_params['product']['category'],
            'product_weight' => $this->_params['productWeight'],
            'product_update_time' => $this->_date,
        );
        Service_Product::update($row, $this->_QcOrder['product_id']);
        $note = 'first goods,declaredValue:' . $productRow['product_declared_value'] . ' to  ' . $this->_params['product']['declaredValue'];
        $note .= ' Weight:' . $productRow['product_weight'] . ' to  ' . $this->_params['productWeight'];
        $note .= ' Width:' . $productRow['product_width'] . ' to  ' . $this->_params['product']['width'];
        $note .= ' Length:' . $productRow['product_length'] . ' to  ' . $this->_params['product']['length'];
        $note .= ' Height:' . $productRow['product_height'] . ' to  ' . $this->_params['product']['height'];

        $log = array(
            'product_id' => $this->_QcOrder['product_id'],
            'pl_type' => '0',
            'user_id' => $this->_userId,
            'customer_id' => $this->_QcOrder['customer_id'],
            'pl_note' => $note,
        );
        Service_ProductLog::add($log);
        $package = Service_ProductPackageMap::getByCondition(array('product_id' => $this->_QcOrder['product_id'], 'warehouse_id' => $this->_QcOrder['warehouse_id']), '*');
        if (!empty($package)) {
            Service_ProductPackageMap::update(array('pp_id' => $this->_params['product']['package'], 'ppm_update_time' => $this->_date), $package[0]['ppm_id']);
        } else {
            $row = array(
                'product_id' => $this->_QcOrder['product_id'],
                'pp_id' => $this->_params['product']['package'],
                'warehouse_id' => $this->_QcOrder['warehouse_id'],
                'ppm_update_time' => $this->_date,
            );
            Service_ProductPackageMap::add($row);
        }
    }

    private function inventory()
    {
        $row = array(
            'product_id' => $this->_QcOrder['product_id'],
            'quantity' => 0,
            'customQty' => 0, //用于其它
            'operationType' => 2,
            'unsellable' => 0,
            'warehouse_id' => $this->_QcOrder['warehouse_id'],
            'reference_code' => $this->_QcOrder['qc_code'], //操作单号
            'application_code' => 'QC', //操作类型
            'note' => '质检'
        );
        $obj = new Service_ProductInventoryProcess();
        $onWay = ($this->_asnItem[$this->_QcOrder['rd_id']]['rd_received_qty'] + $this->_params['receivedQty']) - $this->_asnItem[$this->_QcOrder['rd_id']]['rd_receiving_qty'];
        if ($onWay > 0) {
            $qty = $this->_asnItem[$this->_QcOrder['rd_id']]['rd_receiving_qty'] - $this->_asnItem[$this->_QcOrder['rd_id']]['rd_received_qty'];
            $row['customQty'] = $qty;
        } else {
            $row['customQty'] = $this->_params['receivedQty'];
        }
        $row['quantity'] = $this->_params['receivedQty'];
        $row['unsellable'] = $this->_params['problemQty'];

        $result = $obj->update($row);
        if (!isset($result['state']) || $result['state'] != '1') {
            // $this->_errorArr[]=array('errorCode'=>'50000','errorMsg'=>'Internal error');
            throw new Exception('Inventory Internal error');
        }
    }

    /*
     * @质检入口，事务处理
     * @质检完成
     * @return array('state','error','message')
     */
    public function submit($params = array())
    {
        $result = array(
            'state' => 0,
            'error' => array(),
            'message' => ''
        );

        $db = Service_QualityControl::getModelInstance()->getAdapter();
        $this->setData($params);
        $this->valid();
        if (!empty($this->_errorArr)) {
            $result['error'] = $this->_errorArr;
            return $result;
        }
        $db->beginTransaction();
        try {
            $this->updateAsnItem();
            $this->updateQC();
            $this->putaway();
            $this->updateProduct();
            $this->inventory();
            //$this->putawaybox();

            //$db->rollBack();
            $allQc = Service_QualityControl::getByCondition(array('receiving_code'=>$this->_QcOrder['receiving_code']),"*");
            $stag = true;
            foreach($allQc as $key=>$value){
                if($value['qc_status']=="0"){
                    $stag = false;
                }
            }
            $receivingRow = Service_Receiving::getByField($this->_QcOrder['receiving_id'],"receiving_id","*");
            $count = Service_ReceivingTracking::getByCondition(
                array('receiving_code'=>$receivingRow['receiving_code'],'description'=>'收货中'),"count(*)");
            if(!$count){
                $warehouse = Service_Warehouse::getByField($receivingRow['warehouse_id'],'warehouse_id',"*");
                $receivingTracking = array(
                    'receiving_code'=>$receivingRow['receiving_code'],
                    'location'=>$warehouse['warehouse_name'],
                    'time'=>date("Y-m-d H:i:s"),
                    'tracking_number'=>$receivingRow['traf_name'],
                    'on_status'=>'2',
                    'description'=>'收货中',
                    'from_status'=>$receivingRow['receiving_status'],
                    'to_status'=>$receivingRow['receiving_status'],
                    'warehouse_id'=>$receivingRow['warehouse_id'],
                );
                Service_ReceivingTracking::add($receivingTracking);
            }
            if($stag){
                //添加asn日志

                $ASNLog = array(
                    'receiving_id'=>$this->_QcOrder['receiving_id'],
                    'receiving_code' => $this->_QcOrder['receiving_code'],
                    'user_id'=>$this->_userId,
                    'customer_code' => $receivingRow['customer_code'],
                    'rl_note' => "收货完成",
                    'rl_status_from' => '6',
                    'rl_status_to' => "7",
                    'rl_add_time'=>date("Y-m-d H:i:s"),
                    'rl_ip'=>Common_Common::getIP()
                );
                Service_ReceivingLog::add($ASNLog);
            }
            $db->commit();
            $result = array('state' => 1, 'message' => Ec::Lang('operationSuccess'));
            return $result;
        } catch (Exception $e) {
            $db->rollBack();
            $result['error'][] = array(
                'errorCode' => '50000',
                'errorMsg' => $e->getMessage()
            );
            return $result;
        }
    }

    /**
     * @产品未到货,事务处理
     * @param array $params
     * @return array
     */
    public function stopQcTransaction($params = array())
    {
        $result = array(
            'state' => 0,
            'error' => array(),
            'message' => ''
        );

        $db = Service_QualityControl::getModelInstance()->getAdapter();
        $this->setData($params);
        if (empty($this->_QcOrder)) {
            $this->_errorArr[] = array('errorCode' => '10002', 'errorMsg' => Ec::Lang('paramsErrormsg'));
        }
        if(empty($this->_params['remark'])){
            $this->_errorArr[] = array('errorCode' => '10002', 'errorMsg' =>'请填写备注.');
        }
        if ($this->_QcOrder['qc_status'] != '0' && isset($this->_QcOrder['qc_status'])) {
            $this->_errorArr[] = array('errorCode' => '10005', 'errorMsg' => Ec::Lang('errorState'));
        }
        if (!empty($this->_errorArr)) {
            $result['error'] = $this->_errorArr;
            return $result;
        }
        $db->beginTransaction();
        try {
            $qcRow = array(
                'qc_received_quantity' => 0,
                'qc_status' => 2, //状态 转为 已上架
                'lc_code' => '',
                'qc_note' => $this->_params['remark'],
                'qc_operator_id' => $this->_params['userId'],
                'qc_quantity_sellable' => 0,
                'qc_quantity_unsellable' => 0,
                'qc_update_time' => $this->_date,
                'qc_finish_time' => $this->_date,
            );
            if (!Service_QualityControl::update($qcRow, $this->_QcOrder['qc_id'])) {
                throw new Exception('Update QcOrder Fail.');
            }
            $db->commit();
            $result = array('state' => 1, 'message' => Ec::Lang('operationSuccess'));

        } catch (Exception $e) {
            $db->rollBack();
            $result['error'][] = array(
                'errorCode' => '50000',
                'errorMsg' => $e->getMessage()
            );
        }
        return $result;
    }


    /**
     * @param string $QcCode
     * @return array
     */
    public function getQcOrder($QcCode = '')
    {
        $result = array(
            'state' => 0,
            'data' => array(),
            'message' => ''
        );

        $qcRow = Service_QualityControl::getByField($QcCode, 'qc_code');
        if (empty($qcRow)) {
            $result['message'] = Ec::Lang('notFound');
            return $result;
        }
        //$warehouseId = Service_User::getUserWarehouseId();
        //$warehouse = Common_DataCache::getWarehouse();
        $status = self::getStatus();
        $qcRow['warehouse_code'] = isset($warehouse[$qcRow['warehouse_id']]) ? $warehouse[$qcRow['warehouse_id']]['warehouse_code'] : '';
        $qcRow['status'] = isset($status[$qcRow['qc_status']]) ? $status[$qcRow['qc_status']] : '';
        $userRow = Service_User::getByField($qcRow['receiving_user_id'], 'user_id', array('user_name', 'user_name_en'));
        $qcRow['receiving_user'] = $userRow['user_name'];
        $qcRow['operator_user'] = '';
        if ($qcRow['qc_operator_id'] != '0') {
            $userRow = Service_User::getByField($qcRow['qc_operator_id'], 'user_id', array('user_name', 'user_name_en'));
            $qcRow['operator_user'] = $userRow['user_name'];
        }

        //qcOption 质检项
        if ($qcRow['qc_type'] == '1') {
            $qcItem = Service_ProductQcOptions::getByItemCondition(array(), '*');
            $productQc = Service_ProductQcMap::getByCondition(array('product_id' => $qcRow['product_id']), '*');
            foreach ($productQc as $key => $val) {
                $qcRow['qcOption'][$val['pqo_id']] = $val;
                $qcRow['qcOption'][$val['pqo_id']]['qc'] = $qcItem[$val['pqo_id']]['pqo_name'];
            }
        }
        $qcRow['product'] = Service_Product::getByField($qcRow['product_id'], 'product_id', array('product_title_en', 'product_title','product_sku', 'product_receive_status', 'product_weight', 'product_net_weight', 'pc_id'));
        $packageMap = Service_ProductPackageMap::getByCondition(array('product_id' => $qcRow['product_id'], 'warehouse_id' => $qcRow['warehouse_id']), '*');

        $qcRow['product']['package'] = array(
            'pp_id' => '',
            'pp_barcode' => '',
            'pp_name' => '',
        );
        if (!empty($packageMap)) {
            $package = Service_ProductPackage::getByField($packageMap[0]['pp_id'], 'pp_id');
            $qcRow['product']['package'] = array(
                'pp_id' => isset($package['pp_id']) ? $package['pp_id'] : '',
                'pp_barcode' => isset($package['pp_barcode']) ? $package['pp_barcode'] : '',
                'pp_name' => isset($package['pp_id']) ? $package['pp_id'] : '',
            );
        }

        $result['state'] = 1;
        $result['data']['order'] = $qcRow;

        $result['data']['result'] = array();
        if ($qcRow['qc_status'] != '0') {
            //$qcOptions = Common_DataCache::getQcOptions();
            //$typeArr = Service_TypeCategory::getByCode('QCR_PROBLEM_TYPE');
            $data = Service_QualityControlResult::getByCondition(array('qc_code' => $QcCode), '*');
            foreach ($data as $key => $val) {
                $result['data']['result'][$val['pqo_id']] = $val;
                $result['data']['result'][$val['pqo_id']]['pqo'] = isset($qcOptions[$val['pqo_id']]) ? $qcOptions[$val['pqo_id']] : array();
                $result['data']['result'][$val['pqo_id']]['problem_type'] = isset($typeArr['data']['item'][$val['qcr_problem_type']]) ? $typeArr['data']['item'][$val['qcr_problem_type']] : array();
            }
            //收货批次
            $rdbRow = Service_ReceivingDetailBatch::getByField($QcCode, 'qc_code', array('rdb_weight', 'labeled', 'non_labeled_qty'));
            $result['data']['rdb'] = $rdbRow;
            $result['data']['other'] = array(
                'date' => $qcRow['qc_finish_time'],
                'qc_user_id' => $qcRow['qc_operator_id'],
                'lc_code' => '',
                'user_name' => $qcRow['operator_user'],
            );
        } else {
            //推荐货架:在用、空货架
            $lcCode = self::getProductLocation($qcRow['product_id'],$qcRow['warehouse_id']);
            //$userRow = Service_User::getLoginUser();
            $result['data']['other'] = array(
                'date' => date('Y-m-d H:i:s'),
                //'qc_user_id' => Service_User::getUserId(),
                'lc_code' => $lcCode,
                //'user_name' => isset($userRow['user_name']) ? $userRow['user_name'] : '',
            );
        }
        //增加putaway_box获取
        $boxConditon = array(
            'qc_code'=>$QcCode,
            'product_barcode'=>$qcRow['product_barcode']
        );
        $box = Service_PutawayBox::getByCondition($boxConditon,'*',1,1);
        if(empty($box)){
            $box = array();
        }
        $result['data']['box'] = $box;
        return $result;
    }

    /**
     * @desc 获取产品历史货架
     * @param int $productId
     * @param int $warehouseId
     */
    public static function getProductLocation($productId = '', $warehouseId = '')
    {
        $lcCode = '';
        if ($productId == '' || $warehouseId == '') {
            return $lcCode;
        }
        $ibRows = Service_InventoryBatch::getByCondition(array('warehouse_id' => $warehouseId, 'product_id' => $productId), array('lc_code'), 1, 1);
        if (!empty($ibRows)) {
            $lcCode = $ibRows[0]['lc_code'];
        } else {
            $condition = array(
                'product_id' => $productId,
                'warehouse_id' => $warehouseId,
            );
            $rows = Service_ProductLocationMap::getByCondition($condition);
            $lcCode = isset($rows[0]['lc_code']) ? $rows[0]['lc_code'] : '';
        }
        return $lcCode;
    }

    /**
     * @author william-fan
     * @desc 处理分箱数据
     */
    private function putawayBox()
    {
        $boxArr = $this->_params['boxArray'];
        if (!empty($boxArr)) {
            foreach ($boxArr as $key => $val) {
                $putawayBoxRow = array(
                    'qc_code' => $this->_QcOrder['qc_code'],
                    'box_code' => strtoupper($val['box_code']),
                    'product_barcode' => $this->_QcOrder['product_barcode'],
                    'product_id' => $this->_QcOrder['product_id'],
                    'bb_quantity' => $val['quantity'],
                    'bb_status' => '1',//直接完成,避免上架时，又要更新
                    'bb_add_time' => date('Y-m-d H:i:s', time()),
                );
                Service_PutawayBox::add($putawayBoxRow);
            }
        }
    }

}
