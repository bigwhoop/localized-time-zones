# Localized Time Zones

Provides access to translated time zone names from [CLDR](http://unicode.org/repos/cldr/trunk/common/main/).

```php
<?php
use Bigwhoop\LocalizedTimeZones\Loader;

var_dump(Loader::all('es_MX'));
// [
//    'Africa/Abidjan' => 'Abiyán',
//    'Africa/Accra' => 'Acra',
//    'America/Adak' => 'Adak',
//    'Africa/Addis_Ababa' => 'Addis Abeba',
//    'Australia/Adelaide' => 'Adelaida',
//    'Asia/Aden' => 'Adén',
//    ...
// ]

var_dump(Loader::one('Africa/Abidjan', 'es'));
// Abiyán
```

## Installation

    composer require bigwhoop/localized-time-zones


## License

MIT. See LICENSE file.