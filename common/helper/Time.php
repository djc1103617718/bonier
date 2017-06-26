<?php

namespace common\helper;

class Time
{
    /**
     * 昨天开始的时间
     *
     * @return int
     */
    public static function getTheDayBeforeStartTime()
    {
        return strtotime(date('Y-m-d')) - 3600*24;
    }

    /**
     * 昨天结束的时间(今天开始的时间)
     *
     * @return int
     */
    public static function getTheDayBeforeEndTime()
    {
        return strtotime(date('Y-m-d'));
    }

    public static function dateFormat($time)
    {
        if (!$time) {
            $time = time();
        }
        return date('Y-m-d H:i:s', $time);
    }
}