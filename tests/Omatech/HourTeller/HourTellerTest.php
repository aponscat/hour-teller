<?php declare(strict_types=1);


use PHPUnit\Framework\TestCase;
use Omatech\HourTeller\HourTeller;

final class HourTellerTest extends TestCase
{

    public function testOClock(): void
    {        
        $this->assertTrue("It's 9 o'clock"===HourTeller::tell('9:00'));
        $this->assertTrue("It's 11 o'clock"===HourTeller::tell('11:00'));
        $this->assertTrue("It's 12 o'clock"===HourTeller::tell('12:00'));
        $this->assertTrue("It's 15 o'clock"===HourTeller::tell('15:00'));
    }

    public function testHalfs(): void
    {        
        $this->assertTrue("It's a half past 9"===HourTeller::tell('9:30'));
        $this->assertTrue("It's a half past 11"===HourTeller::tell('11:30'));
        $this->assertTrue("It's a half past 12"===HourTeller::tell('12:30'));
        $this->assertTrue("It's a half past 15"===HourTeller::tell('15:30'));
    }

    public function testQuarters(): void
    {        
        $this->assertTrue("It's a quarter past 9"===HourTeller::tell('9:15'));
        $this->assertTrue("It's a quarter past 11"===HourTeller::tell('11:15'));
        $this->assertTrue("It's a quarter to 12"===HourTeller::tell('11:45'));
        $this->assertTrue("It's a quarter to 15"===HourTeller::tell('16:45'));
    }

    public function testMinutesPast(): void
    {        
        $this->assertTrue("It's 23 minutes past 9"===HourTeller::tell('9:23'));
        $this->assertTrue("It's 13 minutes past 11"===HourTeller::tell('11:13'));
        $this->assertTrue("It's 29 minutes past 12"===HourTeller::tell('12:29'));
        $this->assertTrue("It's 7 minutes past 15"===HourTeller::tell('15:07'));
    }

    public function testMinutesTo(): void
    {        
        $this->assertTrue("It's 29 minutes to 9"===HourTeller::tell('8:31'));
        $this->assertTrue("It's 12 minutes to 11"===HourTeller::tell('10:48'));
        $this->assertTrue("It's 9 minutes to 12"===HourTeller::tell('11:48'));
        $this->assertTrue("It's 23 minutes to 15"===HourTeller::tell('16:37'));
    }


}
