# Qwertee Client
[![Build Status](https://travis-ci.org/okaufmann/qwertee-php.svg?branch=master)](https://travis-ci.org/okaufmann/qwertee-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/okaufmann/qwertee-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/okaufmann/qwertee-php/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/okaufmann/qwertee-php/v/stable)](https://packagist.org/packages/okaufmann/qwertee-php)
[![Total Downloads](https://poser.pugx.org/okaufmann/qwertee-php/downloads)](https://packagist.org/packages/okaufmann/qwertee-php)
[![Latest Unstable Version](https://poser.pugx.org/okaufmann/qwertee-php/v/unstable)](https://packagist.org/packages/okaufmann/qwertee-php)
[![License](https://poser.pugx.org/okaufmann/qwertee-php/license)](https://packagist.org/packages/okaufmann/qwertee-php)


Simple client to access [Qwertee](https://www.qwertee.com) todays and last chance tees

## Installation

You can install the package via composer:

```bash
composer require okaufmann/qwertee-php
```

## Usage

```php
require_once 'vendor/autoload.php';

use Okaufmann\QwerteePhp\Qwertee;

$lastChance = Qwertee::lastChance();
var_dump($lastChance);
```

### Result

```php
[
    [
        'title'=> 'Cyber Monday InsaniTEE Sale!',
        'zoom'=> 'https://cdn.qwertee.com/images/designs/product-thumbs/1575287644-156381-zoom-500x600.jpg',
        'mens'=> 'https://cdn.qwertee.com/images/designs/product-thumbs/1575287644-156381-mens-500x600.jpg',
        'womens'=> 'https://cdn.qwertee.com/images/designs/product-thumbs/1575287644-156381-womens-500x600.jpg',
        'kids'=> 'https://cdn.qwertee.com/images/designs/product-thumbs/1575287644-156381-kids-500x600.jpg',
        'hoodie'=> 'https://cdn.qwertee.com/images/designs/product-thumbs/1575287644-156381-hoodie-500x600.jpg',
        'sweater'=> 'https://cdn.qwertee.com/images/designs/product-thumbs/1575287644-156381-sweater-500x600.jpg',
        'releasedAt'=> '2019-12-01',
    ],
    // ...
]
```

## Credits

- [Oliver Kaufmann](https://github.com/okaufmann)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).