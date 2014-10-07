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
        $Info = $this->getInstance('68.171.218.222');

        $this->assertInstanceOf('\rmrevin\yii\geoip\HostInfo', $Info);
        $this->assertTrue($Info->isAvailable());
        $this->assertEquals('68.171.218.222', $Info->host);
        $this->assertNotEmpty($Info->getData());

        $Info = $this->getInstance('127.0.0.1');
        $this->assertFalse($Info->isAvailable());
        $this->assertEquals('127.0.0.1', $Info->host);
        $this->assertEmpty($Info->getData());
    }

    public function testData()
    {
        $Info = $this->getInstance('phptime.ru');

        $this->assertEquals('NA', $Info->getContinentCode());
        $this->assertEquals('US', $Info->getCountryCode());
        $this->assertEquals('USA', $Info->getCountryCode3());
        $this->assertEquals('United States', $Info->getCountryName());
        $this->assertEquals('MI', $Info->getRegion());
        $this->assertEquals('Michigan', $Info->getRegionName());
        $this->assertEquals('Southfield', $Info->getCity());
        $this->assertEquals(48075, $Info->getPostalCode());
        $this->assertEquals(42.465000152588, $Info->getLatitude());
        $this->assertEquals(-83.230697631836, $Info->getLongitude());
        $this->assertEquals(505, $Info->getDmaCode());
        $this->assertEquals(248, $Info->getAreaCode());
        $this->assertEquals('America/New_York', $Info->getTimeZone());
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