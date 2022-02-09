<?php

namespace Omatech\HourTeller;

use Exception;

class HourTeller
{
    public static function tell (string $hourMinute)
    {   
        self::checkInput($hourMinute);
        $hour=self::getHour($hourMinute);
        $minute=self::getMinute($hourMinute);

        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        //echo $f->format(12);die;
        $formated_minute=$f->format($minute);
        $formated_to_minute=$f->format(60-$minute,'0');

        $formated_hour=$f->format($hour);
        if ($hour==23)
        {
            $formated_to_hour='midnight';
        }
        else
        {
            $formated_to_hour=$f->format($hour+1,'0');
        }

        $messageConditions=[
            "It's $formated_hour o'clock" => fn($minute)=>$minute==0,
            "It's a half past $formated_hour" => fn($minute)=>$minute==30,
            "It's a quarter past $formated_hour" => fn($minute)=>$minute==15,
            "It's a quarter to $formated_to_hour" => fn($minute)=>$minute==45,
            "It's $formated_to_minute minute to $formated_to_hour" => fn($minute)=>$minute==59,
            "It's $formated_minute minute past $formated_hour" => fn($minute)=>$minute==1,
            "It's $formated_to_minute minutes to $formated_to_hour" => fn($minute)=>$minute>30,
            "It's $formated_minute minutes past $formated_hour" => fn($minute)=>true
        ];

        foreach ($messageConditions as $message=>$condition)
        {
            if($condition($minute)) return $message;
        }

    }

    public static function checkInput(string $hourMinute)
    {
        $hourMinuteArray=self::convertToArray($hourMinute);
        if(!isset($hourMinuteArray[0]) || !isset($hourMinuteArray[1])
        || !is_numeric($hourMinuteArray[0]) || !is_numeric($hourMinuteArray[1]))
        {
            throw new Exception("Invalid date format use hh24:mi\n");
        }

        $hour=(int)$hourMinuteArray[0];
        $minutes=(int)$hourMinuteArray[1];

        if ($hour<0 || $hour>23)
        {
            throw new Exception("Invalid date format use hh24:mi\n");
        }

        if ($minutes<0 || $minutes>59)
        {
            throw new Exception("Invalid date format use hh24:mi\n");
        }
    }

    public static function getHour(string $hourMinute)
    {
        return self::convertToArray($hourMinute)[0];
    }

    public static function getMinute(string $hourMinute)
    {
        return self::convertToArray($hourMinute)[1];
    }

    public static function convertToArray(string $hourMinute): array
    {
        return explode(':', $hourMinute);
    }
}