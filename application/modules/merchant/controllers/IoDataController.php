<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-11-4
 * Time: 下午8:33
 * To change this template use File | Settings | File Templates.
 */
class Merchant_IoDataController extends Ec_Controller_Action
{
    public function preDispatch ()
    {
        $this->tplDirectory = "merchant/views/io/";
        // $this->tplDirectory = "merchant/account_config/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }

    public function listAction(){
        $page = $this->_request->getParam('page', 1);
        $pageSize = $this->_request->getParam('pageSize', 20);

        $page = $page ? $page : 1;
        $pageSize = $pageSize ? $pageSize : 20;
        $time_start = $this->_request->getParam("time_start","");
        $time_end = $this->_request->getParam("time_end","");
        $io_type = $this->_request->getParam("io_type","0");

        $customer = $this->_customerAuth;
        $customerId = $customer['id'];

        if($io_type=="1"){
            $condition = array(
                'time_start'=>$time_start,
                'time_end'=>$time_end,
                'order_status_Arr'=>array(11,12,13,14),
                'customer_id'=>$customerId
            );
            $count = Service_OrderProduct::getJoinOrderByCondition($condition,"count(*)");
            if($count){
                $orderProduct = Service_OrderProduct::getJoinOrderByCondition($condition,"*",$pageSize,$page,'op_id desc');
            }
        }else{
            $condition = array(
                'time_start'=>$time_start,
                'time_end'=>$time_end,
                'customer_id'=>$customerId,
                //'receiving_status'=>'7',
                'rd_status'=>'2'
            );
            $count = Service_ReceivingDetail::getJoinReceivingByCondition($condition,"count(*)");
            if($count){
                $orderProduct = Service_ReceivingDetail::getJoinReceivingByCondition($condition,"*",$pageSize,$page,'rd_id desc');
                foreach($orderProduct as $key=>$value){
                    $putawayDetail = Service_PutawayDetail::getByCondition(array('receiving_code'=>$value['receiving_code'],'product_id'=>$value['product_id']),"*");
                    $orderProduct[$key]['pd_putaway_time'] = $putawayDetail[0]['pd_putaway_time'];
                }
            }
        }

        $this->view->count = $count;
        $this->view->pageSize	= $pageSize;
        $this->view->page		= $page;
        $this->view->result = $orderProduct;
        $this->view->condition = $condition;
        $this->view->io_type = $io_type;

        echo Ec::renderTpl($this->tplDirectory . "io-list.tpl",'noleftlayout');
    }

    public function exportAction(){
        require_once APPLICATION_PATH . '/../libs/PHPExcel.php';
        require_once APPLICATION_PATH . '/../libs/PHPExcel/IOFactory.php';
        $type = $this->_request->getParam("export_type","");
        $time_start = $this->_request->getParam("time_start","");
        $time_end = $this->_request->getParam("time_end","");
        if($time_start==""||$time_end==""){
            die("起止时间必须选择");
        }
        $time1 = date("Y-m-d",strtotime("$time_start +1month"));
        $time2 = date("Y-m-d",strtotime("$time1 -1day"));
        $timeSpace1 = strtotime($time2);
        $timeSpaceEnd = strtotime($time_end);
        if($timeSpace1<$timeSpaceEnd){
            die("起止时间间隔最长只能是一个月");
        }

        $customer = $this->_customerAuth;
        $customerId = $customer['id'];
        if($type=="1"){
            $table = new PHPExcel();
            $table->getDefaultStyle()->getFont()->setName('宋体');
            $table->setActiveSheetIndex(0);
            $table->setActiveSheetIndex(0)->setTitle("产品出货情况");
            $objActSheet=$table->setActiveSheetIndex(0);

            $objActSheet->getColumnDimension('A')->setWidth(20);
            $objActSheet->getColumnDimension('B')->setWidth(20);
            $objActSheet->getColumnDimension('C')->setWidth(20);
            $objActSheet->getColumnDimension('D')->setWidth(20);
            $objActSheet->getColumnDimension('E')->setWidth(20);

            $objActSheet->setCellValue('A1','客户代码');
            $objActSheet->setCellValue('B1','订单号');
            $objActSheet->setCellValue("C1","交易订单号");
            $objActSheet->setCellValue("D1","组合产品SKU");
            $objActSheet->setCellValue("E1","子产品SKU");
            $objActSheet->setCellValue("F1","出货数量");
            $objActSheet->setCellValue("G1","出货时间");

            $condition = array(
                'time_start'=>$time_start,
                'time_end'=>$time_end,
                'order_status_Arr'=>array(11,12,13,14),
                'customer_id'=>$customerId
            );
            $count = Service_OrderProduct::getJoinOrderByCondition($condition,"count(*)");
            $pageSize =20;
            $totalPage = ceil($count/$pageSize);
            $index = 2;
            for($page=1;$page<=$totalPage;$page++){
                $orderProduct = Service_OrderProduct::getJoinOrderByCondition($condition,"*",$pageSize,$page,'op_id desc');
                foreach($orderProduct as $key=>$value){
                    $product = Service_Product::getByField($value['product_id'],"product_id","*");
                    if($product['product_type']=="1"){
                        $PCR = Service_ProductCombineRelation::getByCondition(array('product_id'=>$product['product_id']),"*");
                        foreach($PCR as $pk=>$pv){
                            $childProduct = Service_Product::getByField($pv['pcr_product_id'],"product_id","*");
                            $objActSheet->setCellValue('A'.$index,$value['customer_code']);
                            $objActSheet->setCellValue('B'.$index,$value['order_code']);
                            $objActSheet->setCellValueExplicit("C".$index,$value['reference_no'],PHPExcel_Cell_DataType::TYPE_STRING);
                            $objActSheet->setCellValueExplicit("D".$index,$value['product_sku'],PHPExcel_Cell_DataType::TYPE_STRING);
                            $objActSheet->setCellValueExplicit("E".$index,$childProduct['product_sku'],PHPExcel_Cell_DataType::TYPE_STRING);
                            $objActSheet->setCellValue("F".$index,$value['op_quantity']*$pv['pcr_quantity']);
                            $objActSheet->setCellValue("G".$index,$value['ship_time']);
                            $index++;
                        }
                    }else{
                        $objActSheet->setCellValue('A'.$index,$value['customer_code']);
                        $objActSheet->setCellValue('B'.$index,$value['order_code']);
                        $objActSheet->setCellValueExplicit("C".$index,$value['reference_no'],PHPExcel_Cell_DataType::TYPE_STRING);
                        $objActSheet->setCellValueExplicit("D".$index,'',PHPExcel_Cell_DataType::TYPE_STRING);
                        $objActSheet->setCellValueExplicit("E".$index,$value['product_sku'],PHPExcel_Cell_DataType::TYPE_STRING);
                        $objActSheet->setCellValue("F".$index,$value['op_quantity']);
                        $objActSheet->setCellValue("G".$index,$value['ship_time']);
                        $index++;
                    }
                }
            }
            $objWriter = PHPExcel_IOFactory::createWriter($table, 'Excel5');
            header( "Pragma: public" );
            header( "Expires: 0" );
            header("Accept-Ranges: bytes");
            header('cache-control:must-revalidate');
            header("Content-Disposition: attachment; filename=chuku.xls");
            header("Content-Type:APPLICATION/OCTET-STREAM;charset=utf-8");
            $objWriter->save('php://output');
        }else{
            $table = new PHPExcel();
            $table->getDefaultStyle()->getFont()->setName('宋体');
            $table->setActiveSheetIndex(0);
            $table->setActiveSheetIndex(0)->setTitle("产品入库情况");
            $objActSheet=$table->setActiveSheetIndex(0);

            $objActSheet->getColumnDimension('A')->setWidth(20);
            $objActSheet->getColumnDimension('B')->setWidth(20);
            $objActSheet->getColumnDimension('C')->setWidth(20);
            $objActSheet->getColumnDimension('D')->setWidth(20);
            $objActSheet->getColumnDimension('E')->setWidth(20);

            $objActSheet->setCellValue('A1','客户代码');
            $objActSheet->setCellValue('B1','入库单号');
            $objActSheet->setCellValue("C1","客户参考号");
            $objActSheet->setCellValue("D1","产品SKU");
            $objActSheet->setCellValue("E1","入库数量");
            $objActSheet->setCellValue("F1","入库时间");

            $condition = array(
                'time_start'=>$time_start,
                'time_end'=>$time_end,
                'customer_id'=>$customerId,
                //'receiving_status'=>'7',
                'rd_status'=>'2'
            );
            $count = Service_ReceivingDetail::getJoinReceivingByCondition($condition,"count(*)");
            $pageSize =20;
            $totalPage = ceil($count/$pageSize);
            $index = 2;
            for($page=1;$page<=$totalPage;$page++){
                $orderProduct = Service_ReceivingDetail::getJoinReceivingByCondition($condition,"*",$pageSize,$page,'rd_id desc');
                foreach($orderProduct as $key=>$value){
                    $objActSheet->setCellValue('A'.$index,$value['customer_code']);
                    $objActSheet->setCellValueExplicit('B'.$index,$value['receiving_code'],PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("C".$index,$value['reference_no'],PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("D".$index,$value['product_sku'],PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValue("E".$index,$value['rd_putaway_qty']);
                    $putawayDetail = Service_PutawayDetail::getByCondition(array('receiving_code'=>$value['receiving_code'],'product_id'=>$value['product_id']),"*");
                    $objActSheet->setCellValue("F".$index,$putawayDetail[0]['pd_putaway_time']);
                    $index++;
                }
            }
            $objWriter = PHPExcel_IOFactory::createWriter($table, 'Excel5');
            header( "Pragma: public" );
            header( "Expires: 0" );
            header("Accept-Ranges: bytes");
            header('cache-control:must-revalidate');
            header("Content-Disposition: attachment; filename=ruku.xls");
            header("Content-Type:APPLICATION/OCTET-STREAM;charset=utf-8");
            $objWriter->save('php://output');
        }
    }
}
