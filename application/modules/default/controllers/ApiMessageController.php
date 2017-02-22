<?php

class Default_ApiMessageController extends Ec_Controller_DefaultAction
{

    public function preDispatch()
    {
        $this->view->errMsg = '';
        $this->tplDirectory = "default/views/default/";
    }

    /**
     * @todo 生成报文
     */
    public function productCreateAction(){
        echo 'product test';

        $value='product';

        $object = Common_SendMessage::getInstance($value);

        //发送报文
        $result = $object->sendMessage();
        var_dump($result);
        //获取回执
        // $object->getReceipt();

    }
    /**
     * @todo 物品清单生成发送报文
     */
    public function personAction(){
        echo 'person';
        $value='PersonItem';
        echo $value;
        //exit;

        $object = Common_SendMessage::getInstance($value);

        //发送报文
        $result = $object->sendMessage();
        var_dump($result);
        //获取回执
        // $object->getReceipt();
    }
    /**
     * @todo 用于插入商品队列
     */
    public function productqueueAction(){
        $value = 'Product';
        $queue = Common_Queue::getInstance($value);
        $queue->run();
        var_dump($queue);
        exit('00011');
        //$queue->run();
    }
    public function personqueueAction(){
        $value = 'PersonItem';
        $queue = Common_Queue::getInstance($value);
        $queue->run();
        var_dump($queue);
        exit('00011');
        //$queue->run();
    }
    /**
     * @todo 商品接收回执
     */
    public function productReceiveAction(){
        $type = 'BAR006';
        $obj = Common_GetReceipt::getInstance($type);
        //$obj->run();
        echo 'receive';
    }
    /**
     * @todo 商品审核回执
     */
    public function productcheckAction(){
        echo 'sh';
        $type = 'BAR008';
        $obj = Common_GetReceipt::getInstance($type);
        //var_dump($obj);
        //$obj->run('ProductReceipt::productReceive');
    }
    /**
     * @todo 物品清单接收回执
     */
    public function personReceiveAction(){
        echo 'sss';
        $type = 'BUR006';
        $obj = Common_GetReceipt::getInstance($type);
        echo 'over';
        //$obj->run();
    }
    /**
     * @todo 物品清单审核
     */
    public function personCheckAction(){
        echo 'sssss';
        $type = 'BUR008';
        $obj=Common_GetReceipt::getInstance($type);
        //$obj->run();
    }

    /**
     * @todo 物品清单布控
     */
    public function personbkAction(){
        $type = 'BKK001';
        $obj=Common_GetReceipt::getInstance($type);
    }

    /**
     * @todo 物品清单解控
     */
    public function personjkAction(){
        $type = 'BKK002';
        $obj=Common_GetReceipt::getInstance($type);
    }



}
