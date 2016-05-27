GeoIP helper for Yii2
===============================

Installation
------------
Install [`php5-geoip`](http://php.net/manual/ru/geoip.setup.php) extension.

Add in `composer.json`:
```
{
    "require": {
        "rmrevin/yii2-geoip": "~1.1"
    }
}
```

Usage
-----
In view
```php
<?
// ...

/** @var \rmrevin\yii\geoip\HostInfo $Info */
$Info = \Yii::createObject([
    'class' => '\rmrevin\yii\geoip\HostInfo',
    'host' => 'phptime.ru', // some host or ip
]);

// check available
$Info->isAvailable();

// obtaining all data
$Info->getData();

// obtaining the individual parameters
$Info->getContinentCode(); // NA
$Info->getCountryCode();   // US
$Info->getCountryCode3();  // USA
$Info->getCountryName();   // United States
$Info->getRegion();        // MI
$Info->getRegionName();    // Michigan
$Info->getCity();          // Southfield
$Info->getPostalCode();    // 48075
$Info->getLatitude();      // 42.465000152588
$Info->getLongitude();     // -83.230697631836
$Info->getDmaCode();       // 505
$Info->getAreaCode();      // 248
$Info->getTimeZone();      // America/New_York
```

FAQ
---

Q: I get error `Required database not available at /usr/share/GeoIP/GeoIPCity.dat.`. What to do?
A: Download this file [http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz](http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz) and ungzip it into `/usr/share/GeoIP/GeoIPCity.dat`