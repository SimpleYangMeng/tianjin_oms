<?php
class Service_ReceivingInventoryProcess
{
    //产品库存操作类
    protected $_date = '';
    protected $_errorMessage = array();

    //操作类型
    public static $_operationType = array(
        1 => 'stockInCheckPass',	//入库单审核通过
		2 => 'loaderAdd',	//载货单新增
		3 => 'loaderAddFailure',//载货单审核失败
		4 => 'loaderAddCheckPass',//载货单审核通过
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
            'quantity'		=> 0,
        	'qty_1'			=> 0,
        	'qty_2'			=> 0,
			'operationType'	=> 0,
			'warehouseCode'	=> '',
			'code_ts'		=> '',
			'g_name_cn'		=> '',
			'hs_name'		=> '',
			'g_name_en'		=> '',
			'stock_unit'	=> '',
			'curr'			=> '',
			'receiving_code'=> '',
			'merge_g_no'	=> '',
        	'unit_1'		=> '',
        	'unit_2'		=> '',
        );
        $valid = array('quantity', 'unit_1', 'qty_1', 'operationType', 'warehouseCode','receiving_code');
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
				'merge_g_no'=>$row['merge_g_no'],
				'receiving_code'	=>$row['receiving_code'],
				'qty'=>0,
				'stock_in_all'=>0,
				'stock_out_all'=>0,
				'stock_frozen'=>0,
                'warehouse_code' => $row['warehouseCode'],
				'code_ts'	=> $row['code_ts'],
				'g_name_cn'	=> $row['g_name_cn'],
				'hs_name'	=> $row['hs_name'],
				'g_name_en'	=> $row['g_name_en'],
				'stock_unit'=> $row['stock_unit'],
				'curr'	=> $row['curr'],
            	'qty_1'=>0,
            	'qty_2'=>0,
            	'unit_1'=>$row['unit_1'],
            	'unit_2'=>$row['unit_2'],
            );
            $inventoryRow = Table_ReceivingInventory::getInstance()->getByWhProduct($row['receiving_code'], $row['merge_g_no']);
            if (!empty($inventoryRow)) {
                $isInventory = true;
                foreach ($updateRow as $key => $val) {
                    if (isset($inventoryRow[$key])) {
                        $updateRow[$key] = $inventoryRow[$key];
                    }
                }
            }else{
				if(1 != $params['operationType']){
					throw new Exception('项号级库存不存在', 50000);
				}
			}
            //统一日志
			$log	= array();
            switch ($row['operationType']) {
				//入库单审核成功
                case 1:
					$log['qty']['ril_origin']	=  $updateRow['qty'];
					$log['qty']['ril_after']	=  $updateRow['qty']+$row['quantity'];
					$log['qty_1']['ril_origin']	=  $updateRow['qty_1'];
					$log['qty_1']['ril_after']	=  $updateRow['qty_1']+$row['qty_1'];
					$log['qty_2']['ril_origin']	=  $updateRow['qty_2'];
					$log['qty_2']['ril_after']	=  $updateRow['qty_2']+$row['qty_2'];
					$log['stock_in_all']['ril_origin']		=  $updateRow['stock_in_all'];
					$log['stock_in_all']['ril_after']		=  $updateRow['stock_in_all']+$row['quantity'];
                    $updateRow['stock_in_all'] = $updateRow['stock_in_all'] + $row['quantity'];
					$updateRow['qty'] =  $row['quantity'];
					$updateRow['qty_1']	= $updateRow['qty_1']+$row['qty_1'];
					$updateRow['qty_2']	= $updateRow['qty_2']+$row['qty_2'];
                    break;
				//载货单添加成功
                case 2:
					$log['stock_frozen']['ril_origin']		=  $updateRow['stock_frozen'];
					$log['stock_frozen']['ril_after']		=  $updateRow['stock_frozen']+$row['quantity'];
                    $updateRow['stock_frozen'] = $updateRow['stock_frozen'] + $row['quantity'];
                    break;
				//载货单审核失败
                case 3:
					$log['stock_frozen']['ril_origin']	=  $updateRow['stock_frozen'];
					$log['stock_frozen']['ril_after']	=  $updateRow['stock_frozen']-$row['quantity'];
					$updateRow['stock_frozen'] = $updateRow['stock_frozen'] - $row['quantity'];
                    break;
				//载货单审核成功
                case 4:
					$log['qty']['ril_origin']	=  $updateRow['qty'];
					$log['qty']['ril_after']	=  $updateRow['qty']-$row['quantity'];
					$log['stock_out_all']['ril_origin']		=  $updateRow['stock_out_all'];
					$log['stock_out_all']['ril_after']		=  $updateRow['stock_out_all']+$row['quantity'];
					$log['qty_1']['ril_origin']	=  $updateRow['qty_1'];
					$log['qty_1']['ril_after']	=  $updateRow['qty_1']-$row['qty_1'];
					$log['qty_2']['ril_origin']	=  $updateRow['qty_2'];
					$log['qty_2']['ril_after']	=  $updateRow['qty_2']-$row['qty_2'];
                    $updateRow['stock_out_all'] = $updateRow['stock_out_all'] + $row['quantity'];
					$updateRow['qty'] =  $updateRow['qty']-$row['quantity'];
					$updateRow['stock_frozen'] = $updateRow['stock_frozen'] - $row['quantity'];
					$updateRow['qty_1']	= $updateRow['qty_1']-$row['qty_1'];
					$updateRow['qty_2']	= $updateRow['qty_2']-$row['qty_2'];
					$log['stock_frozen']['ril_origin']	=  $updateRow['stock_frozen'];
					$log['stock_frozen']['ril_after']	=  $updateRow['stock_frozen']-$row['quantity'];
                    break;
				//账册调整
				case 5:
					$log['qty']['ril_origin']	=  $updateRow['qty'];
					$log['qty']['ril_after']	=  $row['quantity'];
					$log['qty_1']['ril_origin']	=  $updateRow['qty_1'];
					$log['qty_1']['ril_after']	=  $row['qty_1'];
					//$log['qty_2']['ril_origin']	=  $updateRow['qty_2'];
					//$log['qty_2']['ril_after']	=  $row['qty_2'];
					$updateRow['qty_1']	= $row['qty_1'];
					//$updateRow['qty_2']	= $row['qty_2'];
					$updateRow['qty'] = $row['quantity'];
					break;
                default:
                    throw new Exception('Internal error! Type Wrong.', 50000);
                    break;
            }
			if($updateRow['stock_in_all'] < 0 ||
			   $updateRow['stock_out_all'] < 0  ||
			   $updateRow['qty'] < 0 || 
			   $updateRow['stock_frozen'] < 0||
			   $updateRow['stock_frozen'] > $updateRow['qty'] ||
			   $updateRow['qty_1'] < 0 || 
			   $updateRow['qty_2'] < 0){
				   throw new Exception('Internal error! stock less than 0', 50000);
			}
			$riId	= '';
            if ($isInventory) {
				$riId = $inventoryRow['ri_id'];
                if (!Service_ReceivingInventory::update($updateRow, $inventoryRow['ri_id'], 'ri_id')) {
                    throw new Exception('Internal error! Update Fail.', 50000);
                }
            } else {
				$riId =Service_ReceivingInventory::add($updateRow);
                if(!$riId){
					throw new Exception('Internal error! Add Fail.', 50000);
				}
            }
			foreach($log as $key=>$val){
				if($val['ril_origin']>0 || $val['ril_after']>0){
					$addLog = array(
						'ri_id'				=> $riId,
						'ril_application'	=> $key,
						'user_id'			=> '-1',
						'ril_quantity'		=> $row['quantity'],
						'ril_origin'		=> $val['ril_origin'],
						'ril_after'			=> $val['ril_after'],
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
			'ri_id'				=> $row['ri_id'],
			'ril_application'	=> $row['ril_application'],
			'user_id'			=> '-1',
			'ril_quantity'		=> $row['ril_quantity'],
			'ril_origin'		=> $row['ril_origin'],
			'ril_after'			=> $row['ril_after'],
            'ril_add_time' 		=> $this->_date,
        	'ril_ip' => Common_Common::getIP(),
        );
        if (!Service_ReceivingInventoryLog::add($addLog)) {
            throw new Exception('Internal error! Update Inventory  Fail.', 50000);
            return false;
        }
        return true;
    }
}