<?php
class Service_ProductAttached
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_ProductAttached|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_ProductAttached();
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
    public static function update($row, $value, $field = "pa_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "pa_id")
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
    public static function getByField($value, $field = 'pa_id', $colums = "*")
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
     * 递归创建路径
     * @param $path
     */
    private static  function mkdirs($path)
    {
    	if (! file_exists($path))
    	{
    		self::mkdirs(dirname($path));
    		mkdir($path, 0777);
    	}
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
     * 获取自定义SQL语句查询结果
     *
     * @access	public
     * @param   string	($field		待返回的字段，默认为所有)
     * @param   string	($condition	查询条件)
     * @param	mixed	($value		待转换查询字段值)
     * @return	mixed
     */
    public static function getCustomQuery($field = '*', $condition = '', $value = '')
    {
    	$model = self::getModelInstance();
    	return $model->getCustomQuery($field, $condition, $value);
    }
    
    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'pa_id',
              'E1'=>'product_id',
              'E2'=>'pa_path',
              'E3'=>'pa_file_type',
              'E4'=>'pa_status',
              'E5'=>'languages_id',
              'E6'=>'pa_sort',
              'E7'=>'pa_update_time',
        );
        return $row;
    }
    /**
     * @createDate 2013-06-08
     * @author william-fan
     * @todo 插入链接图片
     */
    public static function addLink($picLinkArr,  $productId){
    	foreach($picLinkArr as $link){
    		$attRow = array(
    				"product_id"=>$productId,
    				"pa_path"=>$link,
    				"pa_file_type"=>"link",
    				"pa_status"=>"1",
    				"pa_update_time"=>date("Y-m-d H:i:s"),
    		);
    		if(!Service_ProductAttached::add($attRow)){
    			throw new Exception("添加图片信息出错",'50000');
    		}
    	}
    }
    /**
     * @author william-fan
     * @todo 用于处理上传图片
     */
    public static function copyImages($picUrlArr,$customerId,$productId){
    
    	// 		print_r($picUrlArr);
    	if(empty($picUrlArr)){
    		return false;
    	}
    	// 设置上传的路径
    	$basePath = APPLICATION_PATH."/../data/images/{$customerId}/{$productId}/";
    	// 		echo $basePath;exit;
    	self::mkdirs($basePath);
    	// 		新图片
    	
    	foreach ($picUrlArr as $v) {
    		$fileName = date('Ymdhis')."_".Common_Common::random(5).".jpg";
    		//             file_put_contents('dfdf.txt', APPLICATION_PATH."/../data/images".$v) ;
    		//echo APPLICATION_PATH."/../data/images".$v;
    		$oldFile = APPLICATION_PATH."/../data/images".$v;
    		if(file_exists($oldFile) && file_get_contents($oldFile)!==false){
    			$result = file_put_contents($basePath.$fileName, file_get_contents(APPLICATION_PATH."/../data/images".$v));
    			$attRow = array(
    					"product_id"=>$productId,
    					"pa_path"=>"/{$customerId}/{$productId}/{$fileName}",
    					"pa_file_type"=>"img",
    					"pa_status"=>"1",
    					"pa_update_time"=>date("Y-m-d H:i:s"),
    			);
    			self::add($attRow);
    		}
    	}
    
    }
    public static  function uploadImage($file,$customerId){
    	$return = array();
    	if(empty($file)){
    		return false;
    	}
    	$upload = new Ec_Upload($file);
    	$fileName = $customerId."_".date('Ymdhis')."_".Common_Common::random(5);
    	$file_path = $upload->upload($fileName, 'temp', '');
    	 
    	$fullFileName = $fileName.".".$upload->getStuffix();
    
    	$return['url'] =  "http://".$_SERVER['HTTP_HOST']."/default/product-image/view-upload-image/fileName/".$fullFileName;
    	$return['file_path'] =  $file_path;
    	/*
    	 // 	            缩略图
    	$path = "temp/".$fileName.".".$upload->getStuffix();
    	$thumbName = $fullFileName.".thumb";
    	$thumbPath = $upload->getThumb($path, $thumbName, 150, 150);
    	 
    	$return['thumb'] = "/merchant/product/view-upload-image/fileName/".$thumbName.".jpg";
    	*/
    	 
    	return $return;
    }
}