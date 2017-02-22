<?php
/**
 * Luffy丶大叔💯 
 * ============================================================================
 * ----------------------------------------------------------------------------
 * <><><><><><><><><><><><><>有妹子加微信不哦！~<><><><><><><><><><><><><><><><>
 * ----------------------------------------------------------------------------
 * ============================================================================
 * $Author: Luffy💯 $
 * 16:11:42Z Luffy💯 $
 */


class ExportExcel {
    
    public static $cacheTemp;
    
    /**
     * 写八一行数据
     * @param type $rowArray
     * @throws Exception
     */
    public static function writeRow($rowArray = array()) {
        if(empty($rowArray)){
            throw new Exception("Data is empty！");
        }else{
            self::$cacheTemp    .= self::setLineStart();
            foreach ($rowArray as $column) {
                self::$cacheTemp    .= self::setCell($column);
            }    
            self::$cacheTemp    .= self::setLineEnd();
        }
    }
    
    
    public static function save($fileName  =   "") {
        if($fileName == ''){
            $fileName = date("Y-m-d")."xls";            
        }
        self::$cacheTemp = self::setStart() . self::$cacheTemp .self::setEnd();
        
        header('Pragma:public');
        header('Content-Type:application/x-msexecl;name="' . $fileName );
        header("Content-Disposition:inline;filename=" . $fileName );            
        echo self::$cacheTemp;

    }

    /**
     * 
     * @return string
     */
    public static function setEnd() {
        return "</table>";
    }
    /**
     * 
     * @return string
     */
    public static function setStart() {
        return '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><table border="1">';
    }
    /**
     * 
     * @param type $pValue
     * @param style 文本：vnd.ms-excel.numberformat:@ vnd.ms-excel.numberformat:yyyy/mm/dd vnd.ms-excel.numberformat:#,##0.00 vnd.ms-excel.numberformat:￥#,##0.00 vnd.ms-excel.numberformat: #0.00% 
     * @return type
     */
    public static function setCell($pValue, $style = ""){
        return "<td style='{$style}'>{$pValue}</td>";
    }
    /**
     * 
     * @return string
     */
    public static function setLineStart() {
        return "<tr>";
    }
    /**
     * 
     * @return string
     */
    public static function setLineEnd() {
        return "</tr>";
    }
    
    
}
