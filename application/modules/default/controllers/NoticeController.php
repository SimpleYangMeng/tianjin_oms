<?php

class Default_NoticeController extends Ec_Controller_DefaultAction
{

    public function preDispatch()
    {
        $this->view->errMsg = '';
        $this->tplDirectory = "default/views/default/";
    }

    /**
     * [listAction 列表]
     * @return [type] [description]
     */
    public function listAction(){
        $page = $this->getRequest()->getParam('page', 1);
        $pageSize = $this->getRequest()->getParam('pageSize', 20);
        $data = array();
        $condition = array(
           // 'ciq_status_arr' =>array('2', '3', '4'),
        );
        $count = Service_SjNotice::getByCondition($condition, 'count(*)');
        if($count){
            $data = Service_SjNotice::getByCondition($condition, '*', $pageSize, $page, 'sn_id DESC');
            /*
            if(!empty($data) && is_array($data)){
                foreach ($data as $key => $value) {
                    $data[$key]['message_type'] = $value['message_type'] == 0 ? '咨询' : '投诉';
                    $data[$key]['ciq_status'] = Service_SjNotice::getCiqStatus($value['ciq_status']);
                    $data[$key]['add_time'] = date('Y-m-d', strtotime($value['add_time']));
                }
            }
            */
        }
        $this->view->count = $count;
        $this->view->data = $data;
        $this->view->pageSize = $pageSize;
        $this->view->page = $page;
        echo Ec::renderTpl($this->tplDirectory . "notice-list.tpl", 'layout');
    }

    /**
     * [viewAction 详情]
     * @return [type] [description]
     */
    public function viewAction(){
        $snId = $this->_request->getParam('snId', 0);
        if(empty($snId)){
            die('Data error');
        }
        $noticeData = Service_SjNotice::getByField($snId, 'sn_id');
        $this->view->noticeData = $noticeData;
        echo Ec::renderTpl($this->tplDirectory . "notice-view.tpl", 'layout');
    }
	
	public function downloadAction()
	{
		$id 	= $this->_request->getParam('id');
		$notice = Service_SjNotice::getByField($id ,'sn_id');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache');
    	$filename = basename($notice['down_url']);
    	header("Content-Type: APPLICATION/OCTET-STREAM");
    	$header="Content-Disposition: attachment; filename=".$filename.";";
    	header($header );
    	echo file_get_contents($notice['down_url']);
    	exit;
	}
}
