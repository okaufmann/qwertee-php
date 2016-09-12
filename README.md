# qwertee-php
[![Build Status](https://travis-ci.org/okaufmann/qwertee-php.svg?branch=master)](https://travis-ci.org/okaufmann/qwertee-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/okaufmann/qwertee-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/okaufmann/qwertee-php/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/okaufmann/qwertee-php/v/stable)](https://packagist.org/packages/okaufmann/qwertee-php)
[![Total Downloads](https://poser.pugx.org/okaufmann/qwertee-php/downloads)](https://packagist.org/packages/okaufmann/qwertee-php)
[![Latest Unstable Version](https://poser.pugx.org/okaufmann/qwertee-php/v/unstable)](https://packagist.org/packages/okaufmann/qwertee-php)
[![License](https://poser.pugx.org/okaufmann/qwertee-php/license)](https://packagist.org/packages/okaufmann/qwertee-php)


Simple client to access [Qwertees](https://www.qwertee.com) todays and last chance tees

## Installation
PHP 7.0+ required. Although [Components of Laravel](https://github.com/mattstauffer/Torch) were used, Laravel itself is not required.

To get the latest version of Package, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require okaufmann/qwertee-php
```

## Usage

This Package basically provide the following two methods.

```php
using Okaufmann\Qwertee\Qwertee

class HomeController
{

    public function index()
    {
        $today = Qwertee::today();
        
        $lastChance = Qwertee::lastChance();
    }
}
```

The Tees will be returned as a [Laravel Collection](https://laravel.com/docs/5.3/collections) like the following:

```php
[
    // ..
    [
        "title" => "Chaos and Disobey",
        "zoom" => "https://cdn.qwertee.com/images/designs/zoom/97594.jpg",
        "mens" => "https://cdn.qwertee.com/images/designs/mens/97594.jpg",
        "womens" => "https://cdn.qwertee.com/images/designs/womens/97594.jpg",
        "kids" => "https://cdn.qwertee.com/images/designs/kids/97594.jpg",
        "hoodie" => "https://cdn.qwertee.com/images/designs/hoodie/97594.jpg",
        "sweater" => "https://cdn.qwertee.com/images/designs/sweater/97594.jpg",
        "releasedAt" => "2016-09-10"
    ],
    // ...
]

```

##### Further Information

There are other classes in this package that are not documented here. This is because they are not intended for public use and are used internally by this package.

## License

This project and the Laravel framework are open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).