<?php


use PHPUnit\Framework\TestCase;
use AndriiTrush\ServerTime\ServerTime;

class ServerTimeTest extends TestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetDateTimeWithIp(): void
    {
        $randIP = random_int(0, 255) . "." . random_int(0, 255) . "." . random_int(0, 255) . "." . random_int(0, 255);
        $this->assertTrue(ServerTime::getDateTime($randIP) instanceof DateTimeInterface);
    }


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetDateTimeWithoutIp(): void
    {
        $this->assertTrue(ServerTime::getDateTime() instanceof DateTimeInterface);
    }
}
