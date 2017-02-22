<?php
/**
<DECL_PORT>0213</DECL_PORT>
<TAXPAY_ID>120106198509106519</TAXPAY_ID>
<TAX_A>0</TAX_A>
<TAX_L>.15</TAX_L>
<TAX_Y>0</TAX_Y>
<WH_CODE>120761K003</WH_CODE>
<WH_NAME>天津保宏供应链管理有限公司</WH_NAME>
<ENP_CODE>0213D000048</ENP_CODE>
<ENP_NAME>深圳市联银供应链有限公司</ENP_NAME>


主管海关 DECL_PORT,
消费者身份 IDTAXPAY_ID ,
关税 TAX_A ,
增值税  TAX_L ,
消费税 TAX_Y,
仓储物流企业代码 WH_CODE,
仓储物流企业名称 WH_NAME,
电商企业代码 ENP_CODE,
电商企业名称 ENP_NAME


 */
class TaxReceipt
{
    public static function receiveReceipt(array $bodyRow, array $headRow)
    {
        if ($headRow['filedirectory'] && $headRow['filename']) {
            $tempFile = $headRow['filedirectory'] . $headRow['filename'];
            if (file_exists($tempFile)) {
                $xmlObj  = simplexml_load_file($tempFile);
                $xmlData = Common_Message::analyzeResult($xmlObj);
                if (!empty($xmlData['Declaration']) && !empty($xmlData['Declaration']['TAX_HEAD'])) {
                    if (!empty($xmlData['Declaration']['TAX_HEAD']['TAX_LIST'])) {
                        $tax_list = array();
                        if (isset($xmlData['Declaration']['TAX_HEAD']['TAX_LIST'][0]) && is_array($xmlData['Declaration']['TAX_HEAD']['TAX_LIST'][0])) {
                            foreach ($xmlData['Declaration']['TAX_HEAD']['TAX_LIST'] as $value) {
                                self::add($value);
                            }
                        } else {
                            self::add($xmlData['Declaration']['TAX_HEAD']['TAX_LIST']);

                        }
                    }

                }
            } else {
                throw new Exception("不存在该文件");
            }
        } else {
            throw new Exception("文件路径不正确");
        }
    }

    /**
     * [add description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-04-20T15:47:11+0800
     * @param    string                   $value [description]
     */
    private static function add($list = array())
    {
        if (empty($list)) {
            throw new Exception("报文格式出错");
        }
        $taxList = array(
            'tax_pmt_no'    => $list['TAX_PMT_NO'],
            'form_id'       => $list['FORM_ID'],
            'order_no'      => $list['ORDER_NO'],
            'tax_total'     => $list['TAX_TOTAL'],
            'tax_calc_time' => $list['TAX_CALC_TIME'],
            'taxpayer'      => $list['TAXPAYER'],
            'decl_total'    => $list['DECL_TOTAL'],
            'remark_1'      => $list['REMARK_1'],
            'remark_2'      => $list['REMARK_2'],
            'decl_port'     => $list['DECL_PORT'],
            'taxpay_id'     => $list['TAXPAY_ID'],
            'tax_a'         => $list['TAX_A'],
            'tax_l'         => $list['TAX_L'],
            'tax_y'         => $list['TAX_Y'],
            'wh_code'       => $list['WH_CODE'],
            'wh_name'       => $list['WH_NAME'],
            'customer_code' => $list['ENP_CODE'],
            'customer_name' => $list['ENP_NAME'],
        );
        Service_TaxList::add($taxList);
    }
}
