<?php
/**
 * @todo 用于处理支付单接收回执
 * @author event
 */
class PayOrderReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    //01已入库 02入库失败
    //商检接收回执状态变化
    private static $sjreceiveStatus = array(
        //审核通过
        'success' => array(
            'fromStatus' => array('3', '4', '6'),
            'toStatus' => '5'
        ),
        //审核不通过
        'nopass' => array(
            'fromStatus' => array('3', '4', '6'),
            'toStatus' => '6'
        ),
    );

    /**
     * @todo 支付单接收回执
     */
    public static function recordCompaniesReceive(array $bodyRow, array $headRow)
    {
    	$apiMessage = Service_CiqApiMessage::getByField($bodyRow['from_id']);
        if(empty($apiMessage)){
            throw new Exception("队列消息体{$bodyRow['from_id']}不存在");
        }

        //获取支付单信息
        $payOrderData = Service_PayOrder::getByFieldLock($bodyRow['receipt_no'], 'po_id',array('po_id','ciq_status','po_code'));

        if(empty($payOrderData)){
            throw new Exception("支付单[{$bodyRow['receipt_no']}]不存在");
        }

        /**
        * 01已入库
        * 02入库失败(报文格式错误、必填项不满足)
		*/
        switch(trim($bodyRow['msg_code'])){
			//已入库
        	case '01':
		        $fromStatus = self::$sjreceiveStatus['success']['fromStatus'];
		        $toStatus = self::$sjreceiveStatus['success']['toStatus'];
        		self::PayOrderChange($fromStatus,$toStatus,$payOrderData,$bodyRow);
        		break;
        	//入库失败
        	case '02':
        		$fromStatus = self::$sjreceiveStatus['nopass']['fromStatus'];
                $toStatus = self::$sjreceiveStatus['nopass']['toStatus'];
                self::PayOrderChange($fromStatus,$toStatus,$payOrderData,$bodyRow);
        		break;
        	default:
        		break;
        }
    }

    public  function PayOrderChange($fromStatus, $toStatus, $payOrderData, $bodyRow)
    {
        $time = date('Y-m-d H:i:s',time());
        if(in_array($payOrderData['ciq_status'], $fromStatus)){
            //更改状态
            $payOrderUpdateData = array(
                'ciq_status' => $toStatus,
                'update_time' => $time
            );
            // print_r($bodyRow['receipt_no']);exit;
            if(Service_PayOrder::update($payOrderUpdateData, $bodyRow['receipt_no']) === false){
                throw new Exception('支付单备案状态更新失败');
            }

            //支付单日志记录
            $payOrderLogRow = array(
                    'po_id' => $payOrderData['po_id'],
                    'po_code' => $payOrderData['po_code'],
                    'status_type'=>'2',
                    'ciq_status_from' => $payOrderData['ciq_status'],
                    'ciq_status_to' => $toStatus,
                    'pl_ip' => Common_Common::getIP(),
                    'pl_comments' => '更新ciq_status为'.$toStatus.',商检支付单入库',
                    'user_id'=>0,
                    'account_name' => 'system',
                    'pl_status_from' => $payOrderData['app_status'],
                    'pl_status_to' => $payOrderData['app_status'],
            );

            if(Service_PayOrderLog::add($payOrderLogRow) === false){
                throw new Exception('添加支付单修改日志更新失败');
            }

        }else {
            throw new Exception('该支付单状态未到[已发送商检]流程!');
        }
    }


}
