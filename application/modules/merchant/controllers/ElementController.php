<?php
require_once("PHPExcel.php");
require_once("PHPExcel/IOFactory.php");

class Merchant_ElementController extends Ec_Controller_Action
{    
    public function preDispatch() {
        $this->tplDirectory = "merchant/views/product/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }
    
    public function indexAction() {
        echo Ec::renderTpl($this->tplDirectory . "element-template.tpl",'noleftlayout');
    }

    /**
     * @author solar
     * @todo 下载申报要素模板
     */
    public function templateAction(){
        header("Content-type: text/html; charset=utf-8");
        $hs_code = trim($this->_request->getParam('hs_code'));
        if(empty($hs_code)) {
            header("Content-type: text/html; charset=utf-8");
            exit('请输入海关编码');
        }
        $aHsCodes = Service_Hscodes::getByField($hs_code, 'hs_code');
        if(empty($aHsCodes)) {
            header("Content-type: text/html; charset=utf-8");
            exit('海关编码['.$hs_code.']不存在');
        }        
        $hsElementList = Service_HsElement::getByCondition(array('hs_code'=>$hs_code,'he_status'=>'1'));
        if(empty($hsElementList)) {
            header("Content-type: text/html; charset=utf-8");
            exit('异常：海关编码['.$hs_code.']没有申报要素');
        }
        $aHsUom = Service_HsUom::getByField($hs_code, 'hs_code');
        if(empty($aHsUom)) {
            header("Content-type: text/html; charset=utf-8");
            exit('异常：海关编码['.$hs_code.']没有法定单位');
        }
        $oExcel = new PHPExcel();
        $oExcel->setActiveSheetIndex(0);
        $oActiveSheet = $oExcel->getActiveSheet();
        $oExcel->getDefaultStyle()->getFont()->setName('宋体');
        $oExcel->getDefaultStyle()->getFont()->setSize(12);
        $oActiveSheet->setCellValue('A1', '产品SKU');
        $oActiveSheet->setCellValue('B1', '海关编码');
        //审核要素
        $ascii = ord('B');        
        foreach($hsElementList as $hsElementRow) {
            $oActiveSheet->setCellValue(chr(++$ascii).'1', $hsElementRow['he_name']);
        }
        //法定单位
        $kvUom = Service_ProductUom::getKeyVal();
        $oActiveSheet->setCellValue(chr(++$ascii).'1', '法定单位('.$kvUom[$aHsUom['pu_code_law']].')');
        //第二单位
        if($aHsUom['pu_code_second']!='') {
            $oActiveSheet->setCellValue(chr(++$ascii).'1', '第二单位('.$kvUom[$aHsUom['pu_code_second']].')');
        }
        //是否零件类
        $oActiveSheet->setCellValue(chr(++$ascii).'1', '是否零件类');
        //下载输出
        $oWriter=PHPExcel_IOFactory::createWriter($oExcel,'Excel5');
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        
        if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE")){//IE
            $filename=urlencode('海关编码['.$hs_code.']的申报要素模板.xls');
        }else{
            $filename='海关编码['.$hs_code.']的申报要素模板.xls';
        }
        
        header('Content-Disposition:attachment;filename="'.$filename.'"');
        
        //header('Content-Disposition:attachment;filename="海关编码['.$hs_code.']的申报要素模板.xls"');
        header("Content-Transfer-Encoding:binary");
        $oWriter->save('php://output');
    }

  public function queryHscodeAction() {
    $response = array('status' => 0, 'message' => '', 'element' => array());

    if (!$this->getRequest()->isPost()) {
      $response['message'] = '请求方式错误';
      exit(Zend_Json::encode($response));
    }

    $hsCode   = trim($this->_request->getPost('code', ''));
    $response = array('status' => 0, 'message' => '', 'element' => array());

    if (empty($hsCode)) {
      $response['message'] = '海关编码不能为空';
      exit(Zend_Json::encode($response));
    }

    $hsCodeRow = Service_Hscodes::getByField($hsCode, 'hs_code');

    if(empty($hsCodeRow)) {
      $response['message'] = '海关编码[' . $hsCode . ']不存在';
      exit(Zend_Json::encode($response));
    }

    $hsElement = Service_HsElement::getByCondition(array('hs_code' => $hsCode, 'he_status' => 1));

    if (empty($hsElement)) {
      $response['message'] = '海关编码[' . $hsCode . ']缺乏申报要素';
      exit(Zend_Json::encode($response));
    }

    $hsUom = Service_HsUom::getByField($hsCode, 'hs_code');

    if (empty($hsUom)) {
      $response['message'] = '海关编码[' . $hsCode . ']缺乏法定单位';
      exit(Zend_Json::encode($response));
    }

    // 申报要素
    foreach ($hsElement as $element) {
      $response['element'][] = $element['he_name'];
    }

    // 法定单位
    $kvUom                 = Service_ProductUom::getKeyVal();
    $response['element'][] = '法定单位(' . $kvUom[$hsUom['pu_code_law']] . ')';

    // 第二单位
    if ('' !== trim($hsUom['pu_code_second'])) {
      $response['element'][] = '第二单位(' . $kvUom[$hsUom['pu_code_second']] . ')';
    }

    $response['element'][] = '是否零件类';
    $response['status']    = 1;

    exit(Zend_Json::encode($response));
  }

    /**
     * @todo 上传Excel文件
     * @author solar
     */
    public function uploadAction() {
        $uploadSession = new Zend_Session_Namespace('upload');
        $uploadSession->elementExcel = '';
        $path = APPLICATION_PATH.'/../data/upload/'.$this->_customerAuth['id'];
        if(!file_exists($path)){
            if(!mkdir($path,0777,true)){
                $this->view->message = '上传失败：内部错误';
                echo Ec::renderTpl($this->tplDirectory . "element-template.tpl",'noleftlayout');
                exit;
            }
        }
        $config = array();
        $config['upload_path']        = $path;
        $config['allowed_types']    = 'xls|xlsx';
        $config['max_size']            = '2048000';
        $config['encrypt_name']        = true;
        $upload    = new Common_UploadFile($config);
        $upload->set_upload_path($path);
        if (!$upload->do_upload($_FILES,'XMLForInput')){
            $this->view->message = '上传文件失败：'.$upload->display_errors();
            echo Ec::renderTpl($this->tplDirectory . "element-template.tpl",'noleftlayout');
            exit;
        }        
        $uploadData = $upload->data();
        if(empty($uploadData) || empty($uploadData['full_path'])){
            $this->view->message = '上传失败：内部错误';
            echo Ec::renderTpl($this->tplDirectory . "element-template.tpl",'noleftlayout');
            exit;
        }        
        $excelData = Common_Upload::readEXCEL($uploadData['full_path']);
        if(!is_array($excelData) || empty($excelData) || count($excelData)<2) {
            $this->view->message = '文件数据为空，请填充数据后再上传';
            @unlink($uploadData['full_path']);
            echo Ec::renderTpl($this->tplDirectory . "element-template.tpl",'noleftlayout');
            exit;
        }
        $result = $this->validateData($excelData);
        if($result['ask']==0) {
            $this->view->message = implode('<br>', $result['error']);
            @unlink($uploadData['full_path']);
            echo Ec::renderTpl($this->tplDirectory . "element-template.tpl",'noleftlayout');
        } else {
            $this->view->excelHead = $result['header'];
            $this->view->excelData = $result['body'];
            $uploadSession->elementExcel = $uploadData['full_path'];
            echo Ec::renderTpl($this->tplDirectory . "element-preview.tpl",'noleftlayout');
        }        
    }
    /**
     * [excelHeadTrim 去掉表头字段前后左右的全角和半角空格]
     * @param  [array|str] $val [description]
     * @return [type]           [description]
     */
    private function excelHeadTrim(&$val){
        if(is_array($val)){
            foreach ($val as $key => $value) {
                $value = trim($value);
                $value = preg_replace('/　/', '', $value);
                $val[$key] = $value;
            }
        }else{
            $val = trim($val);
            $value = preg_replace('/　/', '', $val);            
        }
        return $val;
    }
    private function validateData(&$excelData) {
        $result = array('ask'=>0);
        $aError = array();
        //表头
        $excelHead = array_shift($excelData);
        $this->excelHeadTrim($excelHead);

        if(trim($excelHead[0]) != '产品SKU') $aError[] = '表头错误：A1单元格应该为"产品SKU"';
        if(trim($excelHead[1]) != '海关编码') $aError[] = '表头错误：B1单元格应该为"海关编码"';
        $hs_code = trim($excelData[0][1]);
        //$aHsCodes = Service_Hscodes::getByField($hs_code, 'hs_code');
        $hs_condition  = array(
            'hs_code'           => $hs_code,
            'hs_code_status'    => 1
        );
        $aHsCodes = Service_Hscodes::getByCondition($hs_condition);
        if(empty($aHsCodes)) $aError[] = '海关编码['.$hs_code.']非法';
        $hsElementList = Service_HsElement::getByCondition(array('hs_code'=>$hs_code,'he_status'=>1));
        if(empty($hsElementList)) {
            $aError[] = '异常：海关编码['.$hs_code.']没有申报要素';
        }
        $i = 0;
        $ascii = ord('A');
        foreach($hsElementList as $key=>$hsElementRow) {
            $i = $key+2;
            if(trim($excelHead[$i]) != $hsElementRow['he_name']) {
                $aError[] = '表头错误：'.chr($ascii+$i).'1单元格应该为"'.$hsElementRow['he_name'].'"';
            }
        }
        $aHsUom = Service_HsUom::getByField($hs_code, 'hs_code');
        if(empty($aHsUom)) {
            $aError[] = '异常：海关编码['.$hs_code.']没有法定单位';
        }
        //法定单位
        $i += 1;
        $kvUom = Service_ProductUom::getKeyVal();
        $puCodeLaw = '法定单位('.$kvUom[$aHsUom['pu_code_law']].')';
        if(trim($excelHead[$i]) != $puCodeLaw) $aError[] = '表头错误：'.chr($ascii+$i).'1单元格应该为"'.$puCodeLaw.'"';
        //第二单位
        if($aHsUom['pu_code_second']!='') {
            $i += 1;
            $puCodeSecond = '第二单位('.$kvUom[$aHsUom['pu_code_second']].')';
            if(trim($excelHead[$i]) != $puCodeSecond) $aError[] = '表头错误：'.chr($ascii+$i).'1单元格应该为"'.$puCodeSecond.'"';
        }
        //如果表头有错，返回错误
        if(!empty($aError)) {
            $result['error'] = $aError;
            return $result;
        }        
        
        //获取所有的列名
        $j = 2;
        $colname[0] = '产品SKU';
        $colname[1] = '海关编码';
        foreach ($hsElementList as $key => $value) {
            $colname[$j++] = $value['he_name'];
        }
        if(!empty($aHsUom)){
            if($aHsUom['pu_code_law']!=''){
               $colname[$j++] = $puCodeLaw;
            }
            if($aHsUom['pu_code_second']!=''){
                $colname[$j++] = $puCodeSecond;
            }
        }
        $colname[$j] = '是否零件类';

        foreach ($excelData as $key => $excelRow) {
            for ($i=0; $i < count($excelRow); $i++) { 
                $line = $key+2;
                if(preg_match('/[\r\n|\r|\n]+/i', $excelData[$key][$i])){
                    $aError[] = '第'.$line.'行：产品SKU['.trim($excelData[$key][0]).']的 '.$colname[$i].' 存在回车符';
                }
                if(preg_match('/　/i', $excelData[$key][$i])){
                    $aError[] = '第'.$line.'行：产品SKU['.trim($excelData[$key][0]).']的 '.$colname[$i].' 存在全角空格符';
                }
            }
        }
        //var_dump($aError);
        //exit();
        //如果有回车符和圆角空格符，返回错误
        if(!empty($aError)) {
            $result['error'] = $aError;
            return $result;
        }        

        //表体
        $line = 1;
        $aSku = array();
        foreach($excelData as $excelRowIndex => $excelRow) {
            ++$line;
            $productSku = trim($excelRow[0]);
            if(empty($productSku)) $aError[] = '第'.$line.'行：产品SKU不能为空';
            if(in_array($productSku, $aSku)) $aError[] = '第'.$line.'行：产品SKU['.$productSku.']跟前面行有重复';
            else $aSku[] = $productSku;
            $where = array('customer_id'=>$this->_customerAuth['id'], 'product_sku'=>$productSku);
            $aProduct = Service_Product::getByWhere($where);
            if(empty($aProduct)) {
                $aError[] = '第'.$line.'行：产品SKU['.$productSku.']不存在';
                continue;
            }
            if($aProduct['product_status']!=2) {
                $aError[] = '第'.$line.'行：产品SKU['.$productSku.']不是草稿状态';
            }
            if($aProduct['hs_code']!=$hs_code) {
                $aError[] = '第'.$line.'行：产品SKU['.$productSku.']的海关编码是['.$aProduct['hs_code'].']';
            }
            $lineHsCode = trim($excelRow[1]);
            if(empty($lineHsCode)) $aError[] = '第'.$line.'行：海关编码不能为空';
            if($lineHsCode!=$hs_code) $aError[] = '第'.$line.'行：海关编码['.$lineHsCode.']与['.$hs_code.']不一致';
            $i = 0;
            $elementValueLength = 0;
              // UNICODE正则表达式：去除\u200b空白字符
              $unicodeSpacePattern = array('/\x{200b}/u' , '/\x{a0}/u');
            //申报要素
            foreach($hsElementList as $key=>$hsElementRow) {
                $i = $key+2;
                $element = preg_replace($unicodeSpacePattern, array('' , ' '), trim($excelRow[$i]));
                $excelData[$excelRowIndex][$i] = $element;
                if(!($hsElementRow['he_name']=='其它' && $hsElementRow['he_sort']==1000)){
                    if($element=='') $aError[] = '第'.$line.'行：'.$excelHead[$i].'不能为空';
                }
                if (!Service_GB18030::isValid($element)) {
                  $aError[] = '第' . $line . '行申报要素[' . $excelHead[$i] . ']含有非GB18030字符集字符';
                }
                //$elementValueLength+= mb_strlen($element,"utf-8");
                //招保IT说汉字按2字符算
                $elementValueLength+= strlen(mb_convert_encoding($element,'GB2312','UTF-8'));
                //申报要素不允许包含的特殊字符
                $specialCharsPattern    = "/[\\\'\":;?~`!@#$^&=_)({}\[\]]/";
                $specialCharsCheck      = preg_match($specialCharsPattern, $excelRow[$i]);
                if($specialCharsCheck){
                    $aError[] = '第'.$line.'行：'.$excelRow[$i].' 包含特殊字符';
                }
                //中文特殊字符
                $specialCharsPattern_cn = array("！","￥","（","）","【","】","、","；","：","“","”","‘","’","？","《","》","。","…","，");
                if(!empty($excelRow[$i])){
                    foreach($specialCharsPattern_cn as $cn_val){
                        $specialCharsCheck_cn   = mb_strstr($excelRow[$i],$cn_val);
                        if($specialCharsCheck_cn){
                            $aError[] = '海关申报要素：'.$excelRow[$i].' 包含特殊字符';
                        }
                    }
                }
            }


            if($elementValueLength>200){
                    $aError[] = '第'.$line.'行,各申报元素的内容总长度不超过200个字符。';
            }
            
            
            //法定单位
            $i += 1;
            $code_law = trim($excelRow[$i]);
            if(empty($code_law)) $aError[] = '第'.$line.'行：'.$excelHead[$i].'不能为空';
            if(!is_numeric($code_law)) $aError[] = '第'.$line.'行：'.$excelHead[$i].'只能是数字';
                //检测法定单位是否强制整数
                $productUomRow = Service_ProductUom::getByField($aHsUom['pu_code_law'],'pu_code',array('pu_int_request'));
                if( (1==$productUomRow['pu_int_request']) && !ctype_digit(strval($code_law))){
                    $aError[] = '第'.$line.'行：'.$puCodeLaw.'必须是大于0的正整数，您的不正确输入为：'.$code_law;
                }elseif(!is_numeric($code_law)){
                    $aError[] = '第'.$line.'行：'.$excelHead[$i].'只能是数字';
                }elseif($code_law <= 0){
                    $aError[] = '第'.$line.'行：'.$excelHead[$i].'小于0';
                }
            //第二单位
            if($aHsUom['pu_code_second']!='') {
                $i += 1;
                $code_second = trim($excelRow[$i]);
                if(empty($code_second)) $aError[] = '第'.$line.'行：'.$excelHead[$i].'不能为空';
                if(!is_numeric($code_second)){
                            $aError[] = '第'.$line.'行：'.$excelHead[$i].'只能是数字';
                        }elseif($code_second <= 0){
                            $aError[] = '第'.$line.'行：'.$excelHead[$i].'小于0';
                        }
                        
                //检测法定单位是否强制整数
                $productUomRow = Service_ProductUom::getByField($aHsUom['pu_code_second'],'pu_code',array('pu_int_request'));
                if( (1==$productUomRow['pu_int_request']) && !ctype_digit(strval($code_second))){
                    $aError[] = '第'.$line.'行：'.$puCodeSecond.'必须是大于0的正整数，您的不正确输入为：'.$code_second;
                }
            }
            //是否零件类
            $i += 1;
            $is_accessories = trim($excelRow[$i]);
            if($is_accessories && !in_array($is_accessories, array('是','否'))) {
                $aError[] = '第'.$line.'行：'.$excelHead[$i].'只能填“是”或者“否”';
            }
                
              
               
        }
        //返回结果
        if(!empty($aError)) {
            $result['error'] = $aError;
        } else {
            $result['header'] = $excelHead;
            $result['body'] = $excelData;
            $result['ask'] = 1;
        }
        return $result;
    }

    /**
     * @author solar
     * @todo 确认上传Excel
     */
    public function confirmAction() {
        $uploadSession  = new Zend_Session_Namespace('upload');
        $elementExcel   = $uploadSession->elementExcel;
        if(!$elementExcel) {
            exit(json_encode(array('ask'=>0, 'message'=>'您还没有上传文件')));
        }
        $excelData = Common_Upload::readEXCEL($elementExcel);
        if(!is_array($excelData) || empty($excelData) || count($excelData)<2) {
            exit(json_encode(array('ask'=>0, 'message'=>'内部错误')));
        }
        $excelHead = array_shift($excelData);
        //开始事务
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $hs_code = trim($excelData[0][1]);
            $hsElementList = Service_HsElement::getByCondition(array('hs_code'=>$hs_code,'he_status'=>1));
            $aHsUom = Service_HsUom::getByField($hs_code, 'hs_code');
                        $line = 1;
            foreach($excelData as $excelRowIndex => $excelRow) {
                            ++$line;
                $where = array('customer_id'=>$this->_customerAuth['id'], 'product_sku'=>trim($excelRow[0]));
                $aProduct = Service_Product::getByWhere($where, 'product_id');
                $hemRow = Service_HsElementMap::getByField($aProduct['product_id'],'product_id');
                if($hemRow) continue;
                $i = 0;
                // UNICODE正则表达式：去除\u200b空白字符
                $unicodeSpacePattern = array('/\x{200b}/u' , '/\x{a0}/u');
                //申报要素
                foreach($hsElementList as $key=>$hsElementRow) {
                    $i = $key+2;
                    $elementMap = array();
                    $elementMap['he_id'] = $hsElementRow['he_id'];
                    $elementMap['product_id'] = $aProduct['product_id'];
                    $element = preg_replace($unicodeSpacePattern, array('' , ' '), trim($excelRow[$i]));
                    //$elementMap['hem_detail'] = strtoupper(trim($element, chr(194).chr(160)));
                    $elementMap['hem_detail'] = trim($element);
                    $elementMap['hem_add_time'] = date('Y-m-d H:i:s');
                    //print_r($elementMap);
          if (!Service_GB18030::isValid($elementMap['hem_detail'])) {
            throw new Exception('第'.$excelRowIndex.'行：海关申报要素[' . $elementMap['hem_detail'] . ']含有非GB18030字符集字符');
          }
                    Service_HsElementMap::add($elementMap);
                }
                $i = 0;
                $elementValueLength = 0;
                foreach($hsElementList as $key=>$hsElementRow) {
                            $i = $key+2;
                            $element = preg_replace($unicodeSpacePattern, array('' , ' '), trim($excelRow[$i]));               
                            $elementValueLength+= mb_strlen($element,"utf-8");
                }                
                if($elementValueLength>200){
                        throw new Exception('第'.$line."行：各申报元素的内容总长度不超过200个字符。"); 
                }
                
                
                //法定单位
                $i += 1;
                $uomsMap = array();
                $uomsMap['hu_id'] = $aHsUom['hu_id'];
                $uomsMap['product_id'] = $aProduct['product_id'];
                $hum_quantity_law = trim($excelRow[$i]);
                                //检测法定单位是否强制整数
                                $productUomRow = Service_ProductUom::getByField($aHsUom['pu_code_law'],'pu_code',array('pu_int_request'));
                                if( (1==$productUomRow['pu_int_request']) && !ctype_digit(strval($hum_quantity_law))){
                                    throw new Exception('第'.$line."行：法定单位必须是大于0的正整数，您的不正确输入为：".$hum_quantity_law);
                                }
                 if($hum_quantity_law) {
                    $hum_quantity_law = ($hum_quantity_law * 10000)/10000;
                                if($hum_quantity_law < 0.0001){
                                    throw new Exception('第'.$line.'行：第一法定单位必须大于0！请不要输入小于0.0001的小数！');
                                }
                } 
               $uomsMap['hum_quantity_law'] = sprintf("%.4f",$hum_quantity_law);
                //第二单位
                if($aHsUom['pu_code_second']!='') {
                    $i += 1;
                    $hum_quantity_second = trim($excelRow[$i]);
                    if($hum_quantity_second) {
                        $hum_quantity_second = ($hum_quantity_second*10000)/10000;
                        if($hum_quantity_second < 0.0001){
                            throw new Exception('第'.$line.'行：第二法定单位必须大于0！请不要输入小于0.0001的小数！您的不正确输入为：'.$hum_quantity_second);
                        }
                        //检测法定单位是否强制整数
                        $productUomRow = Service_ProductUom::getByField($aHsUom['pu_code_second'],'pu_code',array('pu_int_request'));
                        if( (1==$productUomRow['pu_int_request']) && !ctype_digit(strval($hum_quantity_second))){
                            throw new Exception('第'.$line."行：法定单位必须是大于0的正整数，您的不正确输入为：".$hum_quantity_second);
                        }
                    }
                    $uomsMap['hum_quantity_second'] = sprintf("%.4f",$hum_quantity_second);
                }
                $uomsMap['hum_add_time'] = date('Y-m-d H:i:s');
                Service_HsUomMap::add($uomsMap);
                //是否零件类
                $i += 1;
                $is_accessories_cn = trim($excelRow[$i]);
                /*if($is_accessories_cn) {
                    $is_accessories = $is_accessories_cn=='是' ? 1 : 0;
                    Service_Product::update(array('is_accessories'=>$is_accessories), $aProduct['product_id']);
                }*/
                //处理备案
                Service_Product::handleRecord($aProduct['product_id']);        
            }
            $db->commit();
            //$db->rollback();
            $result['ask'] = 1;
        } catch(Exception $e) {
            $db->rollback();
            $result['ask'] = 0;
            $result['message'] = '上传异常：'.$e->getMessage().'，请重新上传';            
        }
        @unlink($uploadSession->elementExcel);
        $uploadSession->elementExcel = '';
        exit(json_encode($result));
    }
        
}