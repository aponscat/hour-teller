<?php

$autoload_location = '/vendor/autoload.php';
$tries=0;
while (!is_file(__DIR__.$autoload_location))
{
 $autoload_location='/..'.$autoload_location;
 $tries++;
 if ($tries>10) die("Error trying to find autoload file\n");
}
require_once __DIR__.$autoload_location;

use Omatech\HourTeller\HourTeller;

do {
    $hour=random_int(0,11);
    $minute=str_pad(random_int(0,59),2,'0',STR_PAD_LEFT);
    $input=readline("Enter hour string for $hour:$minute:");
    try
    {
        echo HourTeller::tell("$hour:$minute")."\n";
        if (HourTeller::tell("$hour:$minute")==$input)
        {
            echo "Good job!\n";
        }
        else
        {
            echo "Buuuuuuh\n";
        }
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
} while ($input!='end');

