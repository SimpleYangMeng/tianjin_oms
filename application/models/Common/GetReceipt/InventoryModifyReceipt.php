<?php

class InventoryModifyReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    //海关接收回执状态变化
    private static $hgreceiveStatus = array(
        'fromStatus'=>2,
        'toStatus'=> 3,
    );
    //海关审核回执状态变化
    private static $hgcheckStatus = array(
        'fromStatus'=>3,
        'toStatus'=> 5,
        'notpassStatus'=>6
    );
	
    public static function receive(array $bodyRow, array $headRow)
    {
        $time = date('Y-m-d H:i:s',time());
        $row = Service_InventoryModify::getByField($bodyRow['form_id'],'im_code');
        $fromStatus = self::$hgreceiveStatus['fromStatus'];
        $toStatus = self::$hgreceiveStatus['toStatus'];
        if(!empty($row) && $row['status'] == $fromStatus){
            try {
                if('01' != $bodyRow['feedback_flag']){
                    $toStatus = self::$hgcheckStatus['notpassStatus'];
                }
				$updateRow = array(
					'status'=>$toStatus,
					'update_time'=>date('Y-m-d H:i:s'),
				);
				if(!Service_InventoryModify::update($updateRow,$row['im_id'])){
					throw new Exception("账册[{$row['im_code']}]调整更新失败");
				}
				$log = array(
					'im_code'=>$row['im_code'],
					'type' => 1,
					'user_id'=>'-1',
					'customer_code'=>'system',
					'status_from'=>$fromStatus,
					'status_to'=>$toStatus,
					'note' => $bodyRow['feedback_mess'],
					'add_time'=>$time,
					'ip'=>'127.0.0.1',
				);
				if(!Service_InventoryModifyLog::add($log)){
					throw new Exception("账册[{$row['im_code']}]调整日志添加失败");
				}
                self::$return['ask'] = 1;
                self::$return['message'] = "账册[{$row['im_code']}]调整接收队列处理成功";
            } catch (Exception $e) {
                self::$return['error'] = $e->getMessage();
            }
        } else{
			throw new Exception('操作有误');
        }
        return self::$return;
    }
	
    public static function receiveCheck(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];
        $row = Service_InventoryModify::getByField($bodyRow['form_id'],'im_code');
        $fromStatus = self::$hgcheckStatus['fromStatus'];
        $toStatus = self::$hgcheckStatus['toStatus'];
        $notpassStatus = self::$hgcheckStatus['notpassStatus'];
        if(!empty($row) && $row['status'] == $fromStatus){
            try {
				//审核通过
                if('03' != $bodyRow['feedback_flag']){
                    $toStatus = $notpassStatus;//审核不通过
                }
                $updateRow = array(
					'status'=>$toStatus,
					'update_time'=>date('Y-m-d H:i:s'),
				);
				if(!Service_InventoryModify::update($updateRow,$row['im_id'])){
					throw new Exception("账册[{$row['im_code']}]调整更新失败");
				}
				if($toStatus != $notpassStatus){
					//不是审核审核不通过（就是审核通过）,更新库存
					$productInventoryProcess  = new Service_ProductInventoryProcess();
					$productInventory = Service_InventoryModifyProduct::getByCondition(array('im_code'=>$row['im_code']));
					foreach($productInventory as $key=>$val){
						$updatParam	= array(
								'goodsId'			=> $val['goods_id'],
								'quantity'			=> $val['stock_all'],
								'operationType'		=> 5,
								'warehouseCode'		=> $row['ems_no'],
								'cus_goods_id'		=> $val['cus_goods_id'],
								'ieType'			=> $row['ie_flag'],
								'note'				=> '账册调整',
						);
						$inventoryState = $productInventoryProcess->update($updatParam);
						if(1 != @$inventoryState['state']){
							throw new Exception($row['im_code'].':'.$val['goods_id'].'料件级库存更新失败');
						}
					}
					$productInventoryMerge	= Service_InventoryModifyMerger::getByCondition(array('im_code'=>$row['im_code']));
					$receivingInventoryProcess  = new Service_ReceivingInventoryProcess();
					foreach($productInventoryMerge as $key=>$val){
						$receivingInfo			= Service_Receiving::getByField($val['i_form_id'],'declaration_number');
						$uParam	= array(
								'quantity'		=> $val['stock_all'],
								'operationType'	=> 5,
								'warehouseCode'	=> $row['ems_no'],
								'code_ts'		=> $val['code_ts'],
								'g_name_cn'		=> $val['g_name'],
								'g_name_en'		=> '',
								'stock_unit'	=> $val['g_unit'],
								'curr'			=> $val['curr'],
								'receiving_code'=> $receivingInfo['receiving_code'],
								'receiving_id'	=> $receivingInfo['receiving_id'],
								'merge_g_no'	=> $val['i_form_item'],
								'qty_1'			=> $val['qty_1'],
								'unit_1'		=> $val['unit_1'],
						);
						$receivingInventoryState = $receivingInventoryProcess->update($uParam);
						if(1 != @$receivingInventoryState['state']){
							throw new Exception($row['im_code'].':'.$val['i_form_item'].'项号级库存更新失败');
						}
					}
					$log = array(
							'im_code'=>$row['im_code'],
							'type' => 1,
							'user_id'=>'-1',
							'customer_code'=>'system',
							'status_from'=>$fromStatus,
							'status_to'=>$toStatus,
							'note' => $bodyRow['feedback_mess'],
							'add_time'=>$time,
							'ip'=>'127.0.0.1',
					);
					if(!Service_InventoryModifyLog::add($log)){
						throw new Exception("账册[{$row['im_code']}]调整日志添加失败");
					}
				}
				$warehouseInfo	= Service_Warehouse::getByField($row['ems_no'],'warehouse_code');
				if(1 == $warehouseInfo['warehouse_status']){
					if(!Service_Warehouse::update(
						array(
							'warehouse_status'=>5,
							'update_time'=>$time
						),$warehouseInfo['warehouse_id'])){
							throw new Exception('账册更新失败');
					}
					$aWarehouse = array(
						'warehouse_id'	=> $warehouseInfo['warehouse_id'],
						'warehouse_code'=> $warehouseInfo['warehouse_code'],
						'type'			=> 0,
						'status_from'	=> $warehouseInfo['warehouse_status'],
						'status_to'		=> 5,
						'ip'			=> '127.0.0.1',
						'comments'		=> '账册调整接收回执，状态变更',
						'user_id'		=> -1,
						'account_code'	=> 'system',
						'add_time'		=> $time,
					);
					if(!Service_WarehouseLog::add($aWarehouse)){
						throw new Exception('账册日志添加失败');
					}
				}
                self::$return['ask'] = 1;
                self::$return['message'] = '账册调整接收回执：队列处理成功';
            } catch (Exception $e) {
               throw new Exception($e->getMessage());
            }
        } else{
            throw new Exception($formId.'接收回执与系统数据不符');
        }
    }
}
