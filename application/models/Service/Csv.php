<?php
class Service_Csv {
  const CSV_WRAPPER   = '"';
  const CSV_DELIMITER = ',';
  const CSV_EOF       = "\r\n";
  const CSV_CHARSET   = 'GBK';

  /**
   * 下载CSV需要发送的HEADER，在任何输出之前调用
   */
  public static function sendHeader($filename = 'CSV-ATTACHMENT') {
    header('Content-Type: text/csv; charset=' . self::CSV_CHARSET);
    header('Content-Disposition: attachment; filename=' . $filename . '.csv');
    header('Expires: 0');
    header('Pragma: public');
  }

  /**
   * 转换内容
   * 
   * @param string|array $original
   * @param boolean      $eof
   * @return string
   */
  public static function convert($original, $eof = FALSE) {
    if (is_array($original)) {
      foreach ($original as $key => $value) {
        $original[$key] = self::filtrate($value);
      }

      $original = implode(self::CSV_DELIMITER, $original);
    }
    else {
      $original = self::filtrate($original);
    }

    if ('UTF-8' !== self::CSV_CHARSET) {
      $original = mb_convert_encoding($original, self::CSV_CHARSET, 'UTF-8');
    }

    if ($eof) {
      $original .= self::CSV_EOF;
    }

    return $original;
  }

  /**
   * 过滤回车、换行符，转义界定符
   * 
   * @param string $content
   * @return string
   */
  private static function filtrate($content) {
    $content = str_replace(array("\r", "\n"), '', $content); // 去除回车、换行
    $content = str_replace(self::CSV_WRAPPER, self::CSV_WRAPPER . self::CSV_WRAPPER, $content); // 转义CSV_WRAPPER
    $content = self::CSV_WRAPPER . $content . self::CSV_WRAPPER;

    return $content;
  }
}
