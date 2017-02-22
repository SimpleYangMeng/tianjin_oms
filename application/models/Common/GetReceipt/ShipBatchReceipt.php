<?php

class ShipBatchReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    //海关接收回执状态变化
    private static $hgreceiveStatus = array(
        'fromStatus'=>3,
        'toStatus'=> 4,
    );
    //海关审核回执状态变化
    private static $hgcheckStatus = array(
        'fromStatus'=>4,
        'toStatus'=> 5,
        'notpassStatus'=>7,
    );
	
    private static $hgcheckPassStatus = array(
        'fromStatus'=>5,
        'toStatus'=> 6,
        'notpassStatus'=>7,
    );

    public static function receive(array $bodyRow, array $headRow)
    {
        $time = date('Y-m-d H:i:s',time());
		$formId = $bodyRow['form_id'];
        $row = Service_ShipBatch::getByField($bodyRow['form_id'],'sb_code');
        $fromStatus = self::$hgreceiveStatus['fromStatus'];
        $toStatus = self::$hgreceiveStatus['toStatus'];
		$notpassStatus = self::$hgcheckStatus['notpassStatus'];
        if(!empty($row) && ($row['status'] == $fromStatus || $row['status'] == $toStatus)){
            try {
                if('01' == $bodyRow['feedback_flag']){
                    $status = $toStatus;
                }else if('07' == $bodyRow['feedback_flag']){
					$status	= 1;
					self::dealWithFailure($formId);
				}else{
					$status = $notpassStatus;
					self::dealWithFailure($formId);
				}
				$updateRow = array(
					'status'=>$status,
					'sb_update_time'=>date('Y-m-d H:i:s'),
				);
				if(!Service_ShipBatch::update($updateRow,$row['sb_id'])){
					throw new Exception('载货单更新失败');
				}
				$shipBatchLogRow = array(
					'sb_id'         	=> $row['sb_id'],
					'sb_code'       	=> $row['sb_code'],
					'user_id'       	=> '-1',
					'sbl_note'      	=> $bodyRow['feedback_mess'],
					'sbl_add_time'  	=> date("Y-m-d H:i:s"),
					'sbl_status_from'	=> $fromStatus,
					'sbl_status_to'		=> $status,
				);
				if(!Service_ShipBatchLog::add($shipBatchLogRow)){
					throw new Exception('出仓单创建日志异常', 500);
				}
                self::$return['ask'] = 1;
                self::$return['message'] = '出仓库单接收队列处理成功！';
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        } else{
            throw new Exception('操作有误');
        }
        return self::$return;
    }
	
    public static function receiveCheck(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];
        $row = Service_ShipBatch::getByField($formId,'sb_code');
        $fromStatus = self::$hgcheckStatus['fromStatus'];
        $toStatus = self::$hgcheckStatus['toStatus'];
        $notpassStatus = self::$hgcheckStatus['notpassStatus'];
        if(!empty($row) && $row['status'] == $fromStatus){
            try {
				if(isset($bodyRow['feedback_flag']) && '01' == $bodyRow['feedback_flag']){
					$status	= self::$hgcheckStatus['toStatus'];
				}else{
					$status	= self::$hgcheckStatus['notpassStatus'];
					self::dealWithFailure($formId);
				}
				$updateRow = array(
					'status'=>$status,
					'sb_update_time'=>date('Y-m-d H:i:s'),
				);
				//辅助系统载货单号
				if(!empty($bodyRow['add_field'])){
					$updateRow['fzxt_code'] = $bodyRow['add_field'];
				}
				if(!Service_ShipBatch::update($updateRow,$row['sb_id'])){
					throw new Exception('载货单更新失败');
				}
				$shipBatchLogRow = array(
					'sb_id'         	=> $row['sb_id'],
					'sb_code'       	=> $row['sb_code'],
					'user_id'       	=> '-1',
					'sbl_note'      	=> $bodyRow['feedback_mess'],
					'sbl_add_time'  	=> date("Y-m-d H:i:s"),
					'sbl_status_from'	=> $fromStatus,
					'sbl_status_to'		=> $status,
				);
				if(!Service_ShipBatchLog::add($shipBatchLogRow)){
					throw new Exception('出仓单创建日志异常', 500);
				}
                self::$return['ask'] = 1;
                self::$return['message'] = '载货单接收回执：队列处理成功';
            } catch (Exception $e) {
				throw new Exception($e->getMessage());
            }
        } else{
            throw new Exception($formId.'接收回执与系统数据不符');
        }
    }
	
	public static function receiveCheckPass(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];
        $row = Service_ShipBatch::getByField($formId,'sb_code');
        $fromStatus = self::$hgcheckPassStatus['fromStatus'];
        $toStatus = self::$hgcheckPassStatus['toStatus'];
        $notpassStatus = self::$hgcheckPassStatus['notpassStatus'];
        if(!empty($row) && $row['status'] == $fromStatus){
            try {
				if(isset($bodyRow['feedback_flag']) && '01' == $bodyRow['feedback_flag']){
					$status	= $toStatus;
					$ieFlag = 'I';
					$productInventoryProcess  = new Service_ProductInventoryProcess();
					$shipBatchOrder = Service_ShipBatchOrder::getByCondition(array('sb_code'=>$formId));
					$condition	=	 array(
						'customer_code'		=> $row['customer_code'],
						'warehouse_status'	=> '5',
						'ie_type'			=> $row['ie_type'],
					);
					$warehouseInfo		= Service_Warehouse::getByCondition($condition);
					if(empty($warehouseInfo)){
						throw new Exception($formId.'未找到对应账册');
					}
					foreach($shipBatchOrder as $key=>$val){
						$personItemInfo	= Service_PersonItem::getByField($val['form_id'],'pim_code');
						$personItemProduct = Service_PersonItemProduct::getByCondition(array('pim_code'=>$personItemInfo['pim_code']));
						foreach($personItemProduct as $k=>$v){
							$updatParam	= array(
								'goodsId'		=> $v['goods_id'],
								'quantity'		=> $v['g_qty'],
								'operationType'	=> 4,
								'warehouseCode'	=> $warehouseInfo[0]['warehouse_code'],
								'ieType'		=> $ieFlag,
								'owner_code'	=> $personItemInfo['customer_code'],
								'cus_goods_id'	=> $v['registerID'],
								'code_ts'		=> $v['hs_code'],
								'g_name_cn'		=> $v['g_name_cn'],
								'g_name_en'		=> '',
								'stock_unit'	=> $v['g_uint'],
								'curr'			=> $v['curr'],
								'origin_country'=> $v['country'],
								'g_model'		=> $v['g_model'],
							);
							$inventoryState = $productInventoryProcess->update($updatParam);
							if(1 != @$inventoryState['state']){
								throw new Exception($v['goods_id'].'库存更新失败');
							}
						}
					}
					$shipBatchProduct	= Service_ShipBatchProduct::getByCondition(array('sb_code'=>$formId));
					foreach($shipBatchProduct as $key=>$val){
						$uParam	= array(
							'quantity'		=> $val['g_qty'],
							'operationType'	=> 4,
							'warehouseCode'	=> $warehouseInfo[0]['warehouse_code'],
							'code_ts'		=> $val['code_ts'],
							'g_name_cn'		=> $val['g_name_cn'],
							'g_name_en'		=> $val['g_name_en'],
							'stock_unit'	=> $val['g_unit'],
							'curr'			=> $val['curr'],
							'receiving_code'=> $val['form_id'],
							'merge_g_no'	=> $val['g_no'],
							'qty_1'			=> $val['qty_1'],
							'unit_1'		=> $val['unit_1'],
							'qty_2'			=> $val['qty_2'],
							'unit_2'		=> $val['unit_2'],
						);
						$receivingInventoryProcess	= new Service_ReceivingInventoryProcess();
						$receivingInventoryState = $receivingInventoryProcess->update($uParam);
						if(1 != @$receivingInventoryState['state']){
							throw new Exception($val['form_id'].':'.$val['g_no'].'项号级库存更新失败');
						}
					}
				}else{
					$status	= $notpassStatus;
					self::dealWithFailure($formId);
				}
				$updateRow = array(
					'status'=>$status,
					'sb_update_time'=>date('Y-m-d H:i:s'),
				);
				if(!Service_ShipBatch::update($updateRow,$row['sb_id'])){
					throw new Exception('载货单更新失败');
				}
				$shipBatchLogRow = array(
					'sb_id'         	=> $row['sb_id'],
					'sb_code'       	=> $row['sb_code'],
					'user_id'       	=> '-1',
					'sbl_note'      	=> $bodyRow['feedback_mess'],
					'sbl_add_time'  	=> date("Y-m-d H:i:s"),
					'sbl_status_from'	=> $fromStatus,
					'sbl_status_to'		=> $status,
				);
				if(!Service_ShipBatchLog::add($shipBatchLogRow)){
					throw new Exception('出仓单创建日志异常', 500);
				}
                self::$return['ask'] = 1;
                self::$return['message'] = '载货单接收回执：队列处理成功';
            } catch (Exception $e) {
				throw new Exception($e->getMessage());
            }
        } else{
            throw new Exception($formId.'接收回执与系统数据不符');
        }
    }
	
	public static function dealWithFailure($sbCode)
	{
		$row = Service_ShipBatch::getByField($sbCode,'sb_code');
		$shipBatchProduct	= Service_ShipBatchProduct::getByCondition(array('sb_code'=>$sbCode));
		$condition	=	 array(
			'customer_code'		=> $row['customer_code'],
			'warehouse_status'	=> '5',
			'ie_type'			=> $row['ie_type'],
		);
		$warehouseInfo		= Service_Warehouse::getByCondition($condition);
		if(empty($warehouseInfo)){
			throw new Exception($sbCode.'未找到对应账册');
		}
		foreach($shipBatchProduct as $key=>$val){
			$uParam	= array(
				'quantity'		=> $val['g_qty'],
				'operationType'	=> 3,
				'warehouseCode'	=> $warehouseInfo[0]['warehouse_code'],
				'code_ts'		=> $val['code_ts'],
				'g_name_cn'		=> $val['g_name_cn'],
				'g_name_en'		=> $val['g_name_en'],
				'stock_unit'	=> $val['g_unit'],
				'curr'			=> $val['curr'],
				'receiving_code'=> $val['form_id'],
				'merge_g_no'	=> $val['g_no'],
				'qty_1'			=> $val['qty_1'],
				'unit_1'		=> $val['unit_1'],
				'qty_2'			=> $val['qty_2'],
				'unit_2'		=> $val['unit_2'],
			);
			$receivingInventoryProcess	= new Service_ReceivingInventoryProcess();
			$receivingInventoryState = $receivingInventoryProcess->update($uParam);
			if(1 != @$receivingInventoryState['state']){
				throw new Exception($val['form_id'].':'.$val['g_no'].'项号级库存更新失败');
			}
		}
		$shipBatchOrder = Service_ShipBatchOrder::getByCondition(array('sb_code'=>$sbCode));
		foreach($shipBatchOrder as $key=>$val){
			$personItemInfo	= Service_PersonItem::getByField($val['form_id'],'pim_code');
			if(!Service_PersonItem::update(array('status'=>6,'customs_status'=>6),$personItemInfo['pim_id'])){
				throw new Exception('个人物品清单['. $val['form_id'].']状态更新失败');
			}
			$personItemLog	= array(
				'pim_id'=>$personItemInfo['pim_id'],
				'pim_code'=>$personItemInfo['pim_code'],
				'pim_status_from'=>9,
				'pim_status_to'=>6,
				'pil_add_time'=>date("Y-m-d H:i:s"),
				'user_id'=>-1,
				'pil_ip'=>Common_Common::getIP(),
				'account_name'=>'System',
				'pil_comments'=>'撤销关联载货单',
			);
			if(!Service_PersonItemLog::add($personItemLog)){
				throw new Exception('个人物品清单['. $personItemInfo['pim_code'].']日志创建失败');
			}
		}
		return true;
	}
}