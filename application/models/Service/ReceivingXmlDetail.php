<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 15-1-22
 * Time: 下午2:18
 * To change this template use File | Settings | File Templates.
 */
class Service_ReceivingXmlDetail
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    public static function getModelInstance(){
        if (is_null(self::$_modelClass)){
            self::$_modelClass = new Table_ReceivingXmlDetail();
        }
        return self::$_modelClass;
    }

    public static function add($row){
        $model = self::getModelInstance();
        return $model->add($row);
    }

    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "rxd_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "rxd_id")
    {
        $model = self::getModelInstance();
        return $model->delete($value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public static function getByField($value, $field = 'rxd_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }

    /**
     * @param array $condition
     * @param string $type
     * @param int $pageSize
     * @param int $page
     * @param string $order
     * @return mixed
     */
    public static function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {
        $model = self::getModelInstance();
        return $model->getByCondition($condition, $type, $pageSize, $page, $order);
    }

    public static function getByGroupByCondition($condition,$type,$cellType="",$groupBy=""){
        $model = self::getModelInstance();
        return $model->getByGroupByCondition($condition,$type,$cellType,$groupBy);
    }

    public function addRowProcess($op,$receiving,$sub_receiving_code,$rxId,$G_NO_index){
        $currencyRow = Service_Currency::getByField($op['currency_code'],'currency_code',"*");
        if($op['country_code_of_origin']!=""){
            $country = Service_Country::getByField($op['country_code_of_origin'],'country_code','*');
        }

        $receivingXmlDetail = array(
            'rx_id'=>$rxId,
            'from_id'=>$receiving['receiving_code'],
            'sub_receiving_code'=>$sub_receiving_code,
            'g_no'=>$G_NO_index,
            'goods_id'=>$op['goods_id'],
            'merger_g_no'=>$G_NO_index,
            'code_ts'=>$op['hs_code'],
            'g_unit'=>$op['pu_code'],
            'g_name_cn'=>$op['hs_goods_name'],
            'decl_price'=>$op['product_declared_value'],
            'curr'=>$currencyRow['currency_hs_code'],
            'origin_country'=>isset($country['trade_country'])?$country['trade_country']:"",
        );

        $hemList = Service_HsElementMap::getByCondition(array('product_id'=>$op['product_id']), 'hem_detail');

        $elements = array();
        if(!empty($hemList)){
            foreach($hemList as $hemRow) {
                $hem_detail = trim($hemRow['hem_detail']);
                if($hem_detail!=''){
                    $elements[] = $hem_detail ? $hem_detail : '/';
                }
            }
        }

        $receivingXmlDetail['g_model'] = implode('|',$elements);
        $hs_uom_map = Service_HsUomMap::getByField($op['product_id'],'product_id',"*");
        $receivingXmlDetail['qty_1'] = isset($hs_uom_map['hum_quantity_law'])?$hs_uom_map['hum_quantity_law']*$op['op_quantity']:0*$op['op_quantity'];
        $receivingXmlDetail['qty_2'] = isset($hs_uom_map['hum_quantity_second'])?$hs_uom_map['hum_quantity_second']*$op['op_quantity']:0*$op['op_quantity'];
        if(!empty($hs_uom_map)) $hs_uom = Service_HsUom::getByField($hs_uom_map['hu_id'],'hu_id',"*");
        $receivingXmlDetail['unit_1'] = isset($hs_uom['pu_code_law'])?$hs_uom['pu_code_law']:"";
        $receivingXmlDetail['unit_2'] = isset($hs_uom['pu_code_second'])?$hs_uom['pu_code_second']:"";

        $decl_total = $op['product_declared_value']*$op['op_quantity'];
        $receivingXmlDetail['g_qty'] = $op['op_quantity'];
        $ntWeight = Service_OrderProduct::calNetWeightByCondition(array('goods_id'=>$op['goods_id'],'receiving_code'=>$receiving['receiving_code'],'product_id'=>$op['product_id'],'order_code'=>$op['order_code']));

        $receivingXmlDetail['decl_total'] = $decl_total;
        //Service_ReceivingXmlDetail::add($receivingXmlDetail);
        self::add($receivingXmlDetail);

        $receivingXmlRow = Service_ReceivingXml::getByField($sub_receiving_code,'sub_receiving_code',"*");

        $updateReceivingXml = array(
            'gross_wt'=>$receivingXmlRow['gross_wt']+$ntWeight,
            'net_wt'=>$receivingXmlRow['net_wt']+$ntWeight,
            'pack_no'=>$receivingXmlRow['pack_no']+$op['op_quantity'],
        );
        Service_ReceivingXml::update($updateReceivingXml,$sub_receiving_code,'sub_receiving_code');

        $exitRecevingXmlOrder = Service_ReceivingXmlOrder::getByField($op['order_code'],'order_code',"*");
        if(empty($exitRecevingXmlOrder)){
            $receivingXmlOrderRow = array(
                'rx_id'=>$rxId,
                'sub_receiving_code'=>$sub_receiving_code,
                'order_code'=>$op['order_code'],
            );

            Service_ReceivingXmlOrder::add($receivingXmlOrderRow);
        }
    }

    public function updateProcess($op,$receiving,$receivingXmlDetailRow){
        $ntWeight = Service_OrderProduct::calNetWeightByCondition(array('goods_id'=>$op['goods_id'],'receiving_code'=>$receiving['receiving_code'],'product_id'=>$op['product_id'],'order_code'=>$op['order_code']));
        $hs_uom_map = Service_HsUomMap::getByField($op['product_id'],'product_id',"*");
        $qty_1 = isset($hs_uom_map['hum_quantity_law'])?$hs_uom_map['hum_quantity_law']*$op['op_quantity']:0*$op['op_quantity'];
        $qty_2 = isset($hs_uom_map['hum_quantity_second'])?$hs_uom_map['hum_quantity_second']*$op['op_quantity']:0*$op['op_quantity'];
        $updateReceivingXmlDetail = array(
            'g_qty'=>$receivingXmlDetailRow['g_qty']+$op['op_quantity'],
            'qty_1'=>$receivingXmlDetailRow['qty_1']+$qty_1,
            'qty_2'=>$receivingXmlDetailRow['qty_2']+$qty_2,
            'decl_total'=>$receivingXmlDetailRow['decl_total']+$op['op_quantity']*$op['product_declared_value'],
        );
        self::update($updateReceivingXmlDetail,$receivingXmlDetailRow['rxd_id'],"rxd_id");
        $RX = Service_ReceivingXml::getByField($receivingXmlDetailRow['rx_id'],'rx_id',"*");
        $updateRX = array(
            'gross_wt'=>$RX['gross_wt']+$ntWeight,
            'net_wt'=>$RX['net_wt']+$ntWeight,
            'pack_no'=>$RX['pack_no']+$op['op_quantity'],
        );
        Service_ReceivingXml::update($updateRX,$receivingXmlDetailRow['rx_id'],'rx_id');
        $exitRecevingXmlOrder = Service_ReceivingXmlOrder::getByField($op['order_code'],'order_code',"*");
        if(empty($exitRecevingXmlOrder)){
            $receivingXmlOrderRow = array(
                'rx_id'=>$receivingXmlDetailRow['rx_id'],
                'sub_receiving_code'=>$receivingXmlDetailRow['sub_receiving_code'],
                'order_code'=>$op['order_code'],
            );

            Service_ReceivingXmlOrder::add($receivingXmlOrderRow);
        }
    }
}
