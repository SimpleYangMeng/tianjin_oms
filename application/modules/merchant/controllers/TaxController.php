<?php
/**
 *
 */
class Merchant_TaxController extends Ec_Controller_Action
{

    public function preDispatch()
    {
        $this->tplDirectory = "merchant/views/tax/";
    }

    /**
     * [listAction description]
     * @return [type] [description]
     */
    public function listAction()
    {
        $page      = $this->getRequest()->getParam('page', 1);
        $pageSize  = $this->getRequest()->getParam('pageSize', 20);
        $condition = array(
            //专用缴款书编号
            'tax_pmt_no'    => $this->getRequest()->getParam('tax_pmt_no', ''),
            //物品清单号
            'form_id'       => $this->getRequest()->getParam('form_id', ''),
            //订单号
            'order_no'      => $this->getRequest()->getParam('order_no', ''),
            //电商企业代码
            'customer_code' => $this->_customerAuth['code'],
        );

        $count       = Service_TaxList::getByCondition($condition, 'count(*)');
        $taxListRows = array();

        if ($count > 0) {
            $taxListRows = Service_TaxList::getByCondition($condition, '*', 'tax_list_id DESC', $pageSize, $page);
        }

        $this->view->taxListRows = $taxListRows;
        $this->view->pageSize    = $pageSize;
        $this->view->page        = $page;
        $this->view->count       = $count;
        $this->view->condition   = $condition;
        echo Ec::renderTpl($this->tplDirectory . 'list.tpl', 'noleftlayout');
    }

    /**
     * [viewAction description]
     * @return [type] [description]
     */
    public function downloadAction()
    {
        $condition = array(
            //专用缴款书编号
            'tax_pmt_no'    => $this->getRequest()->getParam('tax_pmt_no', ''),
            //物品清单号
            'form_id'       => $this->getRequest()->getParam('form_id', ''),
            //订单号
            'order_no'      => $this->getRequest()->getParam('order_no', ''),
            //电商企业代码
            'customer_code' => $this->_customerAuth['code'],
        );

        $count = Service_TaxList::getByCondition($condition, 'count(*)');

        $taxListRows = array();
        if ($count > 0) {
            $object = new Common_ExportForExcel(array());
            $object->setSheet();
            $index = $object->setRowsValue(array(
                array('专用缴款书编号', '物品清单号', '订单号', '税额 币制：元', '税金产生时间', '纳税人姓名', '完税价格', '备用字段1', '备用字段2', '主管海关', '消费者身份ID', '关税', '增值税', '消费税', '仓储物流企业代码', '仓储物流企业名称'),
            ));

            $pageSize = 100;
            $pages    = ceil($count / $pageSize);

            for ($page = 1; $page <= $pages; $page++) {
                $taxListRowsNum = array();
                $taxListRows    = Service_TaxList::getByCondition($condition, '*', 'tax_list_id DESC', $pageSize, $page);
                if (empty($taxListRows)) {
                    continue;
                }
                foreach ($taxListRows as $value) {
                    $taxListRowsNum[] = array($value['tax_pmt_no'], $value['form_id'], $value['order_no'], $value['tax_total'], $value['tax_calc_time'], $value['taxpayer'], $value['decl_total'], $value['remark_1'], $value['remark_2'], $value['decl_port'], $value['taxpay_id'], $value['tax_a'], $value['tax_l'], $value['tax_y'], $value['wh_code'], $value['wh_name']);
                }

                $index = $object->setRowsValue($taxListRowsNum, $index, function ($index) {
                    switch ($index) {
                        case 6:
                        case 11:
                        case 12:
                        case 13:
                        case 3:
                            return Common_ExportForExcel::TYPE_FORMULA;
                            break;
                        default:
                            return Common_ExportForExcel::TYPE_STRING2;
                            break;
                    }
                });

            }

            $object->save('电商企业代码:' . $this->_customerAuth['code'] . " 专用缴款书（税费）数据");
        }

    }
}
