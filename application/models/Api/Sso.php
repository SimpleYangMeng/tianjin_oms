<?php

/**
 * @todo 注册登陆接口
 * 
 */
class Api_Sso extends Api_Web
{
    /**
     * [run description]
     * @return [type] [description]
     */
    public function run()
    {
        if (!isset($this->_param['opType']) && empty($this->_param['opType'])) {
            $this->_error[] = '[opType]为必须参数';
            return false;
        }
        $opType = $this->_param['opType'];
        switch ($opType) {
            //注册
            case 'register':
                echo $opType;
                break;
            //登陆
            case "login":
                echo $opType;
                break;
            default:
                $this->_error[] = '操作类型错误, 只能是register|login';
                return false;
        }

        if ($result['ask'] == 0) {
            $this->_error = $result['message'];
            return false;
        }
        if ($result['ask'] == 1 && isset($result['wb_code'])) {
            $this->_success['data']['wbCode'] = $result['wb_code'];
        } else {
            $this->_success = 1;
        }
        $this->_message = '操作成功';
        return true;
    }
}
