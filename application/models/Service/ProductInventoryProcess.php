<?php
class Service_ProductInventoryProcess
{
    //产品库存操作类
    protected $_date = '';
    protected $_productArr = array();
    protected $_errorMessage = array();

    //操作类型
    public static $_operationType = array(
        1 => 'stockInCheckPass',	//入库单审核通过
		2 => 'personItemAdd',	//物品清单比对通过
		3 => 'personItemCheckFailure',//物品清单审核不通过
		4 => 'loaderCheckPass',//载货单审核通过
		5 => 'inventoryModify',//账册调整
    );

    public function __construct()
    {
        $this->_date = date('Y-m-d H:i:s');
    }

    /**
     * @param array $params
     * @return array
     */
    private function validator($params = array())
    {
        $row = array(
            'goodsId' => 0,
            'quantity' => 0,
			'qty_1'=> 0,
			'qty_2'=> 0,
            'operationType' => 0,
			'warehouseCode'=>'',
			'ieType'=>'',
			'code_ts'	=> '',
			'g_name_cn'	=> '',
			'hs_name'	=> '',
			'g_name_en'	=> '',
			'stock_unit'=> '',
			'curr'	=> '',
			'owner_code'=>'',
			'cus_goods_id'=>'',
			'g_model'=>'',
			'origin_country'=>'',
			'unit_1'		=> '',
			'unit_2'		=> '',
			'duty_mode'		=> '',
			'use_to'		=> '',
			'decl_price'	=> 0,
        );
        $valid = array('goodsId', 'quantity','operationType', 'warehouseCode');
        if (!is_array($params) || empty($params)) {
            $this->_errorMessage[] = array('errorCode' => 10001, 'errorMsg' => Ec_Lang::getInstance()->getTranslate('paramsErr'));
            return $row;
        }

        foreach ($row as $key => $val) {
            $row[$key] = isset($params[$key]) ? $params[$key] : '';
        }

        $require = Ec_Lang::getInstance()->getTranslate('require');
        $type = self::$_operationType;
        if (!isset($type[$row['operationType']])) {
            $this->_errorMessage[] = array('errorCode' => 10002, 'errorMsg' => 'operationType ' . $require);
            return $row;
        }
        foreach ($valid as $key) {
            if (!isset($row[$key]) || empty($row[$key])) {
                $this->_errorMessage[] = array('errorCode' => 10002, 'errorMsg' => $key . ' ' . $require);
            }
        }
        return $row;
    }


    /**
     * @更新库存
     * @param array $params
     * @return array('state','message'=>array())
     * @return array
     * @throws Exception
     */
    public function update($params = array())
    {
        $result = array('state' => 0, 'message' => array());
        $row = $this->validator($params);
        if (!empty($this->_errorMessage)) {
            $result['message'] = $this->_errorMessage;
            return $result;
        }
        try {
            $isInventory = false;
            $updateRow = array(
                'stock_in_all' => 0,
                'stock_in_td' => 0,
                'stock_out_all' => 0,
                'stock_out_td' => 0,
                'amount_to_reduce' => 0,
				'stock_frozen'=>0,
				'stock_qty'=>0,
				'qty_1'		=> 0,
				'qty_2'		=> 0,
                'goods_id' => $row['goodsId'],
                'warehouse_code' => $row['warehouseCode'],
				'owner_code'=>$row['owner_code'],
				'ie_type'	=>$row['ieType'],
				'code_ts'	=> $row['code_ts'],
				'g_name_cn'	=> $row['g_name_cn'],
				'hs_name'	=> $row['hs_name'],
				'g_name_en'	=> $row['g_name_en'],
				'stock_unit'=> $row['stock_unit'],
				'curr'	=> $row['curr'],
				'cus_goods_id'=>$row['cus_goods_id'],
				'g_model'=>$row['g_model'],
				'origin_country'=>$row['origin_country'],
				'unit_1'	=> $row['unit_1'],
				'unit_2'	=> isset($row['unit_2'])?$row['unit_2']:'',
				'duty_mode'	=> isset($row['duty_mode'])?$row['duty_mode']:'',
				'use_to'	=> isset($row['use_to'])?$row['use_to']:'',
				'decl_price'=> isset($row['decl_price'])?$row['decl_price']:0,
            );
			
            $inventoryRow = Table_ProductInventory::getInstance()->getByWhProduct($row['goodsId'], $row['warehouseCode'],$row['ieType']);
            if (!empty($inventoryRow)) {
                $isInventory = true;
                foreach ($updateRow as $key => $val) {
                    if (isset($inventoryRow[$key])) {
                        $updateRow[$key] = $inventoryRow[$key];
                    }
                }
            }else{
				if(1 != $params['operationType']){
					throw new Exception('料件级库存不存在', 50000);
				}
			}
			
            //统一日志
			$log	= array();
            switch ($row['operationType']) {
				//入库单审核成功
                case 1:
					$log['stock_in_all']['pil_origin']	=  $updateRow['stock_in_all'];
					$log['stock_in_all']['pil_after']	=  $updateRow['stock_in_all']+$row['quantity'];
					$log['stock_qty']['pil_origin']		=  $updateRow['stock_qty'];
					$log['stock_qty']['pil_after']		=  $updateRow['stock_qty']+$row['quantity'];
					$log['qty_1']['pil_origin']	=  $updateRow['qty_1'];
					$log['qty_1']['pil_after']	=  $updateRow['qty_1']+$row['qty_1'];
					$log['qty_2']['pil_origin']	=  $updateRow['qty_2'];
					$log['qty_2']['pil_after']	=  $updateRow['qty_2']+$row['qty_2'];
                    $updateRow['stock_in_all'] = $updateRow['stock_in_all'] + $row['quantity'];
					$updateRow['stock_qty'] = $updateRow['stock_qty'] + $row['quantity'];
					$updateRow['qty_1'] = $updateRow['qty_1'] + $row['qty_1'];
					$updateRow['qty_2'] = $updateRow['qty_2'] + $row['qty_2'];
                    break;
				//物品清单添加成功
                case 2:
					$log['stock_frozen']['pil_origin']	=  $updateRow['stock_frozen'];
					$log['stock_frozen']['pil_after']	=  $updateRow['stock_frozen']+$row['quantity'];
					$log['stock_qty']['pil_origin']		=  $updateRow['stock_qty'];
					$log['stock_qty']['pil_after']		=  $updateRow['stock_qty']-$row['quantity'];
					//$log['qty_1']['pil_origin']	=  $updateRow['qty_1'];
					//$log['qty_1']['pil_after']	=  $updateRow['qty_1']-$row['qty_1'];
					//$log['qty_2']['pil_origin']	=  $updateRow['qty_2'];
					//$log['qty_2']['pil_after']	=  $updateRow['qty_2']-$row['qty_2'];
					//$updateRow['qty_1'] = $updateRow['qty_1'] - $row['qty_1'];
					//$updateRow['qty_2'] = $updateRow['qty_2'] - $row['qty_2'];
                    $updateRow['stock_qty'] = $updateRow['stock_qty'] - $row['quantity'];
					$updateRow['stock_frozen'] = $updateRow['stock_frozen'] + $row['quantity'];
                    break;
				//物品清单审核失败
                case 3:
					$log['stock_frozen']['pil_origin']	=  $updateRow['stock_frozen'];
					$log['stock_frozen']['pil_after']	=  $updateRow['stock_frozen']-$row['quantity'];
					$log['stock_qty']['pil_origin']		=  $updateRow['stock_qty'];
					$log['stock_qty']['pil_after']		=  $updateRow['stock_qty']+$row['quantity'];
					//$log['qty_1']['pil_origin']	=  $updateRow['qty_1'];
					//$log['qty_1']['pil_after']	=  $updateRow['qty_1']+$row['qty_1'];
					//$log['qty_2']['pil_origin']	=  $updateRow['qty_2'];
					//$log['qty_2']['pil_after']	=  $updateRow['qty_2']+$row['qty_2'];
					//$updateRow['qty_1'] = $updateRow['qty_1'] + $row['qty_1'];
					//$updateRow['qty_2'] = $updateRow['qty_2'] + $row['qty_2'];
                    $updateRow['stock_qty'] = $updateRow['stock_qty'] + $row['quantity'];
					$updateRow['stock_frozen'] = $updateRow['stock_frozen'] - $row['quantity'];
					
                    break;
				//载货单审核成功
                case 4:
					$log['stock_out_all']['pil_origin']		=  $updateRow['stock_out_all'];
					$log['stock_out_all']['pil_after']		=  $updateRow['stock_out_all']+$row['quantity'];
					$log['stock_frozen']['pil_origin']		=  $updateRow['stock_frozen'];
					$log['stock_frozen']['pil_after']		=  $updateRow['stock_frozen']-$row['quantity'];
                    $updateRow['stock_out_all'] = $updateRow['stock_out_all'] + $row['quantity'];
					$updateRow['stock_frozen'] = $updateRow['stock_frozen'] - $row['quantity'];
                    break;
				//账册调整
                case 5:
					$log['stock_qty']['pil_origin']		=  $updateRow['stock_qty'];
					$log['stock_qty']['pil_after']		=  $row['quantity'];
					$updateRow['stock_qty'] = $row['quantity'];
                    break;
                default:
                    throw new Exception('Internal error! Type Wrong.', 50000);
                    break;
            }
			if($updateRow['stock_in_all'] < 0 ||
			   $updateRow['stock_in_td'] < 0  ||
			   $updateRow['stock_out_all'] < 0  ||
			   $updateRow['stock_out_td'] < 0 ||
			   $updateRow['stock_qty'] < 0 || 
			   $updateRow['stock_frozen'] < 0 ){
				   throw new Exception('Internal error! stock less than 0', 50000);
			}
			$piId	= '';
            if ($isInventory) {
				$piId = $inventoryRow['pi_id'];
                if (!Service_ProductInventory::update($updateRow, $inventoryRow['pi_id'], 'pi_id')) {
                    throw new Exception('Internal error! Update Fail.', 50000);
                }
            } else {
				$piId =Service_ProductInventory::add($updateRow);
                if(!$piId){
					throw new Exception('Internal error! Add Fail.', 50000);
				}
            }
			foreach($log as $key=>$val){
				if($val['pil_origin'] > 0 || $val['pil_after'] > 0){
					$addLog = array(
						'pi_id'				=> $piId,
						'pil_quantity'		=> $row['quantity'],
						'goods_id'			=> $row['goodsId'],
						'warehouse_code'	=> $row['warehouseCode'],
						'pil_application'	=> $key,
						'pil_origin'		=> $val['pil_origin'],
						'pil_after'			=> $val['pil_after'],
						'pil_note'          => isset($params['note']) ? $params['note'] : '',
					);
					$this->addLog($addLog);
				}
			}
            $result['state'] = 1;
            $result['message'] = array('success');
        } catch (Exception $e) {
            $result['message'] = array(
                'errorCode' => $e->getCode(),
                'errorMse' => $e->getMessage()
            );
        }
        return $result;
    }

    /**
     * @param $row
     * @return bool
     * @throws Exception
     */
    private function addLog($row)
    {
        $addLog = array(
			'pi_id'	=> $row['pi_id'],
            'goods_id' => $row['goods_id'],
            'warehouse_code' => $row['warehouse_code'],
            'user_id' => '-1',
            'pil_quantity' => $row['pil_quantity'],
            'pil_note' => '',
			'pil_application'=> $row['pil_application'],
            'pil_add_time' => $this->_date,
			'pil_origin'=> $row['pil_origin'],
			'pil_after'	=> $row['pil_after'],
        	'pil_ip' => Common_Common::getIP(),
        );
        if (!Service_ProductInventoryLog::add($addLog)) {
            throw new Exception('Internal error! Update Inventory  Fail.', 50000);
            return false;
        }
        return true;
    }
}