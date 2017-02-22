<?php
/**
* -- simple  
* 货物添加到申报队列
*/
class GoodsListQueue
{

    private $status = array(
        'send_before' => 1,
        'send_after' => 3
    );
    private $queueInfo = array(
        'api_type'  =>  'send',
        'api_name'  =>  '货物清单申报',
        'api_code'  =>  'GoodsList',
        'api_caller'=>  'pingtai',
        'am_status' =>  0
    );

    /**
     * [run description]
     * @return [type] [description]
     */
    public function run()
    {
        $pageInfo = $this->pageInfo();
        if($pageInfo['rowTotal'] == 0){
            return true;
        }
        //获取要插入的数据
        $minId = 0;
        for ($page=1; $page <= $pageInfo['pageTotal']; $page++) {
            $minId = $this->insertQueue($pageInfo['pageSize'] , $minId);
            if($minId === false){
                break;
            }
        }
        
        return true;
    }

    /**
     * [insertQueue 封装插入数据]
     * @param  [type]  $pageSize [description]
     * @param  integer $minId    [description]
     * @return [type]            [description]
     */
    private function insertQueue($pageSize = Common_Queue::PAGESIZE , $minId = 0)
    {
        $goodListData = Service_GoodsList::getByStatus( $this->status['send_before'] , $pageSize , $minId);
        if(empty($goodListData)){
            return false;
        }
        
        $db = Common_Common::getAdapter();
        $db->beginTransaction ();

        $insertQueueRows = array();

        foreach ($goodListData as $key => $goodList) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $goodList['gl_id'];
            $insertQueueRow['refer_code'] = $goodList['gl_code'];
            $insertQueueRow['ref_cus_code'] = $goodList['gl_reference_no'];
            $insertQueueRow['add_date'] = date ( "Y-m-d H:i:s" );

            //修改状态
            $updatePersonItem = Service_GoodsList::update(array(
                'status' => $this->status['send_after'],
                'declare_date' => date('Y-m-d H:i:s')
            ) , $goodList['gl_id']);

            //修改失败，这条先不插入队列
            if($updatePersonItem === false){
               continue;
            }

            //队列日志记录
            $goodListLogRow = array(
                    'gl_id' => $goodList['gl_id'],
                    'gl_code' => $goodList['gl_code'],
                    'gl_status_from' => $this->status['send_before'],
                    'gl_status_to' => $this->status['send_after'],
                    'gll_ip' => Common_Common::getIP(),
                    'gll_comments' => '插入队列,待发送海关',
                    'user_id'=>0
            );
            
            if(Service_GoodsListLog::add($goodListLogRow) === false){
                Common_Queue::debug('['.$goodList['gl_code'].']插入队列失败！');
                $db->rollback ();
                continue;
            }
            $insertQueueRows[] = $insertQueueRow;
            $minId = $goodList['gl_id'];
        }
        $insertData = Common_Queue::insertBatch($insertQueueRows);
        $sql = "INSERT INTO `". Common_Queue::TABLE ."` " . $insertData;
        //插入队列失败
        if($db->query($sql) === false){
            $db->rollback ();
            return $minId;
        }
        $db->commit();
        return $minId;
    }


    /**
     * 获取分页信息
     * @return [type] [description]
     */
    private function pageInfo()
    {
        $rowTotal = Service_GoodsList::getByCondition(array(
            'status' => 1
        ) , 'count(*)');

        if($rowTotal == 0){
            return array(
                'rowTotal' => 0
            );
        }

        $pageSize = Common_Queue::PAGESIZE;

        $pageTotal = ceil($rowTotal / $pageSize);

        return array(
            'rowTotal' => $rowTotal,
            'pageSize'  => $pageSize,
            'pageTotal' => $pageTotal
        );
    }
}
