<?php
namespace api\services;

class BaseService
{
    public static function getImageBasePath(){
      return 'http://static.testwoodt.com';
    }

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

    public static function ubb2html($Text){
        $Text=trim($Text);
        //$Text=htmlspecialchars($Text);
        $Text=preg_replace("/\\t/is","  ",$Text);
        $Text=preg_replace("/\[h1\](.+?)\[\/h1\]/is","<h1>\\1</h1>",$Text);
        $Text=preg_replace("/\[h2\](.+?)\[\/h2\]/is","<h2>\\1</h2>",$Text);
        $Text=preg_replace("/\[h3\](.+?)\[\/h3\]/is","<h3>\\1</h3>",$Text);
        $Text=preg_replace("/\[h4\](.+?)\[\/h4\]/is","<h4>\\1</h4>",$Text);
        $Text=preg_replace("/\[h5\](.+?)\[\/h5\]/is","<h5>\\1</h5>",$Text);
        $Text=preg_replace("/\[h6\](.+?)\[\/h6\]/is","<h6>\\1</h6>",$Text);
        $Text=preg_replace("/\[separator\]/is","",$Text);
        $Text=preg_replace("/\[align=(.+?)\](.+?)\[\/align\]/is","<p align=\"\\1\">\\2</p>",$Text);
        $Text=preg_replace("/\[center\](.+?)\[\/center\]/is","<center>\\1</center>",$Text);
        $Text=preg_replace("/\[url=http:\/\/([^\[]*)\](.+?)\[\/url\]/is","<a href=\"http://\\1\" target=_blank>\\2</a>",$Text);
        $Text=preg_replace("/\[url=([^\[]*)\](.+?)\[\/url\]/is","<a href=\"http://\\1\" target=_blank>\\2</a>",$Text);
        $Text=preg_replace("/\[url\]http:\/\/([^\[]*)\[\/url\]/is","<a href=\"http://\\1\" target=_blank>\\1</a>",$Text);
        $Text=preg_replace("/\[url\]([^\[]*)\[\/url\]/is","<a href=\"\\1\" target=_blank>\\1</a>",$Text);
        $Text=preg_replace("/\[img\](.+?)\[\/img\]/is","<img src=\"\\1\" class=\"fresco\" alt=\"\"/>",$Text);
        $Text=preg_replace("/\[color=(.+?)\](.+?)\[\/color\]/is","<font color=\\1>\\2</font>",$Text);
        $Text=preg_replace("/\[size=(.+?)\](.+?)\[\/size\]/is","<font size=\\1>\\2</font>",$Text);
        $Text=preg_replace("/\[sup\](.+?)\[\/sup\]/is","<sup>\\1</sup>",$Text);
        $Text=preg_replace("/\[sub\](.+?)\[\/sub\]/is","<sub>\\1</sub>",$Text);
        $Text=preg_replace("/\[pre\](.+?)\[\/pre\]/is","<pre>\\1</pre>",$Text);
        $Text=preg_replace("/\[i\](.+?)\[\/i\]/is","<i>\\1</i>",$Text);
        $Text=preg_replace("/\[u\](.+?)\[\/u\]/is","<u>\\1</u>",$Text);
        $Text=preg_replace("/\[b\](.+?)\[\/b\]/is","<b>\\1</b>",$Text);
        $Text=preg_replace("/\[quote\](.+?)\[\/quote\]/is"," <div class='quote'><h5>引用:</h5><blockquote>\\1</blockquote></div>", $Text);
        $Text=preg_replace("/\\n/is","<br/>",$Text);
        return $Text;
    }
   
}

?>