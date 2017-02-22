<?php
/* @desc 产品接口
 *
 */
class Api_Loader extends Api_Web {

    protected $fields = null;

    public function __construct($paramString = '') {
        parent::__construct($paramString);
        $this->setFields();
    }

    protected function setFields() {
        $this->fields = array(
            'carNo'=>'car_no',
            'refLoaderNo'=>'ref_loader_no',
            'formType'=>'form_type',
            'ieType'=>'ie_type',
            'declPort'=>'decl_port',
            'iePort'=>'ie_port',
            'packNumber'=>'pack_no',
            'totalWeight'=>'total_wt',
            'carWeight'=>'car_wt',
            'formNumber'=>'form_num',
            'agentCode'=>'agent_code',
            'agentName'=>'agent_name',
            'tradeCode'=>'trade_code',
            'tradeName'=>'trade_name',
            'storageCode'=>'wh_code',
            'storageName'=>'wh_name',
            'ownerCode'=>'owner_code',
            'ownerName'=>'owner_name',
            'personItems'=>'detail',
            'products'=>'product'
        );
    }

    protected function getPersonItemDetailField() {
        return array(
            'refPersonItemNo'=>'pim_reference_no',
            'formType'=>'form_type',
        );
    }

    protected function getProductsField() {
        return array(
            'declNumber'=>'declNumber',
            'fzxtGNo'=>'fzxtGNo',//没用到
            'receivingCode'=>'formId',
            'gNo'=>'gNo',
            'hsCode'=>'codeTs',
            'productName'=>'nameCn',
            'productModel'=>'gModel',
            'productEnName'=>'nameEn',
            'quantity'=>'gQty',
            'unit'=>'gUnit',
            'declPrice'=>'declPrice',
            'currencyCode'=>'currency',
            'legalQty'=>'qty1',
            'legalUnit'=>'unit1',
            'legalQty2'=>'qty2',
            'legalUnit2'=>'unit2',
            'originCountry'=>'originCountry',
            'dutyMode'=>'dutyMode',
            'useTo'=>'useTo',
            'declTotal'=>'declTotal',
            'notes'=>'note',
        );
    }

    public function getFieldText() {
        return array(
            'car_no'=>'车牌号',
            'ref_loader_no'=>'ref_loader_no',//没有这个字段
            'ie_type'=>'进出口类型',
            'decl_port'=>'申报口岸',
            'ie_port'=>'进出口岸',
            'pack_no'=>'总件数',
            'total_wt'=>'总重量',
            'car_wt'=>'车自重',
            'form_num'=>'单证总数',
            'agent_code'=>'申报单位代码',
            'agent_name'=>'申报单位名称',
            'trade_code'=>'经营单位代码',
            'trade_name'=>'经营单位名称',
            'wh_code'=>'仓储企业单位代码',
            'wh_name'=>'仓储企业单位名称',
            'owner_ode'=>'收发货人代码',
            'owner_name'=>'收发货人名称',
            'person_items'=>'物品清单集合',
            'products'=>'货物集合',
        );
    }

    public function run() {
        $opType = ucfirst($this->_param['opType']);
        // 操作类型
        $process = new Service_ShipBatchProcess();
        switch ($opType) {
            case 'Add':
                if(!isset($this->_param['data'])){
                    $this->_error[] = '参数[data]不存在';
                    return false;
                }
                $loaderInfo = $this->_param['data'];
                if(($loaderInfo = $this->translate($loaderInfo)) === false){
                    return false;
                }
                if(is_string($loaderInfo['detail'])){
                    $loaderInfo['detail'] = array();
                }
                if(is_string($loaderInfo['product'])){
                    $loaderInfo['product'] = array();
                }
                $detailFields = $this->getPersonItemDetailField();
                $productFields = $this->getProductsField();
                $products = $details = array();
                foreach($loaderInfo['detail'] as $key=>$value) {
                    foreach($detailFields as $k=>$v){
                        if(isset($loaderInfo['detail'][$key][$k])) {
                            $details[$key][$v] = $loaderInfo['detail'][$key][$k];
                        } else {
                            $details[$key][$v] = '';
                        }
                        if($v=='form_id') {
                            $personItem = Service_PersonItem::getByField($loaderInfo['detail'][$key][$k],'pim_reference_no');
                            if($personItem instanceof Zend_Db_Table_Row) {
                                $personItem = $personItem->toArray();
                            }
                            $details[$key]['order_code'] = $personItem?$personItem['order_code']:'';
                        }
                    }
                }
                $loaderInfo['detail'] = $details;
                foreach($loaderInfo['product'] as $key=>$value) {
                    foreach($productFields as $k=>$v){
                        if(isset($loaderInfo['product'][$key][$k])) {
                            $products[$key][$v] = $loaderInfo['product'][$key][$k];
                        } else {
                            $products[$key][$v] = '';
                        }
                    }
                }
                $loaderInfo['product'] = $products;
                $result = $process->createPayOrderTransaction($loaderInfo ,$this->_customer['customer_id']);
                $result['ref_loader_no'] = $loaderInfo['ref_loader_no'];
                break;
            case 'Get':
                if(!isset($this->_param['data']['refLoaderNo'])) {
                    $this->_error[] = '参数[refLoaderNo]不存在';
                    return false;
                }

                if($this->_param['data']['refLoaderNo']==='') {
                    $this->_error[] = '参数[refLoaderNo]不能为空';
                    return false;
                }
                //判断用户
                $shipBatchRows = Service_ShipBatch::getByCondition(array('ref_loader_no'=>$this->_param['data']['refLoaderNo'],'customer_code'=>$this->_param['HeaderRequest']['customerCode']),'*');
                if(empty($shipBatchRows)) {
                    $this->_error[] = '载货单['.$this->_param['data']['refLoaderNo'].']不存在';
                    return false;
                }
                //$status = Service_ShipBatch::getStatus();
                $shipBatch['refLoaderNo'] = $shipBatchRows[0]['ref_loader_no'];
				$shipBatch['loaderCode'] = $shipBatchRows[0]['sb_code'];
				$shipBatch['status'] = $shipBatchRows[0]['status'];
                $result['ask'] = 1;
                break;
            default:
                $this->_error[] = '操作类型错误,只能是Add、Get';
                return false;
        }
        if($result['ask'] == 0){
            $this->_error = $result['error'];
            return false;
        }
        switch($opType) {
            case 'Add':
                $this->_message = '添加载货单成功';
                $this->_success['loaderCode'] = $result['ref_loader_no'];
                break;
            case 'Get':
                $this->_success = $shipBatch;
                break;
        }
        return true;
    }

    /* @desc 验证产品数据正确性
     * @param $params 产品数据
     * @param  $param 原始产品数据
     */
    protected function verification($data , $originalData) {
        return $data;
    }
}