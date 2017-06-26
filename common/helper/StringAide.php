<?php

namespace common\helper;

class StringAide
{
    /**
     * 获取字符串长度
     *
     * @param $str
     * @return int
     */
    public static function strLength($str)
    {
        preg_match_all("/./us", $str, $matches);
        return count(current($matches));
    }

    /**
     * 计算含中文的字符串的实际长度
     *
     * @param $str
     * @param string $encoding
     * @return bool|int
     */
    /*public static function mbstrlen($str,$encoding="utf8")
    {

        if (($len = strlen($str)) == 0) {
            return 0;
        }

        $encoding = strtolower($encoding);

        if ($encoding == "utf8" or $encoding == "utf-8") {
            $step = 3;
        } elseif ($encoding == "gbk" or $encoding == "gb2312") {
            $step = 2;
        } else {
            return false;
        }

        $count = 0;
        for ($i=0; $i<$len; $i++) {
            $count++;
            //如果字节码大于127，则根据编码跳几个字节
            if (ord($str{$i}) >= 0x80) {
                $i = $i + $step - 1;//之所以减去1，因为for循环本身还要$i++
            }
        }
        return $count;
    }*/


    /**
     * 判断字符串是否为整数
     *
     * @param $value
     * @return bool
     */
    public static function isInteger($value) {
        if (is_numeric($value) && is_int($value+0)) {
            return true;
        }
        return false;
    }
}