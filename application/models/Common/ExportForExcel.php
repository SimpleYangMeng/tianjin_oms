<?php

/**
 * 导出excel格式
 * @author luffyzhao
 * $object = new Common_ExportForExcel(array());
 * $object -> setSheet();
 * $index = $object -> setRowsValue(array(
 *     array('序号' , '姓名' , '考分')
 * ));
 *
 * $object -> setRowsValue(array( *
 *     array('02' , 'luffyzhao' ， '100'),
 *     array('03' , 'william' ， '95'),
 *     array('04' , 'danile' ， '98')
 * ),$index , function($index){
 *     if($index == 2){
 *         return Common_ExportForExcel::TYPE_NUMERIC;
 *     }elseif($index == 0){
 *         return Common_ExportForExcel::TYPE_STRING2;
 *     }
 * });
 *
 * $object->save('2015年上学期成绩单');
 *
 */
require_once APPLICATION_PATH . '/../libs/PHPExcel1.8/PHPExcel.php';
require_once APPLICATION_PATH . '/../libs/PHPExcel1.8/PHPExcel/IOFactory.php';
require_once APPLICATION_PATH . '/../libs/PHPExcel1.8/PHPExcel/Settings.php';


class Common_ExportForExcel{
    const TYPE_STRING2  = 'str';
    const TYPE_STRING   = 's';
    const TYPE_FORMULA  = 'f';
    const TYPE_NUMERIC  = 'n';
    const TYPE_BOOL     = 'b';
    const TYPE_NULL     = 'null';
    const TYPE_INLINE   = 'inlineStr';
    const TYPE_ERROR    = 'e';

    private $table = null;
    private $activeSheet = null;
    private $rules;
    private $config = array(
        'font_name' => '宋体',
        'font_size' => 10,
        'storage'   =>  PHPExcel_CachedObjectStorageFactory::cache_to_discISAM
    );

    /**
     * 构造函数
     * @param array $config [description]
     */
    public function __construct(array $config)
    {
        $this->config = array_merge($this->config , $config);

        $this->setCacheStorageMethod();

        $table = new PHPExcel();

        $table -> getDefaultStyle()->getFont()->setName($this->config['font_name']);
        $table -> getDefaultStyle()->getFont()->setSize($this->config['font_size']);

        $this->table = $table;
    }

    /**
     * 设置行组信息
     * @author luffyzhao
     * @param array $rows [description]
     * @param int $index 从index行开始
     * @param object $callBack 回调函数，争对单元格式进行设置
     * @return int $index 插入到index行
     */
    public function setRowsValue(array $rows , $index = 1 , $callBack = null)
    {
        if($this->activeSheet == null)
            throw new Exception("Error Processing Request", 1);

        if(empty($rows)){
            return $index;
        }
        foreach ($rows as $values) {
            foreach ($values as $key => $cellValue) {

                $cellType = $this->getCellRule($key , $callBack);
                $pCoordinate = $this->charToABC($key).$index;

                if($cellType == false || $cellValue == ''){
                    $this->activeSheet->setCellValue($pCoordinate , $cellValue);
                }else{
                    $this->activeSheet->setCellValueExplicit($pCoordinate , $cellValue , $cellType);
                }

            }
            $index ++;
        }

        return $index;
    }

    /**
     * [save description]
     * @author luffyzhao
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function save($name = 'order')
    {
        //不直接输出php://output防止内存溢出
        $tempFileName = APPLICATION_PATH.'/../data/cache/'.md5($name).microtime().rand(0,99999).'xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($this->table, 'Excel2007');
        $objWriter->save($tempFileName);
        $fp = fopen($tempFileName , "r");
        $file_size = filesize($tempFileName);
        header( "Pragma: public" );
        header( "Expires: 0" );
        header("Accept-Ranges: bytes");
        header('cache-control:must-revalidate');
        header("Content-Disposition: attachment; filename={$name}".date("YmdHis").".xlsx");
        header("Content-Type:APPLICATION/OCTET-STREAM;charset=utf-8");
        $buffer = 1024;
        $file_count = 0;
        //向浏览器返回数据
        while(!feof($fp) && $file_count < $file_size){
            $file_con = fread($fp,$buffer);
            $file_count += $buffer;
            echo $file_con;
            ob_flush();
            flush();
        }
        fclose($fp);
        unlink($tempFileName);
        // $objWriter->save('php://output');
    }

    public function saveByFile()
    {
        $tempFileName = APPLICATION_PATH.'/../data/cache/saveByfile_'. microtime().rand(0,99999).'.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($this->table, 'Excel2007');
        $objWriter->save($tempFileName);
        return $tempFileName;
    }

    /**
     * 获取单元行格式
     * @author luffyzhao
     * @param  string $value [description]
     * @return [type]        [description]
     */
    private function getCellRule($key , $callBack)
    {
        if(isset($this->rules[$key]) && $this->rules[$key] != ''){
            return $this->rules[$key];
        }else{
            if(is_object($callBack)){
                return $callBack($key);
            }
        }
    }

    /**
     * 设置单元格宽度
     * @author luffyzhao
     * @param string|int $column 列
     * @param int|object $width 宽
     */
    public function setWidth($column = 'A' , $width = 15){
        if($this->activeSheet == null){
            throw new Exception("Error Processing Request", 1);
        }
        if(is_object($width)){
            $width = $width($column);
        }
        if(is_numeric($column)){
            $column = $this->charToABC($column);
        }

        $this->activeSheet->getColumnDimension($column)->setWidth($width);
    }

    /**
     * 设置使用数据表
     * @param integer $index [description]
     */
    public function setSheet($index=0)
    {
        if($this->table == null)
            throw new Exception("phpExcel对象不存在");

        $this->activeSheet = $this->table->setActiveSheetIndex($index);
    }

    /**
     * 设置格式
     * @param array $rules [description]
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * 数字序列转excel序列
     * @param  integer $numeric [description]
     * @return [type]           [description]
     */
    private function charToABC($numeric = 0){
        $strABD = '';
        if($numeric > 25){
            $first = ceil($numeric / 26);
            (26 * $first == $numeric) && $first += 1;
            if($first > 26){//只能二位字母
                return false;
            }else{
                $strABD .=   chr($first+63);
            }
            // echo $numeric % 27;
            $strABD .= chr(($numeric % 26) + 65);
        }else{
            // echo ($numeric % 27).'-';
            $strABD .= chr(($numeric % 26) + 65);
        }

        return $strABD;
    }

    /**
     * 设置缓存方法
     */
    private function setCacheStorageMethod()
    {
        if($this->config['storage'] == PHPExcel_CachedObjectStorageFactory::cache_to_discISAM){
            $dir = APPLICATION_PATH.'/../data/cache/phpexcel/';
            if(!is_dir($dir)){
                mkdir($dir , 0755);
            }
            $cacheSettings = array('dir' => $dir);
        }elseif($this->config['storage'] == PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp){
            $cacheSettings = array('memoryCacheSize' => '50MB');
        }else{
            $cacheSettings = array();
        }

        $phpExcelSetting = PHPExcel_Settings::setCacheStorageMethod($this->config['storage'] , $cacheSettings);

        if(!$phpExcelSetting){
            throw new Exception("设置缓存失败！");
        }
    }
}
