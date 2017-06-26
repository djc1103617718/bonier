<?php

namespace common\helpers;

class FileAide
{
    /**
     * 获得所有指定目录下的所有的文件名
     *
     * @param $path
     * @return array
     */
    public static function getAllFileName($path)
    {
        $fileNames = [];
        if (is_dir($path)) {
            if ($dh = opendir($path)) {
                while ((($file = readdir($dh)) !== false)) {
                    if ($file == '.' || $file == '..') {
                        continue;
                    }
                    $fileNames[] = $file;
                } closedir($dh);
            }
        }
        return $fileNames;
    }

    /**
     * 将驼峰命名转化为a-b-c这种形式的命名方式
     *
     * @param $str
     * @return string
     */
    public static function upperConvert($str) {
        $array  = [];
        $length = strlen($str);
        for ($i = 0; $i < $length; $i++) {
            if ($str[$i] == strtolower($str[$i])) {
                $array[] = $str[$i];
            } else {
                if ($i > 0) {
                    $array[] = '-';
                }
                $array[] = strtolower($str[$i]);
            }
        }
        return implode('', $array);
    }
}