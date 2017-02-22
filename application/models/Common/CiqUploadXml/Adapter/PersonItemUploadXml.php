<?php

/**
*
*/
class PersonItemUploadXml extends ShangJianXmlParent
{
    //操作对应的状态
    protected $status = 0;
    //接口代码 PersonItem->接口代码
    protected $apiCode = 'PersonItem';
    
    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createBodyXml($itemRow)
    {
        $personItemData = Service_PersonItem::getByField($itemRow['ref_id'] , 'pim_id');
        if(empty($personItemData)){
            $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]不存在";
            return false;
        }

        if($personItemData['account_code'] != ''){
            $account_item = Service_Account::getByField($personItemData['account_code'],'account_code',array('account_real_name','account_phone'));
            if(empty($account_item) || $account_item['account_real_name'] == ''){
                $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]申报人[{$personItemData['account_code']}]不存在";
                return false;
            }else if(empty($account_item) || $account_item['account_phone'] == ''){
                $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]申报人[{$personItemData['account_code']}]联系方式不存在";
                return false;
            }            
        }else{
            $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]申报人不存在";
            return false;
        }    

        if($personItemData['storage_customer_code'] != ''){
            $ent_code = Service_Customer::getByField($personItemData['storage_customer_code'],'customer_code');
            if(empty($ent_code) || $ent_code['ciq_reg_num'] == ''){
                $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]申报单位[{$personItemData['storage_customer_code']}]不存在";
                return false;
            }
        }else{
            $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]申报单位代码不存在";
            return false;
        }

        if($personItemData['customer_code'] != ''){
            $cbe_code = Service_Customer::getByField($personItemData['customer_code'],'customer_code');
            if(empty($cbe_code) || $cbe_code['ciq_reg_num'] == ''){
                $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]电商企业[{$personItemData['customer_code']}]不存在";
                return false;
            }
            if(empty($cbe_code) || $cbe_code['ins_unit_code'] == ''){
                $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]电商企业[{$personItemData['customer_code']}]施检机构代码不存在";
                return false;
            }
        }else{
            $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]电商企业代码不存在";
            return false;
        }

        $customerData = Service_Customer::getByField($personItemData['logistic_customer_code'] , 'customer_code', array('ins_unit_code'));
        if(empty($customerData)){
            $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]物流企业[{$personItemData['logistic_customer_code']}]不存在";
            return false;
        }
        //属地检验检疫机构代码
        $this->_insUnitCode = $customerData['ins_unit_code'];
        
        $IODeclHead = array(
            'IO_SERIAL_NO'  => $personItemData['pim_id'],
            'DECL_NO'       => $personItemData['pim_code'],
            'DECL_PERSON'   => $account_item['account_real_name'],
            'DECL_DATE'     => date("Y-m-d H:i:s",time()),//$personItemData['declare_time'],
            'DECL_TEL'      => $account_item['account_phone'],
            'LOGISTICSNO'   => $personItemData['log_no'],
            'ORDER_NO'      => $personItemData['order_reference_no'],
            'PAYMENT_NO'    => $personItemData['pay_no'],
            'DECL_TYPE_CODE'=> 'SI',//申报类型代码
            'ENT_CODE'      => $ent_code['ciq_reg_num'],
            'CBECODE'       => $cbe_code['ciq_reg_num'],
            'LOGISTICS_CODE'=> $ent_code['ciq_reg_num'],
            'CHECK_ORG_CODE'=> $cbe_code['ins_unit_code'],//施检机构代码
            'ID_TYPE'       => '1',//收货人证件类型编号(默认身份证)
            'TOTAL_VALUES'  => $personItemData['freight'],
            'STOCK_FLAG'    => 'C',//集货/备货标识 C备货 B集货
            'CONSIGNEE_CNAME'=>$personItemData['receive_name'],
            'CONSIGNEE_TEL'  =>$personItemData['receive_telphone'],
            'CONSIGNEE_ADDRESS'=>$personItemData['receiving_address'],
            'ID_CARD'       => $personItemData['receive_id_number'],//证件号码
            'CONSIGNOR_CNAME'=>$personItemData['ship_name'],//进口不填
            'CONSIGNOR_TEL'=>'',//进口不填
            'CONSIGNOR_ADDRESS'=> '',//进口不填
        );
        
        $personItemProductData = Service_PersonItemProduct::getByCondition(array('pim_id'=>$itemRow['ref_id']));
        if(empty($personItemProductData)){
            $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]商品不存在";
            return false;
        }
        foreach ($personItemProductData as $key => $value) {
            if($value['product_id']){
                $productItem = Service_Product::getByField($value['product_id'],'product_id','inspection_code');
                if(empty($productItem) || $productItem['inspection_code'] == ''){
                     $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]的商品[{$value['product_id']}]商检备案编号不存在";
                     return false;
                }
            }else{
                $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]的商品[{$value['product_id']}]商检备案编号不存在";
                return false;
            }

            if(!empty($value['country'])){
                $country_arr = Service_Country::getByField($value['country'],'country_code','b_bbd_country_code');
                if(empty($country_arr) || $country_arr['b_bbd_country_code'] == ''){
                    $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]的商品[{$value['product_id']}]原产国[{$value['country']}]检验检疫代码不存在";
                    return false;
                }
            }else{
                $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]的商品[{$value['product_id']}]原产国代码不存在";
                return false;
            }

            if(!empty($value['curr'])){
                $curr_code_arr = Service_Currency::getByField($value['curr'],'currency_code','b_bbd_currency_code');
                if(empty($curr_code_arr) || $curr_code_arr['b_bbd_currency_code'] == ''){
                    $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]的商品[{$value['product_id']}]币值[{$value['curr']}]检验检疫编号不存在";
                    return false;
                }
            }else{
                $this->_error[] = "物品清单[{$itemRow['ref_cus_code']}]的商品[{$value['product_id']}]币值编号不存在";
                return false;
            }
            $IODeclGoodsListInformation[] = array(
                'IO_GOODS_SERIAL_NO'            => $value['ciq_g_no'],
                'SEQ_NO'                        => $key+1,
                'ENT_CODE'                      => $cbe_code['ciq_reg_num'],
                'GOODS_REG_NO'                  => $productItem['inspection_code'],
                'DECL_II_NO'                    => '',//$value[''],//进口入区申报号
                'LOGISTICSNO'                   => $personItemData['log_no'],
                'ORDER_NO'                      => $personItemData['order_reference_no'],
                'PAYMENT_NO'                    => $personItemData['pay_no'],
                'HS_CODE'                       => $value['hs_code'],
                'ENT_CNAME'                     => $cbe_code['trade_name'],
                'GOODS_NO'                      => $value['g_no'],
                'GOODS_NAME'                    => $value['g_name_cn'],
                'CONSIGNEE_CNAME'               => $personItemData['receive_name'],
                'CONSIGNEE_IDTYPE'              => '1',
                'ORIGIN_COUNTRY_CODE'           => $country_arr['b_bbd_country_code'],
                'QTY_UNIT_CODE'                 => $value['g_uint'],
                'QTY'                           => $value['g_qty'],
                'GOODS_UNIT_PRICE'              => $value['price'],
                'GOODS_TOTAL_VALUES'            => $value['total_price'],
                'CURR_UNIT'                     => $curr_code_arr['b_bbd_currency_code'],
                'REMARK'                        => '',
            );
        }

        $MessageBody = array(
            'IODeclDocument' => array(
                'IODeclHead' => $IODeclHead,
                'IODeclGoodsList'=>array(
                    'IODeclGoodsListInformation'=>$IODeclGoodsListInformation
                ),
            )
        );

        return $MessageBody;
    }
}
