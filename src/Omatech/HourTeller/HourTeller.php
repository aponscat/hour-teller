<?php

namespace Omatech\HourTeller;

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

        if ($minute==0)
        {
            return "It's $formated_hour o'clock";
        }

        if ($minute==30)
        {
            return "It's a half past $formated_hour";
        }

        if ($minute==15)
        {
            return "It's a quarter past $formated_hour";
        }

        if ($minute==45)
        {
            return "It's a quarter to $formated_to_hour";
        }

        if ($minute==59)
        {
            return "It's $formated_to_minute minute to $formated_to_hour";
        }

        if ($minute==1)
        {
            return "It's $formated_minute minute past $formated_hour";
        }

        if ($minute>30)
        {
            return "It's $formated_to_minute minutes to $formated_to_hour";
        }
        else
        {
            return "It's $formated_minute minutes past $formated_hour";
        }

        return "Ups, not controlled!";
    }

    public static function checkInput(string $hourMinute)
    {
        $hourMinuteArray=self::convertToArray($hourMinute);
        assert(isset($hourMinuteArray[0]) && isset($hourMinuteArray[1])
        && is_numeric($hourMinuteArray[0]) && is_numeric($hourMinuteArray[1]));

        $hour=(int)$hourMinuteArray[0];
        $minutes=(int)$hourMinuteArray[0];

        assert($hour>=0 && $hour<=23);
        assert($minutes>=0 && $minutes<=59);
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