<?php

class Default_FeedBackController extends Ec_Controller_DefaultAction
{

    public function preDispatch()
    {
        $this->view->errMsg = '';
        $this->tplDirectory = "default/views/default/";
    }

    public function indexAction()
    {
        echo Ec::renderTpl($this->tplDirectory . "feedback.tpl", 'layout'); //使用布局文件
    }

    public function saveAction(){
        $result = array('ask' => '0','message' => '提交失败');
        $time = date('Y-m-d H:i:s');
        $type = $this->_request->getParam('type', '');
        $title = $this->_request->getParam('title', '');
        $message = $this->_request->getParam('message', '');
        $verifycode = $this->_request->getParam('verify', '');

        $verify = new Common_Verifycode();
        $res = $verify->is_true($verifycode);
        if(!$res){
            $result['ask'] = '0';
            $result['message'] = '验证码不正确';
            die(json_encode($result));
        }
        $insert = array(
            'message_type' => $type,
            'title' => $title,
            'message' => $message,
            'add_time' => date('Y-m-d H:i:s', time()),
            'from_ip' => Common_Common::getIP(),
        );
        $res = Service_Feedback::add($insert);
        if($res){
            $result['ask'] = '1';
            $result['message'] = '提交成功';
        }
        echo json_encode($result);
        exit;
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
            'ciq_status_arr' =>array('0', '1', '2', '3', '4'),
        );
        $count = Service_Feedback::getByCondition($condition, 'count(*)');
        if($count){
            $data = Service_Feedback::getByCondition($condition, '*', $pageSize, $page, 'feedback_id DESC');
            if(!empty($data) && is_array($data)){
                foreach ($data as $key => $value) {
                    $data[$key]['message_type'] = $value['message_type'] == 0 ? '咨询' : '投诉';
                    $data[$key]['ciq_status'] = Service_Feedback::getCiqStatus($value['ciq_status']);
                    $data[$key]['add_time'] = date('Y-m-d', strtotime($value['add_time']));
                }
            }
        }
        $this->view->count = $count;
        $this->view->data = $data;
        $this->view->pageSize = $pageSize;
        $this->view->page = $page;
        echo Ec::renderTpl($this->tplDirectory . "feedback-list.tpl", 'layout');
    }

    /**
     * [viewAction 详情]
     * @return [type] [description]
     */
    public function viewAction(){
        $feedbackId = $this->_request->getParam('feedbackId', 0);
        if(empty($feedbackId)){
            die('Data error');
        }
        $feedbackData = Service_Feedback::getByField($feedbackId, 'feedback_id');
        $feedbackData['message_type'] = $feedbackData['message_type'] == 0 ? '咨询' : '投诉';
        $feedbackData['ciq_status'] = Service_Feedback::getCiqStatus($feedbackData['ciq_status']);
        $feedbackData['add_time'] = date('Y-m-d', strtotime($feedbackData['add_time']));
        $this->view->feedbackData = $feedbackData;
        echo Ec::renderTpl($this->tplDirectory . "feedback-view.tpl", 'layout');
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

}
