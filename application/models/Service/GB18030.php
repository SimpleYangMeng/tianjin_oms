<?php
/**
 * 判断字符是否属于GB18030字符集
 * 
 * GB18030-2005判断标准
 * +---------+--------------------+--------+--------+-------------------------+
 * |类别     |码位范围            |码位数  |字符数  |字符类型                 |
 * +---------+--------------------+--------+--------+-------------------------+
 * |单字节   |0x00到0x7F          |128     |128     |ASCII码                  |
 * +---------+--------------------+--------+--------+-------------------------+
 * |双字节   |第一字节0xB0-0xF7   |6768    |6763    |汉字                     |
 * |         |--------------------|        |        |                         |
 * |         |第二字节0xA1-0xFE   |        |        |                         |
 * |         |--------------------------------------+-------------------------|
 * |         |第一字节0x81-0xA0   |6080    |6080    |汉字                     |
 * |         |--------------------|        |        |                         |
 * |         |第二字节0x40-0xFE   |        |        |                         |
 * |         |--------------------|--------|--------+-------------------------|
 * |         |第一字节0xAA-0xFE   |8160    |8160    |汉字                     |
 * |         |--------------------|        |        |                         |
 * |         |第二字节0x40-0xA0   |        |        |                         |
 * +---------+--------------------+--------+--------+-------------------------+
 * |四字节   |第一字节0x81-0x82   |6530    |6530    |CJK统一汉字扩充A         |
 * |         |--------------------|        |        |                         |
 * |         |第二字节0x30-0x39   |        |        |                         |
 * |         |--------------------|        |        |                         |
 * |         |第三字节0x81-0xFE   |        |        |                         |
 * |         |--------------------|        |        |                         |
 * |         |第四字节0x30-0x39   |        |        |                         |
 * |         |--------------------|--------|--------|-------------------------+
 * |         |第一字节0x95-0x98   |42711   |42711   |CJK统一汉字扩充B         |
 * |         |--------------------|        |        |                         |
 * |         |第二字节0x30-0x39   |        |        |                         |
 * |         |--------------------|        |        |                         |
 * |         |第三字节0x81-0xFE   |        |        |                         |
 * |         |--------------------|        |        |                         |
 * |         |第四字节0x30-0x39   |        |        |                         |
 * +-------- +--------------------+--------+--------+-------------------------+
 * 
 * 数据来源：http://www.qqxiuzi.cn/zh/hanzi-gb18030-bianma.php
 * 注意：mbstring在PHP 5.4之后才开始支持GB18030字符编码
 */
class Service_GB18030 {
  /**
   * 先决条件，判断系统是否支持GB18030字符编码
   * 
   * @return boolean    可用时返回TRUE，否则返回FALSE
   */
  public static function isUsable() {
    if (extension_loaded('mbstring')) { // 是否加载mbstring扩展
      return version_compare(PHP_VERSION, '5.4.0', '>='); // 判断当前PHP版本是否为5.4或以上
    }

    return FALSE;
  }

  /**
   * 验证内容是否属于字符集编码范围内
   * 
   * @param string  $content    需要验证的内容
   * @param boolean $debug      开启调试模式时，返回非字符集字符
   * @return mixed              字符集编码范围内返回TRUE，否则返回FALSE
   *                            mbstring不支持GB18030同样返回FALSE
   *                            开启调试模式，非字符集编码范围的字符将被返回
   */
  public static function isValid($content, $debug = FALSE) {
    if (!self::isUsable()) { // 当前PHP没有加载mbstring扩展或mbstring不支持GB18030字符集
      return TRUE; // 返回TRUE，忽略验证
    }

    $content = trim($content);
    $convert = mb_convert_encoding($content, 'GB18030', 'UTF-8'); // 把UTF-8编码转换为GB18030编码
    $length  = mb_strlen($convert, 'GB18030'); // 转码后内容长度
    $split   = array();
    $unvalid = array(); // 非字符集字符，字符编码 => 字符
    $isValid = TRUE;

    for ($i = 0; $i < $length; ++$i) { // 分隔字符
      $split[] = mb_substr($convert, $i, 1, 'GB18030');
    }

    foreach ($split as $word) { // 逐个字符验证
      switch (strlen($word)) { // 字节数判断
        case 1: // 单字节
          if (!self::isSingleByte($word)) {
            $unvalid[self::getOriginalCode($word)] = mb_convert_encoding($word, 'UTF-8', 'GB18030');
            $isValid                               = FALSE;
          }
          break ;

        case 2: // 双字节
          if (!self::isDoubleByte($word)) {
            $unvalid[self::getOriginalCode($word)] = mb_convert_encoding($word, 'UTF-8', 'GB18030');
            $isValid                               = FALSE;
          }
          break ;

        case 4: // 四字节
          if (!self::isQuadrupleByte($word)) {
            $unvalid[self::getOriginalCode($word)] = mb_convert_encoding($word, 'UTF-8', 'GB18030');
            $isValid                               = FALSE;
          }
          break ;

        default: // 其他的一律返回FALSE，调试模式除外
          $unvalid[self::getOriginalCode($word)] = mb_convert_encoding($word, 'UTF-8', 'GB18030');
          $isValid                               = FALSE;
          break ;
      }
    }

    if ($debug) { // 调试模式返回非字符集字符，若没有则返回TRUE
      return !empty($unvalid) ? $unvalid : TRUE;
    }

    return $isValid;
  }

  /**
   * 判断单字节编码是否属于字符集编码标准范围内
   * 
   * @param string $word    需要判断的字符
   * @return boolean
   */
  private static function isSingleByte($word) {
    $range = array(hexdec('00'), hexdec('7F'));
    $code  = ord($word);

    return ($code >= $range[0] && $code <= $range[1]);
  }

  /**
   * 判断双字节编码是否属于字符集编码标准范围内
   * 
   * @param string $word    需要判断的字符
   * @return boolean
   */
  private static function isDoubleByte($word) {
    $range = array(
      array(array(hexdec('B0'), hexdec('F7')), array(hexdec('A1'), hexdec('FE'))),
      array(array(hexdec('81'), hexdec('A0')), array(hexdec('40'), hexdec('FE'))),
      array(array(hexdec('AA'), hexdec('FE')), array(hexdec('40'), hexdec('A0')))
    );
    $code1 = ord($word[0]);
    $code2 = ord($word[1]);

    foreach ($range as $i => $r) { // 按情况验证各字节编码是否属于字符集编码范围
      if ( $code1 >= $r[0][0] && $code1 <= $r[0][1]
        && $code2 >= $r[1][0] && $code2 <= $r[1][1]
      ) {
        return TRUE;
      }
    }

    return FALSE;
  }

  /**
   * 判断四字节编码是否属于字符集编码标准范围内
   * 
   * @param string $word    需要判断的字符
   * @return boolean
   */
  private static function isQuadrupleByte($word) {
    $range = array(
      array(
        array(hexdec('81'), hexdec('82')),
        array(hexdec('30'), hexdec('39')),
        array(hexdec('81'), hexdec('FE')),
        array(hexdec('30'), hexdec('39'))
      ),
      array(
        array(hexdec('95'), hexdec('98')),
        array(hexdec('30'), hexdec('39')),
        array(hexdec('81'), hexdec('FE')),
        array(hexdec('30'), hexdec('39'))
      )
    );
    $code1 = ord($word[0]);
    $code2 = ord($word[1]);
    $code3 = ord($word[2]);
    $code4 = ord($word[3]);

    foreach ($range as $i => $r) { // 按情况验证各字节编码是否属于字符集编码范围
      if ( $code1 >= $r[0][0] && $code1 <= $r[0][1]
        && $code2 >= $r[1][0] && $code2 <= $r[1][1]
        && $code3 >= $r[2][0] && $code3 <= $r[2][1]
        && $code4 >= $r[3][0] && $code4 <= $r[3][1]
      ) {
        return TRUE;
      }
    }

    return FALSE;
  }

  /**
   * 获取字符原始码
   * 
   * @param string $word    需要转换的字符
   * @return string         字符编码，大写十六进制
   */
  private static function getOriginalCode($word) {
    $code   = '';
    $length = strlen($word); // 字节数

    for ($i = 0; $i < $length; ++$i) {
      $code .= sprintf('%02s', strtoupper(dechex(ord($word[$i]))));
    }

    return $code;
  }
}
