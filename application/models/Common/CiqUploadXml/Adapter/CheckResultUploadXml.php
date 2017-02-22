<?php

/**
*
*/
class CheckResultUploadXml extends ShangJianXmlParent
{
    //操作对应的状态
    protected $status = 0;
    protected $apiCode = 'CheckResult';
    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createBodyXml($itemRow)
    {
    	$ccrData = Service_CiqCheckResult::getByField($itemRow['ref_id'], 'ccr_id');
    	if(empty($ccrData)){
            $this->_error = "查验结果ID:[{$itemRow['ref_id']}]不存在！";
            return false;
        }
        $checkResult = 1;
        if($ccrData['checkResult'] == 'P'){
            $checkResult = 2;
        }else if($ccrData['checkResult'] == 'N'){
            $checkResult = 3;
        }
        //属地检验检疫机构代码
        $this->_insUnitCode = '120010';
        $ccrInfo = array(
            'XrmDeclReceivedDocument'=>array(
        		'XrmDeclReceivedHead' => array(
        				'DECL_NO' => $ccrData['logisticsNo'],
        				'BIZ_TYPE' => 1,
        				'TYPE_CODE' => $checkResult,
        				'CF_REMARK' => $ccrData['checkOpinion'],
        		),
            ),
        );
        return $ccrInfo;
    }
}
