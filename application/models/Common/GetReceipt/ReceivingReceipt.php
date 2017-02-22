<?php

class ReceivingReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    //海关接收回执状态变化
    private static $hgreceiveStatus = array(
        'fromStatus'=>4,
        'toStatus'=> 5,
    );
    //海关审核回执状态变化
    private static $hgcheckStatus = array(
        'fromStatus'=>5,
        'toStatus'=> 6,
        'notpassStatus'=>7
    );
	//海关实增回执
    private static $hgcheckStatusAdd = array(
        'fromStatus'=>6,
        'toStatus'=> 8,
    );
	private static $statusArray = array(
        '01'=>'已处理',
        '02'=> '退单',
		'03'=> '审核通过',
		'04'=> '审核不通过',
		'05'=> '已作废',
		'06'=> '可过闸',
		'07'=> '暂停',
		'08'=> '终止使用',
		'10'=> '已实增/扣',
    );

    public static function receive(array $bodyRow, array $headRow)
    {
        $time = date('Y-m-d H:i:s',time());
        $row = Service_Receiving::getByField($bodyRow['form_id'],'receiving_code');
        $fromStatus = self::$hgreceiveStatus['fromStatus'];
        $toStatus = self::$hgreceiveStatus['toStatus'];
		$customsStatus = 2;
        if(!empty($row) && $row['receiving_status'] == $fromStatus){
            try {
                if('01' != $bodyRow['feedback_flag']){
                    $toStatus = self::$hgcheckStatus['notpassStatus'];
					$customsStatus = 5;
                }
				$updateRow = array(
					'receiving_status'=>$toStatus,
					'customs_status'=>$customsStatus,
					'receiving_update_time'=>date('Y-m-d H:i:s'),
				);
				if(!Service_Receiving::update($updateRow,$row['receiving_id'])){
					throw new Exception("入库单[{$row['receiving_code']}]更新失败");
				}
				$ASNLog = array(
					'receiving_id'=>$row['receiving_id'],
					'receiving_code' => $row['receiving_code'],
					'user_id'=>'-1',
					'rl_type'=>1,
					'rl_status_from'=>$fromStatus,
					'rl_status_to'=>$toStatus,
					'rl_note' => $bodyRow['feedback_mess'],
					'rl_add_time'=>$time,
				);
				if(!Service_ReceivingLog::add($ASNLog)){
					throw new Exception("入库单[{$row['receiving_code']}]日志添加失败");
				}
                self::$return['ask'] = 1;
                self::$return['message'] = "入库单[{$row['receiving_code']}]接收队列处理成功";
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
        $row = Service_Receiving::getByField($formId,'receiving_code');
        $fromStatus = self::$hgcheckStatus['fromStatus'];
        $toStatus = self::$hgcheckStatus['toStatus'];
        $notpassStatus = self::$hgcheckStatus['notpassStatus'];
		$customsStatus = 3;
        if(!empty($row) && $row['receiving_status'] == $fromStatus){
            try {
				//审核通过
                if('01' != $bodyRow['feedback_flag']){
                    $toStatus = $notpassStatus;
					$customsStatus = 5;
                }
                $updateRow = array(
					'receiving_status'=>$toStatus,
					'customs_status'=>$customsStatus,
					'receiving_update_time'=>date('Y-m-d H:i:s'),
				);
				if(!Service_Receiving::update($updateRow,$row['receiving_id'])){
					throw new Exception("入库单[{$row['receiving_code']}]更新失败");
				}
				//添加日志
				$ASNLog = array(
					'receiving_id'=>$row['receiving_id'],
					'receiving_code' => $row['receiving_code'],
					'user_id'=>'-1',
					'rl_type'=>1,
					'rl_status_from'=>$fromStatus,
					'rl_status_to'=>$toStatus,
					'rl_note' => $bodyRow['feedback_mess'],
					'rl_add_time'=>$time,
				);
				if(!Service_ReceivingLog::add($ASNLog)){
					throw new Exception("入库单[{$row['receiving_code']}]日志添加失败");
				}
                self::$return['ask'] = 1;
                self::$return['message'] = "入库单[{$row['receiving_code']}]接收回执：队列处理成功";
            } catch (Exception $e) {
               throw new Exception($e->getMessage());
            }
        } else{
            throw new Exception($formId.'接收回执与系统数据不符');
        }
    }
	
	 public static function receiveCheckAdd(array $bodyRow, array $headRow){

        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];
        $row = Service_Receiving::getByField($formId,'receiving_code');
        $fromStatus = self::$hgcheckStatusAdd['fromStatus'];
        $toStatus = $row['receiving_status'];
        $notpassStatus = self::$hgcheckStatus['notpassStatus'];
		$customsStatus = 4;
        if(!empty($row) && $row['receiving_status'] == $fromStatus){
            try {
				//审核通过
                if(isset($bodyRow['feedback_flag']) && '03' == $bodyRow['feedback_flag']){
					if(4 == $row['ciq_status']){
						$toStatus = self::$hgcheckStatusAdd['toStatus'];
						$productInventoryProcess  = new Service_ProductInventoryProcess();
						$receivingDetail = Service_ReceivingDetail::getByCondition(array('receiving_code'=>$row['receiving_code']));
						foreach($receivingDetail as $key=>$val){
							$updatParam	= array(
								'goodsId'			=> $val['goods_id'],
								'quantity'			=> $val['g_qty'],
								'operationType'		=> 1,
								'warehouseCode'		=> $row['warehouse_code'],
								'owner_code'		=> $row['owner_code'],
								'cus_goods_id'		=> $val['cus_goods_id'],
								'ieType'			=> $row['ie_flag'],
								'code_ts'			=> $val['code_ts'],
								'g_name_cn'			=> $val['g_name_cn'],
								'hs_name'			=> $val['hs_name'],
								'g_name_en'			=> $val['g_name_en'],
								'stock_unit'		=> $val['g_unit'],
								'curr'				=> $val['curr'],
								'origin_country'	=> $val['origin_country'],
								'g_model'			=> $val['g_model'],
								'unit_1'			=> $val['unit_1'],
								'qty_1'				=> $val['qty_1'],
								'unit_2'			=> $val['unit_2'],
								'qty_2'				=> $val['qty_2'],
								'duty_mode'			=> $val['duty_mode'],
								'use_to'			=> $val['use_to'],
								'decl_price'		=> $val['decl_price'],
							);
							$inventoryState = $productInventoryProcess->update($updatParam);
							if(1 != @$inventoryState['state']){
								throw new Exception($row['receiving_code'].':'.$val['goods_id'].'料件级库存更新失败');
							}
						}
						$receivingDetailMerge	= Service_ReceivingDetailMerge::getByCondition(array('receiving_code'=>$row['receiving_code']));
						$receivingInventoryProcess  = new Service_ReceivingInventoryProcess();
						foreach($receivingDetailMerge as $key=>$val){
							$uParam	= array(
								'quantity'		=> $val['g_qty'],
								'operationType'	=> 1,
								'warehouseCode'	=> $row['warehouse_code'],
								'code_ts'		=> $val['code_ts'],
								'g_name_cn'		=> $val['g_name_cn'],
								'hs_name'		=> $val['hs_name'],
								'g_name_en'		=> $val['g_name_en'],
								'stock_unit'	=> $val['g_unit'],
								'curr'			=> $val['curr'],
								'receiving_code'=> $row['receiving_code'],
								'receiving_id'	=> $row['receiving_id'],
								'merge_g_no'	=> $val['g_no'],
								'qty_1'			=> $val['qty_1'],
								'qty_2'			=> $val['qty_2'],
								'unit_1'		=> $val['unit_1'],
								'unit_2'		=> $val['unit_2'],
							);
							$receivingInventoryState = $receivingInventoryProcess->update($uParam);
							if(1 != @$receivingInventoryState['state']){
								throw new Exception($row['receiving_code'].':'.$val['g_no'].'项号级库存更新失败');
							}
						}
					}
                }else{
					$toStatus = $notpassStatus;
					$customsStatus = 5;
				}
				$updateRow = array(
					'receiving_status'=>$toStatus,
					'customs_status'=>$customsStatus,
					'receiving_update_time'=>date('Y-m-d H:i:s'),
				);
				if(!Service_Receiving::update($updateRow,$row['receiving_id'])){
					throw new Exception('入库单更新失败');
				}
				//添加日志
				$ASNLog = array(
					'receiving_id'=>$row['receiving_id'],
					'receiving_code' => $row['receiving_code'],
					'user_id'=>'-1',
					'rl_type'=>1,
					'rl_status_from'=>$fromStatus,
					'rl_status_to'=>$toStatus,
					'rl_note' => $bodyRow['feedback_mess'],
					'rl_add_time'=>$time,
				);
				if(!Service_ReceivingLog::add($ASNLog)){
					throw new Exception('入库单日志添加失败');
				}
                self::$return['ask'] = 1;
                self::$return['message'] = '入库单回执：队列处理成功';
            } catch (Exception $e) {
				throw new Exception($e->getMessage());
            }
        } else{
			throw new Exception($formId.'接收回执与系统数据不符');
        }
    }
}
