<?php
class Service_ProductQcOptions
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_ProductQcOptions|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_ProductQcOptions();
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
        $row['pqo_update_time']=date('Y-m-d H:i:s');
        return $model->add($row);
    }


    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "pqo_id")
    {
        $model = self::getModelInstance();
        $row['pqo_update_time']=date('Y-m-d H:i:s');
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "pqo_id")
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
    public static function getByField($value, $field = 'pqo_id', $colums = "*")
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

    public static function getByItemCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {
        $model = self::getModelInstance();
        $result = $model->getByCondition($condition, $type, $pageSize, $page, $order);
        if (!empty($result)) {
            foreach ($result as $key => $val) {
                $result[$val['pqo_id']] = $val;
            }
        }
        return $result;
    }

    /**
     * @param $val
     * @return array
     */
    public static function validator($val)
    {
        $validateArr = $error = array();
        
        $validateArr[] = array("name" =>EC::Lang('pqoName'), "value" =>$val["pqo_name"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('pqoNameEn'), "value" =>$val["pqo_name_en"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('pqoSort'), "value" =>$val["pqo_sort"], "regex" => array("positive"));
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'pqo_id',
              'E1'=>'pqo_name',
              'E2'=>'pqo_name_en',
              'E3'=>'pqo_sort',
              'E4'=>'pqo_update_time',
        );
        return $row;
    }

}