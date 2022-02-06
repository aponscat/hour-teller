<?php declare(strict_types=1);


use PHPUnit\Framework\TestCase;
use Omatech\HourTeller\HourTeller;

final class HourTellerTest extends TestCase
{

    public function testOClock(): void
    {        
        $this->assertTrue("It's nine o'clock"===HourTeller::tell('9:00'));
        $this->assertTrue("It's eleven o'clock"===HourTeller::tell('11:00'));
        $this->assertTrue("It's twelve o'clock"===HourTeller::tell('12:00'));
        $this->assertTrue("It's fifteen o'clock"===HourTeller::tell('15:00'));
    }

    public function testHalfs(): void
    {        
        $this->assertTrue("It's a half past nine"===HourTeller::tell('9:30'));
        $this->assertTrue("It's a half past eleven"===HourTeller::tell('11:30'));
        $this->assertTrue("It's a half past twelve"===HourTeller::tell('12:30'));
        $this->assertTrue("It's a half past fifteen"===HourTeller::tell('15:30'));
    }

    public function testQuarters(): void
    {        
        $this->assertTrue("It's a quarter past nine"===HourTeller::tell('9:15'));
        $this->assertTrue("It's a quarter past eleven"===HourTeller::tell('11:15'));
        $this->assertTrue("It's a quarter to twelve"===HourTeller::tell('11:45'));
        $this->assertTrue("It's a quarter to seventeen"===HourTeller::tell('16:45'));
    }

    public function testMinutesPast(): void
    {        
        $this->assertTrue("It's one minute past nine"===HourTeller::tell('9:01'));
        $this->assertTrue("It's twenty-three minutes past nine"===HourTeller::tell('9:23'));
        $this->assertTrue("It's thirteen minutes past eleven"===HourTeller::tell('11:13'));
        $this->assertTrue("It's twenty-nine minutes past twelve"===HourTeller::tell('12:29'));
        $this->assertTrue("It's seven minutes past fifteen"===HourTeller::tell('15:07'));
    }

    public function testMinutesTo(): void
    {        
        $this->assertTrue("It's one minute to nine"===HourTeller::tell('8:59'));
        $this->assertTrue("It's twenty-nine minutes to nine"===HourTeller::tell('8:31'));
        $this->assertTrue("It's twelve minutes to eleven"===HourTeller::tell('10:48'));
        $this->assertTrue("It's nine minutes to twelve"===HourTeller::tell('11:51'));
        $this->assertTrue("It's twenty-three minutes to fifteen"===HourTeller::tell('14:37'));
        $this->assertTrue("It's one minute to midnight"===HourTeller::tell('23:59'));
        $this->assertTrue("It's ten minutes to midnight"===HourTeller::tell('23:50'));
    }

    public function testInvalidFormat1(): void
    {
        $this->expectException(Exception::class);
        HourTeller::tell('aa:50');
    }

    public function testInvalidFormat2(): void
    {
        $this->expectException(Exception::class);
        HourTeller::tell('10-50');
    }

    public function testHourOutOfRange1(): void
    {
        $this->expectException(Exception::class);
        HourTeller::tell('-1:10');
    }

    public function testHourOutOfRange2(): void
    {
        $this->expectException(Exception::class);
        HourTeller::tell('24:10');
    }


    public function testMinuteOutOfRange1(): void
    {
        $this->expectException(Exception::class);
        HourTeller::tell('10:-1');
    }

    public function testMinuteOutOfRange2(): void
    {
        $this->expectException(Exception::class);
        HourTeller::tell('10:60');
    }
}
