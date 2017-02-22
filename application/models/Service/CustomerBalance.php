<?php
class Service_CustomerBalance
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_CustomerBalance|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_CustomerBalance();
        }
        return self::$_modelClass;
    }

    /**
     * @param $row
     * @return mixed
     */
    public static function add($row)
    {
        $model = self::getModelInstance();
        return $model->add($row);
    }


    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "cb_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "cb_id")
    {
        $model = self::getModelInstance();
        return $model->delete($value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public static function getByField($value, $field = 'cb_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }
    public static function getForUpdate($cb_id) {
    	$model = self::getModelInstance();
    	return $model->getForUpdate($cb_id);
    }
    /**
     * @return mixed
     */
    public static function getAll()
    {
        $model = self::getModelInstance();
        return $model->getAll();
    }

    /**
     * @param array $condition
     * @param string $type
     * @param int $pageSize
     * @param int $page
     * @param string $order
     * @return mixed
     */
    public static function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {
        $model = self::getModelInstance();
        return $model->getByCondition($condition, $type, $pageSize, $page, $order);
    }

    /**
     * @param $val
     * @return array
     */
    public static function validator($val)
    {
        $validateArr = $error = array();
        
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'cb_id',
              'E1'=>'customer_code',
              'E2'=>'customer_id',
              'E3'=>'cb_value',
              'E4'=>'cb_hold_value',
              'E5'=>'cb_update_time',
        );
        return $row;
    }
	/*所有参考类型*/
	public static function getCblReferTypes(){
	
		$cblReferType = array(
        	//0:订单; 1:ASN; 2:产品;
        	'0'=>Ec_Lang::getInstance()->getTranslate('order'),
        	//'1'=>Ec_Lang::getInstance()->getTranslate('asn'),
        	'2'=>Ec_Lang::getInstance()->getTranslate('product')
        		
        );	
		return 	$cblReferType;
	
	}
	
	/*所有参考类型对应文本*/
	public static function getCblReferTypeText($cblReferType){
		
		switch($cblReferType){
				case '0':
					return Ec_Lang::getInstance()->getTranslate('order');
				break;
				case '1':
					return Ec_Lang::getInstance()->getTranslate('asn');
				break;
				case '2':
					return Ec_Lang::getInstance()->getTranslate('product');
				break;				
								
		}	
	
	}	//end function
	
	
	/*所有扣款类型*/
	public static function getCblTypes(){
		
        return  array(
            //0:冻结; 1:解冻; 2:扣款; 3:入款
            '0'=>Ec_Lang::getInstance()->getTranslate('Reserved'),//'冻结',
            '1'=>Ec_Lang::getInstance()->getTranslate('Thaw'),//'解冻',
            '2'=>Ec_Lang::getInstance()->getTranslate('Debit'),//'扣款',
            '3'=>Ec_Lang::getInstance()->getTranslate('Depositing')//'入款'
        );	
	
	}	//end function	


	/*所有扣款类型对应文本*/
	public static function getCblTypeText($cblType){
		
		switch($cblType){
				case '0':
					return Ec_Lang::getInstance()->getTranslate('Reserved');//'冻结',
				break;
				case '1':
					return Ec_Lang::getInstance()->getTranslate('Thaw');
				break;
				case '2':
					return Ec_Lang::getInstance()->getTranslate('Debit');
				break;	
				case '3':
					return Ec_Lang::getInstance()->getTranslate('Depositing');
				break;							
								
		}	
	
	}	//end function

}