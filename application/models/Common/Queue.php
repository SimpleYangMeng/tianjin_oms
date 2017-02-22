<?php

/**
 *
 */
class Common_Queue
{
    const PAGESIZE = 100;
    const TABLE = 'api_message';

    private static $instance = array(); //  实例
    /**
     * 取得实例
     * @param  string $type [description]
     * @return [type]       [description]
     */
    public static function getInstance($type = '')
    {
        if (isset(self::$instance[$type]) && self::$instance[$type]) {
            return self::$instance[$type];
        }

        $class = $type . 'Queue';
        $classPath = APPLICATION_PATH . "/models/Common/Queue/{$class}.php";
        if (!file_exists($classPath)) {
            throw new Exception("[{$type}]不存在！");
        }
        include_once $classPath;
        if (!class_exists($class)) {
            throw new Exception("[{$type}]不存在！");
        }

        self::$instance[$type] = new $class($type);
        return self::$instance[$type];
    }

    /**
     * 批量插入构造
     * @return [type] [description]
     */
    public static function insertBatch($insertRows)
    {
        if (empty($insertRows)) {
            return;
        }

        $insertValue = $insertKey = '';

        foreach ($insertRows as $insertRow) {
            if ($insertKey == '') {
                $insertKey = self::splicingSqlString($insertRow, 'key');
            }
            $insertValue .= self::splicingSqlString($insertRow, 'value') . ',';
        }
        $insertValue = rtrim($insertValue, ',');
        return $insertKey . ' VALUES ' . $insertValue;

    }

    public static function splicingSqlString($array, $type = 'key')
    {
        $string = '(';
        foreach ($array as $key => $value) {
            if ($type == 'key') {
                $string .= "`{$key}`,";
            } else {
                $string .= "'{$value}',";
            }

        }
        $string = rtrim($string, ',') . ')';
        return $string;
    }

    /**
     * [debug description]
     * @param  [type] $msg [description]
     * @return [type]      [description]
     */
    public static function debug($message = '')
    {
        $dateTime = '['.date('Y-m-d H:i:s').']';
        echo $dateTime.$message . "\n\t";
    }
}
