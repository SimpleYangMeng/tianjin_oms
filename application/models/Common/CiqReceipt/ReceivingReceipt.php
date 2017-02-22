<?php

class ReceivingReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
	private static $sjreceiveStatus = array(
		//商检已接受 -- 暂无用
			'bkStatus' => array(
					'fromStatus' => array('1'),
					'toStatus' => '6',
			),
	);
	
    public static function ReceivingReceive(array $bodyRow, array $headRow)
    {
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['from_id'];//ciq_api_message主键
        $apiMessage = Service_CiqApiMessage::getByField($formId);

        if(empty($apiMessage)){
			throw new Exception("队列消息体{$formId}不存在");
        }
        $row = Service_Receiving::getByField($apiMessage['ref_id']); //入库单信息
		$receivingStatus = $row['receiving_status'];
		if(8 != $row['receiving_status']){
			if(4 == $row['customs_status'] && in_array($bodyRow['msg_code'],array('4'))){
				$receivingStatus = 8;
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
						'g_name_en'		=> $val['g_name_en'],
						'hs_name'		=> $val['hs_name'],
						'stock_unit'	=> $val['g_unit'],
						'curr'			=> $val['curr'],
						'receiving_code'=> $row['receiving_code'],
						'receiving_id'	=> $row['receiving_id'],
						'merge_g_no'	=> $val['g_no'],
						'qty_1'			=> $val['qty_1'],
						'unit_1'		=> $val['unit_1'],
						'qty_2'			=> $val['qty_2'],
						'unit_2'		=> $val['unit_2'],
					);
					$receivingInventoryState = $receivingInventoryProcess->update($uParam);
					if(1 != @$receivingInventoryState['state']){
						throw new Exception($row['receiving_code'].':'.$val['g_no'].'项号级库存更新失败');
					}
				}
			}
			if(4 != $row['ciq_status']){
				if($bodyRow['msg_code']=='9'){
					$receivingStatus = '7';
				}
				$updateRow = array(
					'receiving_status'=>$receivingStatus,
					'ciq_status'=>$bodyRow['msg_code'],
					'receiving_update_time'=>$time,
					'ciq_reject_reason'=>'',
				);
				if($bodyRow['msg_code']=='9' || $bodyRow['msg_code'] == '3'){
					$updateRow['ciq_reject_reason'] = $bodyRow['msg_name'];
				}
				if(!Service_Receiving::update($updateRow,$row['receiving_id'])){
					throw new Exception('入库单更新失败');
				}
				$ASNLog = array(
					'receiving_id'=>$row['receiving_id'],
					'receiving_code' => $row['receiving_code'],
					'user_id'=>'-1',
					'rl_type'=>1,
					'rl_status_from'=>$row['receiving_status'],
					'rl_status_to'=>$receivingStatus,
					'rl_note' => $bodyRow['msg_name'],
					'rl_add_time'=>$time,
				);
				if(!Service_ReceivingLog::add($ASNLog)){
					throw new Exception('入库单日志添加失败');
				}
			}
		}
		self::$return['ask'] = 1;
		self::$return['message'] = '入库单接收回执：队列处理成功！';
        return self::$return;
    }
    //查验
	public static function ReceivingBk(array $bodyRow, array $headRow){
		$time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['from_id'];//ciq_api_message主键
        $apiMessage = Service_CiqApiMessage::getByField($formId);

        if(empty($apiMessage)){
			throw new Exception("队列消息体{$formId}不存在");
        }
		$row = Service_Receiving::getByField($apiMessage['ref_id']); //入库单信息
		if(empty($row)){
			throw new Exception($bodyRow['receipt_no'].'未找到入区单数据');
		}
		$receivingStatus = $row['receiving_status'];
		$updateRow = array(
			'check'=>$bodyRow['msg_code'],
			'receiving_update_time'=>$time,
		);
		if(!Service_Receiving::update($updateRow,$row['receiving_id'])){
			throw new Exception('入库单更新失败');
		}
		$ASNLog = array(
			'receiving_id'=>$row['receiving_id'],
			'receiving_code' => $row['receiving_code'],
			'user_id'=>'-1',
			'rl_type'=>1,
			'rl_status_from'=>$row['receiving_status'],
			'rl_status_to'=>$row['receiving_status'],
			'rl_note' => $bodyRow['msg_name'],
			'rl_add_time'=>$time,
		);
		if(!Service_ReceivingLog::add($ASNLog)){
			throw new Exception('入库单日志添加失败');
		}
		self::$return['ask'] = 1;
		self::$return['message'] = '入库单接收回执：队列处理成功！';
		return self::$return;
	}
	
	//检疫
	public static function ReceivingQuarantine(array $bodyRow, array $headRow){
		$time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['from_id'];//ciq_api_message主键
        $apiMessage = Service_CiqApiMessage::getByField($formId);

        if(empty($apiMessage)){
			throw new Exception("队列消息体{$formId}不存在");
        }
		$row = Service_Receiving::getByField($apiMessage['ref_id']); //入库单信息
		$receivingStatus = $row['receiving_status'];
		$updateRow = array(
			'quarantine'=>$bodyRow['msg_code'],
			'receiving_update_time'=>$time,
		);
		if(!Service_Receiving::update($updateRow,$row['receiving_id'])){
			throw new Exception('入库单更新失败');
		}
		$ASNLog = array(
			'receiving_id'=>$row['receiving_id'],
			'receiving_code' => $row['receiving_code'],
			'user_id'=>'-1',
			'rl_type'=>1,
			'rl_status_from'=>$row['receiving_status'],
			'rl_status_to'=>$row['receiving_status'],
			'rl_note' => $bodyRow['msg_name'],
			'rl_add_time'=>$time,
		);
		if(!Service_ReceivingLog::add($ASNLog)){
			throw new Exception('入库单日志添加失败');
		}
		self::$return['ask'] = 1;
		self::$return['message'] = '入库单接收回执：队列处理成功！';
		return self::$return;
	}
	
	public static function ReceivingQrReceive(array $bodyRow, array $headRow)
	{
		$time = date('Y-m-d H:i:s',time());
		$xml = file_get_contents($headRow['file_path']);
		$xmlObj = simplexml_load_string($xml);
		$xmlData = Common_Message::analyzeResult($xmlObj);
		$bodyRow	= $xmlData['MessageBody']['IIQRDocument']['IIQRHead'];
        $row = Service_Receiving::getByField($bodyRow['DECL_NO'],'receiving_code');
		if(empty($row)){
            throw new Exception($bodyRow['DECL_NO'].'未找到对应入库单');
        }
		$aParam	= array(
			'rd_id'				=> $bodyRow['GOODS_CODE'],
			'receiving_code'	=> $bodyRow['DECL_NO'],
			'seq_no'			=> $bodyRow['QRCODE_NO'],
			'qr_code'			=> $bodyRow['QRCODE'],
		);
		if(!Service_ReceivingDetailQrcode::add($aParam)){
			throw new Exception('二维码信息添加失败');
		}
		self::$return['ask'] = 1;
		self::$return['message'] = '二维码接收回执处理成功！';
        return self::$return;
	}
}
