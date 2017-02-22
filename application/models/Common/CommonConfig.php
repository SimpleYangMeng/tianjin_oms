<?php
class Common_CommonConfig
{
    /**
     * @author william-fan
     * @todo  获取进出口标志
     */
    public static function getIeType($lang = 'zh_CN')
    {
        $tmpArr = array(
            'zh_CN' => array(
                'BI' => '保税进口',
                'BE' => '保税出口',
            ),
            'en_US' => array(
                'BI' => 'import',
                'BE' => 'export',
            )
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmpArr[$lang]) ? $tmpArr[$lang] : $tmpArr;
    }

    /**
     * @author william-fan
     * @todo  获取进出口标志
     */
    public static function getIeType2($lang = 'zh_CN')
    {
        $tmpArr = array(
            'zh_CN' => array(
                'I' => '进口',
                'E' => '出口',
            ),
            'en_US' => array(
                'I' => 'import',
                'E' => 'export',
            )
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmpArr[$lang]) ? $tmpArr[$lang] : $tmpArr;
    }
    /**
     * @author william-fan
     * @todo 主管海关
     */
    public static function getcustomsInfo(){
        $iePorts = Service_IePort::getAll();
        return $iePorts;
    }
    /**
     * @author william-fan
     * @todo 用于获取商品的状态
     */
    public static function getProductStatus($lang = 'zh_CN'){
      /*  $tmpArr = array(
            'zh_CN' => array(
                '2'=>'草稿',
                '3'=>'已提交',
                '1'=>'已备案',
                '4'=>'审核不通过'
            ),//做双语言时候在修改
            'en_US' => array(
                '2'=>'草稿',
                '3'=>'已提交',
                '1'=>'已备案',
                '4'=>'审核不通过'
            )


        );
       */
        $tmpArr = array(
            'zh_CN' => array(
                '2' => '待发送海关',
				'5' => '已发送海关',
				'7' => '海关已接收',
                '1' => '海关已审核',
                '4' => '审核不通过',
                '6' => '停用',

            ), //做双语言时候在修改
            'en_US' => array(
                '2' => '待发送海关',
				'5' => '已发送海关',
				'7' => '海关已接收',
                '1' => '海关已审核',
                '4' => '审核不通过',
                '6' => '停用',
            )
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmpArr[$lang]) ? $tmpArr[$lang] : $tmpArr;
    }

    /**
     * 订单业务状态
     * @param  string $lang [description]
     * @return [type]       [description]
     */
    public static function getOrderAppStatus($lang = 'zh_CN')
    {
        $tmpArr = array(
            'zh_CN' => array(
                1 => '暂存',
                2 => '申报',
            ),
            'en_US' => array(
                1 => '暂存',
                2 => '申报',
            )
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmpArr[$lang]) ? $tmpArr[$lang] : $tmpArr;
    }

    /**
     * 订单类型
     * @param  string $lang [description]
     * @return [type]       [description]
     */
    public static function getOrderModeType($lang = 'zh_CN')
    {
        $tmpArr = array(
            'zh_CN' => array(
                0 => '备货模式',
                1 => '集货模式',
            ),
            'en_US' => array(
                0 => '备货模式',
                1 => '集货模式',
            )
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmpArr[$lang]) ? $tmpArr[$lang] : $tmpArr;
    }
    /**
     * @author wiliam-fan
     * @todo 用于获取业务类型
     */
    public static function getFormType($type='I'){
        $condition = array(
            'is_display'=>'1'
        );
        if(is_string($type)){
            switch(strtoupper($type)) {
                case 'I':
                    $condition['form_type'] = array('E2A');
                    break;
                case 'E':
                    $condition['form_type'] = array('BE','NE');
                    break;
            }
        }
        $result =  Service_FormType::getByCondition($condition,'*');
        return $result;
    }

}
