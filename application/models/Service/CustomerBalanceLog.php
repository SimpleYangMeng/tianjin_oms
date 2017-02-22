<?php
class Service_CustomerBalanceLog
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_CustomerBalanceLog|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_CustomerBalanceLog();
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
    public static function update($row, $value, $field = "cbl_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "cbl_id")
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
    public static function getByField($value, $field = 'cbl_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
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
        
              'E0'=>'cbl_id',
              'E1'=>'customer_code',
              'E2'=>'customer_id',
              'E3'=>'cbl_transaction_value',
              'E4'=>'cbl_value',
              'E5'=>'currency_rate',
              'E6'=>'currency_code',
              'E7'=>'cbl_note',
              'E8'=>'user_id',
              'E9'=>'fee_id',
              'E10'=>'cbl_current_value',
              'E11'=>'cbl_current_hold_value',
              'E12'=>'application_code',
              'E13'=>'cbl_refer_code',
              'E14'=>'cbl_add_time',
        );
        return $row;
    }
	
	public static function getTypeText($type){
		 //0:冻结; 1:解冻; 2:扣款; 3:入款
        $cblType = array(           
            '0'=>Ec_Lang::getInstance()->getTranslate('Reserved'),//'冻结',
            '1'=>Ec_Lang::getInstance()->getTranslate('Thaw'),//'解冻',
            '2'=>Ec_Lang::getInstance()->getTranslate('Debit'),//'扣款',
            '3'=>Ec_Lang::getInstance()->getTranslate('Depositing')//'入款'
        );				
		return $cblType[$type]?$cblType[$type]:'未知类型';
	}//	public function getTypeText(){
	
	
	public static function getCblReferTypes(){        
		$cblReferTypes = array(
        	//0:订单; 1:ASN; 2:产品;
        	'0'=>Ec_Lang::getInstance()->getTranslate('order'),
        	'1'=>Ec_Lang::getInstance()->getTranslate('asn'),
        	'2'=>Ec_Lang::getInstance()->getTranslate('product')
        		
        );
		return $cblReferTypes;
	}		
	
	public static function getCblReferTypeText($type){        
		$cblReferTypes = self::getCblReferTypes();
		return $cblReferTypes[$type];
	}

}