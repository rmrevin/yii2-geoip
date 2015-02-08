<?php
/**
 * MainTest.php
 * @author Revin Roman http://phptime.ru
 */

namespace rmrevin\yii\geoip\tests\unit\geoip;

use rmrevin\yii\geoip\tests\unit\TestCase;

/**
 * Class MainTest
 * @package rmrevin\yii\geoip\tests\unit\geoip
 */
class MainTest extends TestCase
{

    public function testMain()
    {
        $Info = $this->getInstance('192.30.252.131');
        $this->assertInstanceOf('\rmrevin\yii\geoip\HostInfo', $Info);
        $this->assertTrue($Info->isAvailable());
        $this->assertEquals('192.30.252.131', $Info->host);
        $this->assertNotEmpty($Info->getData());

        $Info = $this->getInstance('127.0.0.1');
        $this->assertFalse($Info->isAvailable());
        $this->assertEquals('127.0.0.1', $Info->host);
        $this->assertEmpty($Info->getData());
    }

    public function testData()
    {
        $Info = $this->getInstance('github.com');

        $this->assertEquals('NA', $Info->getContinentCode());
        $this->assertEquals('US', $Info->getCountryCode());
        $this->assertEquals('USA', $Info->getCountryCode3());
        $this->assertEquals('United States', $Info->getCountryName());
        $this->assertEquals('CA', $Info->getRegion());
        $this->assertEquals('California', $Info->getRegionName());
        $this->assertEquals('San Francisco', $Info->getCity());
        $this->assertEquals(94107, $Info->getPostalCode());
        $this->assertEquals(37.76969909668, $Info->getLatitude());
        $this->assertEquals(-122.39330291748, $Info->getLongitude());
        $this->assertEquals(807, $Info->getDmaCode());
        $this->assertEquals(415, $Info->getAreaCode());
        $this->assertEquals('America/Los_Angeles', $Info->getTimeZone());
    }

    /**
     * @param string|bool $host
     * @return \rmrevin\yii\geoip\HostInfo
     * @throws \yii\base\InvalidConfigException
     */
    private function getInstance($host = false)
    {
        return \Yii::createObject([
            'class' => '\rmrevin\yii\geoip\HostInfo',
            'host' => $host,
        ]);
    }
}