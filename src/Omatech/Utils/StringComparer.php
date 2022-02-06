<?php

namespace Omatech\Utils;

class StringComparer
{
    public static function compare ($str1, $str2)
    {
        $chars1 = str_split($str1);
        $chars2 = str_split($str2);
        $resString='';
        foreach ($chars1 as $key=>$char1) {
            if (isset($chars2[$key]))
            {
                if ($char1==$chars2[$key])
                {
                    $resString.=' ';
                }
                else
                {
                    $resString.='*';
                }
            }
            else
            {
                $resString.='-';
            }
        }
        return $resString;
    }
}