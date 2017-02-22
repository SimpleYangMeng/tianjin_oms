<?php
/**
*
*/
class ProductCiqQueue
{
    private $status = array(
        'send_before' => -1,
        'send_after' => 1
    );
    //
    private $queueInfo = array(
    	// 100 => RecordCompanies
        'api_code'  =>  'Product',
        'status' =>  0
    );
    
	/**
	 * 开始插入
	 * Enter description here ...
	 */
    public function run()
    {
		$pageInfo = $this->pageInfo();
        if($pageInfo['rowTotal'] == 0){
            return true;
        }
        // print_r($pageInfo);exit;
        //获取要插入的数据
        $minId = 0;
        for ($page=1; $page <= $pageInfo['pageTotal']; $page++) {
            $minId = $this->insertQueue($pageInfo['pageSize'] , $minId);
            if($minId === false){
                break;
            }
        }
    }

	/**
	 * 循环插入
	 * Enter description here ...
	 * @param unknown_type $pageSize
	 * @param unknown_type $minId
	 */
    private function insertQueue($pageSize = Common_CiqQueue::PAGESIZE , $minId = 0)
    {
        $productRows = Service_Product::getByCiqStatus( $this->status['send_before'] , $pageSize , $minId);
        if(empty($productRows)){
            return false;
        }
        $insertQueueRows = array();
        $time = date ( "Y-m-d H:i:s" );;
        //插入api_message
        foreach ($productRows as $key => $product) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $product['product_id'];
            $insertQueueRow['refer_code'] = $product['registerID'];
            $insertQueueRow['ref_cus_code'] = $product['customer_code'];
            $insertQueueRow['add_date'] = $time;
            
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();

            try{
                if(Service_CiqApiMessage::add($insertQueueRow) === false) {
                    throw new Exception('[商品'.$product['registerID'].']插入队列失败');
                }
                $minId = Service_Product::update(array('ciq_status'=>$this->status['send_after']), $product['product_id'], 'product_id');
                if(!$minId){
                    throw new Exception('[商品'.$product['registerID'].']状态更新失败');
                }
                $db->commit();
                Common_CiqQueue::debug('['.$product['registerID'].']插入队列成功');
            }catch(Exception $e){
                 $db->rollback();
                 Common_CiqQueue::debug($e->getMessage());
                 continue;
            }
        }
        return $minId;
    }

    /**
     * 获取分页信息
     * @return [type] [description]
     */
    private function pageInfo()
    {
        $rowTotal = Service_Product::getByCondition(array('ciq_status' => $this->status['send_before']), 'count(*)');
        if($rowTotal == 0){
            return array(
                'rowTotal' => 0
            );
        }
        $pageSize = Common_CiqQueue::PAGESIZE;
        $pageTotal = ceil($rowTotal / $pageSize);
        return array(
            'rowTotal' => $rowTotal,
            'pageSize'  => $pageSize,
            'pageTotal' => $pageTotal
        );
    }
}
