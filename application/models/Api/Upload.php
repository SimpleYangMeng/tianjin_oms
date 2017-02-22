<?php
require_once("PHPExcel.php");
require_once("PHPExcel/Reader/Excel2007.php");
require_once("PHPExcel/Reader/Excel5.php");
// require_once ('PHPExcel/IOFactory.php');
class Common_Upload
{
    /**
     * 读取CSV文件
     * @param string $filePath
     * @return array
     */
    public static function readCSV($filePath)
    {
		setlocale(LC_ALL,'zh_CN');
		$file = fopen($filePath,"r");
		$data = array();       
        while($row = fgetcsv($file))
 		 {		 
		 	foreach($row as &$v){
				$v=mb_convert_encoding(trim($v), "UTF-8", "GBK");
			}
  			$data[] = $row;
  		}
        return $data;
    }


    public static function readCSV1($filePath)
    {
        $content = file_get_contents($filePath);
		$content=mb_convert_encoding($content, "UTF-8", "GBK");
        $arr = preg_split('/\n/', $content);
        $data = array();
        foreach ($arr as $k => $v) {
            if ($v) {
                $data[] = explode(",", trim($v));
            }
        }
        return $data;
    }	
	

    /**
     * 读取EXCEL文件
     * @param string $filePath
     * @return array
     */
    public static function readEXCEL($filePath)
    {
		//$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;  
		//$cacheSettings = array();  
		//PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings); 	

   		//$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_discISAM;
       // $cacheSettings = array();
        //PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        $PHPExcel = new PHPExcel();
		
	
		
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($filePath)) {
            $PHPReader = new PHPExcel_Reader_Excel5();
            if (!$PHPReader->canRead($filePath)) {
                return "Invalid File.";
            }
        }
        $PHPExcel = $PHPReader->load($filePath);
        $currentSheet = $PHPExcel->getSheet(0);

        /**取得一共有多少列*/
        $maxColumn = $currentSheet->getHighestColumn();
        /**取得一共有多少行*/
        $rowCount = $currentSheet->getHighestRow();
        $result = array();
        //$ColumnArr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP');
        if(strlen($maxColumn)==1){
        	for($i="A";$i<=$maxColumn;$i++){
        		$ColumnArr[] = $i;
        	}
        }elseif(strlen($maxColumn)==2){
        	$firstZimu = $maxColumn{0};
        	$secondZimu = $maxColumn{1};
        	if($firstZimu=='A'){
        		//第一个字母为A
        		$ColumnArr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        		for($i='A';$i<=$secondZimu;$i++){
        			$ColumnArr[]='A'.$i;
        		}
        	}else{
        		//第一个字母不为A情况
        		return array();
        	}
        }else{
        	//错误
        	return array();
        }
        
        for ($row = 1; $row <= $rowCount; $row++) {
            $totalLen = 0; //记录行总长度
            //for ($column = "A"; $column <= $maxColumn; $column++) {
            for ($c_Column= 0;$c_Column < count($ColumnArr); $c_Column++) {	

            	//echo $column.'<br/>';
                $value = $currentSheet->getCell($ColumnArr[$c_Column].$row)->getValue();
                if (is_object($value)) {
                    $value = $value->__toString();
                }
                $result[$row][] = trim($value);
                $totalLen += strlen(trim($value));
            }
            if ($totalLen == 0) unset($result[$row]); //去掉空行
        }
        return array_values($result);
    }
	
	
	
}