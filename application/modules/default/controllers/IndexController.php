<?php

class Default_IndexController extends Ec_Controller_DefaultAction
{

    public function preDispatch()
    {
        $this->view->errMsg = '';
        $this->tplDirectory = "default/views/default/";
    }

    public function indexAction()
    {
        $this->_redirect('/login');
        exit;
        $wh              = Service_Warehouse::getAll();
        $this->view->msg = 'www.oms.com';
                                                                         // echo $this->view->render($this->tplDirectory . 'index.tpl');//不使用布局文件
        echo Ec::renderTpl($this->tplDirectory . "index.tpl", 'layout'); //使用布局文件
    }

    public function loginAction()
    {
        die('login');
    }

    public function logoutAction()
    {
        $session = new Zend_Session_Namespace('customerAuth');
        $session->unsetAll();
        session_destroy();
    }

    /*
     * @输出验证码
     */
    public function verifyCodeAction()
    {
        $verifyCode = new Common_Verifycode();
        $verifyCode->set_sess_name('AdminVerifyCode');
        echo $verifyCode->render();
    }
    /**
     * @author william-fan
     * @todo 条码
     */
    public function barcodeAction()
    {
        Common_Barcode::barcode($this->_request->code);
        exit;
    }
    /**
     * author william-fan
     * @todo 用于改变语言
     */
    public function changeLangAction()
    {
        if ($this->_request->isPost()) {
            $langCode = $this->_request->getParam('langCode');
            if ($langCode) {
                $sessionUser       = new Zend_Session_Namespace("userAuthorization");
                $sessionUser->lang = $langCode;
                echo json_encode('1');
                die();
            }
        }

    }
    public function headerInnerAction()
    {
        echo $this->view->render($this->tplDirectory . 'header-inner.tpl');
    }
    public function headerAction()
    {
        //$session            = new Zend_Session_Namespace('RegisterStep');
        //$session->step = '4';
        //$this->view->step = $session->step;
        echo $this->view->render($this->tplDirectory . "header.tpl");
    }

    public function printAction()
    {
        $customerCode = $this->_request->getParam('customerCode', "");
        if (empty($customerCode)) {
            header("Location:/");
            exit;
        }
        $this->view->customerCode = Service_Customer::getByField($customerCode, 'customer_code', '*');
        echo $this->view->render($this->tplDirectory . "print.tpl");
    }

    /* 上传图片查看 */
    public function viewUploadImageAction()
    {
        $fileName     = $this->_request->getParam('fileName', "");
        $customerCode = $this->_request->getParam('customerCode', "");
        $path         = APPLICATION_PATH . "/../data/images/register/" . $customerCode . '/' . $fileName;
        //echo $path;exit;
        if (file_exists($path)) {
            header('Content-Type: image/jpeg');
            echo file_get_contents($path);

        } else {
            header("Location: /images/noimg.jpg");
        }

        exit();
    }
    /*客人LOGO*/
    public function viewLogoImageAction()
    {
        $customerCode = $this->_request->getParam('customerCode', "");
        if (empty($customerCode)) {exit;}
        $customer_array = Service_Customer::getByField($customerCode, 'customer_code');
        $fileName       = $customer_array['customer_logo'];
        $path           = APPLICATION_PATH . "/../data/images/register/" . $customerCode . '/' . $fileName;

        if (file_exists($path)) {
            header('Content-Type: image/jpeg');
            echo file_get_contents($path);

        } else {
            header("Location: /images/noimg.jpg");
        }

        exit();
    }
    /*身份证照片index/view-id-card-*/
    public function viewIdCardAction()
    {
        $fileName = $this->_request->getParam('fileName', "");
        if (!$fileName) {exit;}
        $path = APPLICATION_PATH . "/../data/idcards/" . $fileName;
        if (file_exists($path)) {
            header("Content-Type: image/jpg");
            echo file_get_contents($path);
        } else {
            header("Location: /images/noimg.jpg");
        }
        exit();
    }

    /**
     * @查看产品图片
     * @desc WMS 全站使用
     */
    public function viewProductImgAction()
    {
        $productId = $this->_request->getParam('id', "");
        if ($productId) {
            $productAttach = Service_ProductAttached::getByField($productId, 'product_id');
            if ($productAttach) {
                if ($productAttach['pa_file_type'] == 'link') {
                    header("Location: " . $productAttach['pa_path']);
                    exit();
                }
                if ($productAttach['pa_file_type'] == 'img') {
                    header("Location: http://develop-oms.ez-wms.com/product-image/view-attach/productId/" . $productId);
                    exit();
                }
            }
        }
        header("Location: /images/noimg.jpg");
        exit();
    }
    /**
     * @author luffy丶大叔
     * @todo 显示监管附件图片
     * @param type $param
     */
    public function viewProductSupervisionAttachedAction()
    {
        $psa_id = intval($this->_request->getParam('psa_id', 0));
        if ($psa_id) {
            $row = Service_ProductSupervisionAttached::getByField($psa_id);
            if ($row && $row['fileext'] == '.jpg' && file_exists($row['filepath'])) {
                header("Content-Type: image/jpg");
                echo file_get_contents($row['filepath']);
                exit();
            }
        }
        header("Location: /images/noimg.jpg");
        exit();
    }

    public function testAction()
    {
        header("Content-type:text/xml");
        // $orderProduct = array(
        //     0=> array('productSku'=>'702006234',
        //     'opQuantity'=>3,
        //     'transactionPrice'=>30,
        //     'dealPrice'=>10
        //     )
        // );

        // $orderInfo = array(
        //     'orderModel'=>'0',
        //     'opType'=>'Update',
        //     'logisticCustomerCode'=>'C02421',
        //     'payCustomerCode'=>'C0253',
        //     'storageCustomerCode'=>'C0242',
        //     'warehouseCode'=>'TJGQ-BH',
        //     'oabCounty'=>'CN',
        //     'oabStateName'=>'广东',
        //     'oabCity'=>'深圳',
        //     'remark'=>'test00',
        //     'smCode'=>'STO',
        //     'amount'=>'35',
        //     'referenceNo'=>'20151103002',
        //     'trackingNumber'=>'11100100',
        //     'oabName'=>'令狐冲f',
        //     'oabCompany'=>'小师妹电子商务有限公司f',
        //     'oabPostcode'=>'518001',
        //     'oabStreetAddress1'=>'南山区西丽大学城',
        //     'oabPhone'=>'13888888888',
        //     'oabEmail'=>'iphone@163.com',
        //     'grossWt'=>'1.5',
        //     'currencyCode'=>'RMB',
        //     'idType'=>'1',
        //     'idNumber'=>'412828199010011618',
        //     'remark'=>'test',
        //     'amount'=>'30',
        //     'orderStatus'=>'4',
        // );
        // $orderInfo['productDeatil'] = $orderProduct;

        $productInfo = array(
            'opType'            => 'Update',
            //不确定数据
            'charge'            => 'charge',
            'appTime'           => 'appTime',
            'payType'           => 'payType',
            'payNo'             => 'payNo',
            'payerName'         => 'payerName',
            'payerID'           => 'payerID',
            'poCode'            => 'POEC02531511190000011',
            // 不确定end
            'customsCode'       => 'C0204',
            'referenceNo'       => '554715852207112-1',
            'currency'          => 'RMB',
            'note'              => 'test luffy',
            //根据界面新加
            'status'            => '1',
            'goodsValue'        => '100',
            'freightFee'        => '10.22',
            'cosigneeCountry'   => 'CN',
            'cosigneeName'      => 'luffy',
            'cosigneeAddress'   => '皇后大道中',
            'cosigneeTelephone' => '18211252114',
            'proAmount'         => '0.00',
            'proRemark'         => 'no remark',
        );

        $header = array(
            'customerCode' => 'C0253',
            'appToken'     => '76F56B0A82EA3DB6',
            'appKey'       => '9fda424ec57b9308f280c5a04144a79a',
        );

        $data = array(
            'HeaderRequest' => $header,
            'payOrderInfo'  => $productInfo,
        );

        $request = array(
            'method' => 'operatePayOrder',
            'format' => 'json',
            'data'   => json_encode($data),
        );

        //$curl_url = 'http://120.24.90.64/default/warehouse-api/feedback';
        $curl_url = 'http://tianjin.oms.com/default/api/web';
        //$curl_url = 'http://oms.ccic.com/default/warehouse-api/feedback';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_POST, 1);

        //print_r($data);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //不直接输出，返回到变量*/
        $response = curl_exec($ch);

        echo ('<?xml version="1.0"?>');
        echo ($response);
    }
    public function downAction(){
        set_time_limit(0);
        require_once APPLICATION_PATH . '/../libs/PhpWord/PHPWord.php';
        require_once APPLICATION_PATH . '/../libs/PhpWord/Autoloader.php';
        \PhpOffice\PhpWord\Autoloader::register();

        for ($i=0; $i < 13; $i++) { 
            for ($j=0; $j < 3; $j++) { 
                $data[$i][$j] = 0;
            }
        }

        //备案企业
        $data[0][0] = Service_Customer::getByCondition(array('customer_status'=>'4'),'count(*)');
        $data[0][1] = Service_Customer::getByCondition(array('customer_status'=>'4','customs_code'=>'0213'),'count(*)');
        $data[0][2] = Service_Customer::getByCondition(array('customer_status'=>'4','customs_code'=>'0208'),'count(*)');

        $customers = Service_Customer::getByCondition(array('customs_status_not'=>'4'));
        if(!empty($customers)){
            foreach ($customers as $key => $value) {
                if($value['customs_status'] == '4' && $value['ciq_status'] !='3'){
                    $data[1][0]++;
                }
                if($value['customs_status'] == '4' && $value['ciq_status'] !='3' && 'customs_code' == '0213'){
                    $data[1][1]++;
                }
                if($value['customs_status'] == '4' && $value['ciq_status'] !='3' && 'customs_code' == '0208'){
                    $data[1][2]++;
                }
                if($value['customs_status'] != '4' && $value['ciq_status'] =='3'){
                    $data[2][0]++;
                }
                if($value['customs_status'] != '4' && $value['ciq_status'] =='3' && 'customs_code' == '0213'){
                    $data[2][1]++;
                }
                if($value['customs_status'] != '4' && $value['ciq_status'] =='3' && 'customs_code' == '0208'){
                    $data[2][2]++;
                }
            }
            unset($customers);
        }

        //备案产品
        $data[3][0] = Service_Product::getByCondition(array('product_status'=>'1'),'count(*)');
        $data[3][1] = Service_Product::getByCondition(array('product_status'=>'1','customs_code'=>'0213'),'count(*)');
        $data[3][2] = Service_Product::getByCondition(array('product_status'=>'1','customs_code'=>'0208'),'count(*)');

        $products = Service_Product::getByCondition(array('product_status_not'=>'1'));
        if(!empty($products)){
            foreach ($products as $key => $value) {
                if($value['customs_status'] == '1' && $value['ciq_status'] !='3'){
                    $data[4][0]++;
                }
                if($value['customs_status'] == '1' && $value['ciq_status'] !='3' && 'customs_code' == '0213'){
                    $data[4][1]++;
                }
                if($value['customs_status'] == '1' && $value['ciq_status'] !='3' && 'customs_code' == '0208'){
                    $data[4][2]++;
                }
                if($value['customs_status'] != '1' && $value['ciq_status'] =='3'){
                    $data[5][0]++;
                }
                if($value['customs_status'] != '1' && $value['ciq_status'] =='3' && 'customs_code' == '0213'){
                    $data[5][1]++;
                }
                if($value['customs_status'] != '1' && $value['ciq_status'] =='3' && 'customs_code' == '0208'){
                    $data[5][2]++;
                }
            }
            unset($products);
        }

        //物品清单
        $data[6][0] = Service_PersonItem::getByCondition(array('status'=>'6'),'count(*)');
        $personItems = Service_PersonItem::getByCondition(array('status'=>'6'));
        foreach ($personItems as $key => $value) {
            if($value['storage_customer_code']){
                $customer = Service_Customer::getByField($value['storage_customer_code'],'customs_code');
                if(!empty($customer)){
                    if($customer['customs_code'] == '0213'){
                        $data[6][1]++;
                    }
                    if($customer['customs_code'] == '0208'){
                        $data[6][2]++;
                    }
                }
            }
            
        }
        $personItems = Service_PersonItem::getByCondition(array('status_not'=>'6'));
        foreach ($personItems as $key => $value) {
            if($value['storage_customer_code']){
                $customer = Service_Customer::getByField($value['storage_customer_code'],'customs_code');
                if(!empty($customer)){
                    if ($value['customs_status'] == '6' && $value['ciq_status'] != '6') {
                        $data[7][0]++;
                    }
                    if ($value['customs_status'] == '6' && $value['ciq_status'] != '6' && $customer['customs_code'] == '0213') {
                        $data[7][1]++;
                    }
                    if ($value['customs_status'] == '6' && $value['ciq_status'] != '6' && $customer['customs_code'] == '0208') {
                        $data[7][2]++;
                    }
                    
                    if ($value['customs_status'] != '6' && $value['ciq_status'] == '6') {
                        $data[8][0]++;
                    }
                    if ($value['customs_status'] != '6' && $value['ciq_status'] == '6' && $customer['customs_code'] == '0213') {
                        $data[8][1]++;
                    }
                    if ($value['customs_status'] != '6' && $value['ciq_status'] == '6' && $customer['customs_code'] == '0208') {
                        $data[8][2]++;
                    }
                }
            }
            
        }

        //订单
        $orders = Service_Orders::getByCondition(array('order_status'=>'4','ciq_status'=>'2'));
        if(!empty($orders)){
            foreach ($orders as $key => $value) {
                if($value['customs_code'] == '0213'){
                    $data[9][1]++;
                }
                if($value['customs_code'] == '0208'){
                    $data[9][2]++;
                }
                $data[9][0]++;
            }
        }
        $data[10][0] = Service_Orders::getByCondition(array('order_status'=>'4','ciq_status_not'=>2),'count(*)');
        $data[10][1] = Service_Orders::getByCondition(array('order_status'=>'4','ciq_status_not'=>2,'customs_code'=>'0213'),'count(*)');
        $data[10][2] = Service_Orders::getByCondition(array('order_status'=>'4','ciq_status_not'=>2,'customs_code'=>'0208'),'count(*)');
        
        $data[11][0] = Service_Orders::getByCondition(array('order_status_not'=>'4','ciq_status'=>2),'count(*)');
        $data[11][1] = Service_Orders::getByCondition(array('order_status_not'=>'4','ciq_status'=>2,'customs_code'=>'0213'),'count(*)');
        $data[11][2] = Service_Orders::getByCondition(array('order_status_not'=>'4','ciq_status'=>2,'customs_code'=>'0208'),'count(*)');

        $shipBatch = Service_ShipBatch::getByCondition(array('customer_status'=>'3'));
        if(!empty($shipBatch)){
            foreach ($shipBatch as $key => $value) {
                if($value['customer_code']){
                    $customer = Service_Customer::getByField($value['customer_code'],'customer_code');
                    if(!empty($customer)){
                        if($customer['customs_code'] == '0213'){
                            $data[12][1]++;
                        }
                        if($customer['customs_code'] == '0208'){
                            $data[12][2]++;
                        }
                    }
                }
                $data[12][0]++;
            }
            unset($shipBatch);
        }



        $PHPWord = new \PhpOffice\PhpWord\PhpWord();

        $sectionStyle = array(
            'pageSizeW' => '15500',
        );
        // New portrait section
        $section = $PHPWord->addSection($sectionStyle);

        $section->addText('天津跨境电商平台运行情况日报表', array('name'=>'宋体','size' => '22','bold'=>true), array('align' => 'center'));

        $section->addText(date('Y年m月d'), array('name'=>'楷体','size' => '14'), array('align' => 'right'));

        // Define table style arrays
        $styleTable = array('width'=>'100%','borderSize'=>6);
        $styleFirstRow = array('borderBottomSize'=>18,);

        // Define cell style arrays
        $styleCell = array('valign'=>'center');
        //$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

        $fontStyle = array('bold'=>true); 
        $paragraphStyles= array('align'=>'center');

        // Add table style
        $PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);

        // Add table
        $table = $section->addTable('myOwnTableStyle');


        // Add row
        $table->addRow(600);

        // Add cells
        $table->addCell(5000, array('gridSpan' => '2','valign'=>'center'))->addText('项    目', $fontStyle,$paragraphStyles);
        $table->addCell(1100, $styleCell)->addText('单位', $fontStyle,$paragraphStyles);
        $table->addCell(2300, $styleCell)->addText('累计', $fontStyle,$paragraphStyles);
        $table->addCell(2300, $styleCell)->addText('东疆保税港区', $fontStyle,$paragraphStyles);
        $table->addCell(2300, $styleCell)->addText('保税区', $fontStyle,$paragraphStyles);

        // Add more rows / cells
        for($i = 0; $i < 13; $i++) {
            if($i % 3 == 0){
                $table->addRow(600);
                switch ($i) {
                    case '0':
                        $table->addCell(2000,array('vMerge'=>'restart','valign'=>'center'))->addText("备案企业",$fontStyle,$paragraphStyles);
                        break;
                    
                    case '3':
                        $table->addCell(2000,array('vMerge'=>'restart','valign'=>'center'))->addText("备案商品",$fontStyle,$paragraphStyles);
                        break;

                    case '6':
                        $table->addCell(2000,array('vMerge'=>'restart','valign'=>'center'))->addText("物品清单",$fontStyle,$paragraphStyles);
                        break;

                    case '9':
                        $table->addCell(2000,array('vMerge'=>'restart','valign'=>'center'))->addText("订单",$fontStyle,$paragraphStyles);
                        break;

                    case '12':
                        $table->addCell(2000,array('vMerge'=>'restart','valign'=>'center'))->addText("货物出区",$fontStyle,$paragraphStyles);
                        break;

                    default:
                        # code...
                        break;
                }
                
                $table->addCell(3000,$styleCell)->addText("关、检均审核通过", $fontStyle,$paragraphStyles);
                $table->addCell(1100,$styleCell)->addText("个", $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText($data[$i][0], $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText($data[$i][1], $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText($data[$i][2], $fontStyle,$paragraphStyles);
            }else if($i % 3 == 1){
                $table->addRow(600);
                $table->addCell(2000,array('vMerge'=>'continue'));
                $table->addCell(3000,$styleCell)->addText("海关审核通过", $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText("个", $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText($data[$i][0], $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText($data[$i][1], $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText($data[$i][2], $fontStyle,$paragraphStyles);
            }else{
                $table->addRow(600);
                $table->addCell(2000,array('vMerge'=>'continue'));
                $table->addCell(3000,$styleCell)->addText("检验检疫局审核通过", $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText("个", $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText($data[$i][0], $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText($data[$i][1], $fontStyle,$paragraphStyles);
                $table->addCell(2300,$styleCell)->addText($data[$i][2], $fontStyle,$paragraphStyles);
            }
        }

        $section->addText('注：日统计截至时间为工作日的16时', array('name'=>'楷体','size' => '14'), array('align' => 'right'));

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007');
        $fullPath = APPLICATION_PATH.'/../public/template/OperationResult'.time().'.docx';
        $objWriter->save($fullPath);

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');
        $filename = basename($fullPath);
        header("Content-Type: APPLICATION/OCTET-STREAM");
        $header="Content-Disposition: attachment; filename=".$filename.";";
        header($header);
        echo file_get_contents($fullPath);
        @unlink($fullPath);
        exit;
    }

}
