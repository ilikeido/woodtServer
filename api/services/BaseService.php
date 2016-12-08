<?php
namespace api\services;

class BaseService
{
    public static function format_date($time) {
        if (is_string($time)){
            $time = strtotime($time);
        }
        $nowtime = time();
        $difference = $nowtime - $time;
        switch ($difference) {

            case $difference <= '60' :
                $msg = '刚刚';
                break;

            case $difference > '60' && $difference <= '3600' :
                $msg = floor($difference / 60) . '分钟前';
                break;

            case $difference > '3600' && $difference <= '86400' :
                $msg = floor($difference / 3600) . '小时前';
                break;

            case $difference > '86400' && $difference <= '2592000' :
                $msg = floor($difference / 86400) . '天前';
                break;

            case $difference > '2592000' &&  $difference <= '7776000':
                $msg = floor($difference / 2592000) . '个月前';
                break;
            case $difference > '7776000':
                $msg = '很久以前';
                break;
        }

        return $msg;
    }
   
}

?>