<?php
/**
 * HostInfo.php
 * @author Revin Roman http://phptime.ru
 */

namespace rmrevin\yii\geoip;

use yii\base\Exception;

/**
 * Class HostInfo
 * @package rmrevin\yii\geoip
 */
class HostInfo extends \yii\base\Component
{

    public $host;

    private $data = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!geoip_db_avail(GEOIP_COUNTRY_EDITION)) {
            throw new Exception('GeoIP country database not available.');
        }

        if (empty($this->host)) {
            $this->host = \Yii::$app->request->userIP;
        }

        $this->data = geoip_record_by_name($this->host);
    }

    /**
     * @return bool
     */
    public function isAvailable()
    {
        return !empty($this->data);
    }

    /**
     * @param string|bool $key
     * @return array|string|bool
     */
    public function getData($key = false)
    {
        return empty($this->data)
            ? $this->data
            : empty($key)
                ? $this->data
                : $this->data[$key];
    }

    /**
     * @return string|bool
     */
    public function getContinentCode()
    {
        return $this->getData('continent_code');
    }

    /**
     * @return string|bool
     */
    public function getCountryCode()
    {
        return $this->getData('country_code');
    }

    /**
     * @return string|bool
     */
    public function getCountryCode3()
    {
        return $this->getData('country_code3');
    }

    /**
     * @return string|bool
     */
    public function getCountryName()
    {
        return $this->getData('country_name');
    }

    /**
     * @return string|bool
     */
    public function getRegion()
    {
        return $this->getData('region');
    }

    /**
     * @return string|bool
     */
    public function getRegionName()
    {
        $result = false;

        $country = $this->getCountryCode();
        $region = $this->getRegion();

        if (!empty($country) && !empty($region)) {
            $result = geoip_region_name_by_code($country, $region);
        }

        return $result;
    }

    /**
     * @return string|bool
     */
    public function getCity()
    {
        return $this->getData('city');
    }

    /**
     * @return string|bool
     */
    public function getPostalCode()
    {
        return $this->getData('postal_code');
    }

    /**
     * @return string|bool
     */
    public function getLatitude()
    {
        return $this->getData('latitude');
    }

    /**
     * @return string|bool
     */
    public function getLongitude()
    {
        return $this->getData('longitude');
    }

    /**
     * @return string|bool
     */
    public function getDmaCode()
    {
        return $this->getData('dma_code');
    }

    /**
     * @return string|bool
     */
    public function getAreaCode()
    {
        return $this->getData('area_code');
    }

    /**
     * @return string|bool
     */
    public function getTimeZone()
    {
        $country = $this->getCountryCode();
        $region = $this->getRegion();
        $region = empty($region) ? null : $region;

        return geoip_time_zone_by_country_and_region($country, $region);
    }
}