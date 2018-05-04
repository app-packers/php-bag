# PHP-BAG

[![Build Status](https://api.travis-ci.org/app-packers/php-bag.svg?branch=master)](https://travis-ci.org/app-packers/php-bag)
[![Latest Stable Version](https://poser.pugx.org/app-packers/php-bag/v/stable)](https://packagist.org/packages/app-packers/php-bag)
[![Total Downloads](https://poser.pugx.org/app-packers/php-bag/downloads)](https://packagist.org/packages/app-packers/php-bag)
[![Latest Unstable Version](https://poser.pugx.org/app-packers/php-bag/v/unstable)](https://packagist.org/packages/app-packers/php-bag)
[![License](https://poser.pugx.org/app-packers/php-bag/license)](https://packagist.org/packages/app-packers/php-bag)
[![Style Status](https://styleci.io/repos/132051217/shield?branch=master&style=flat)](https://styleci.io/repos/132051217)

PHP-BAG incorporates an easy to use package for retrieving address information from Basisregistraties Adressen en Gebouwen (BAG) into your vanilla PHP project.

## Requirements

* PHP 7.1

## Installation

Add PHP-BAG to your [Composer](https://getcomposer.org/) file via the `composer require` command:
            
    $ composer require app-packers/php-bag

Or add it to `composer.json` manually:

    "app-packers/php-bag": "1.0.0"
    
## Usage

Here you can see an example of just how simple this package is to use.

```php
use AppPackers\Bag\BagClient;

$bagClient = new BagClient();
$bagClient->setApiKey('00000000-0000-0000-0000-000000000000');

$bagClient->getAddressByZipcodeAndStreetNumber('7311KZ', 110);
```

### Result

```php
BagAddress {
  -street: "Hofstraat"
  -streetNumber: 110
  -city: "Apeldoorn"
  -zipCode: "7311KZ"
}
```

## Licence

This library is open-sourced software licensed under the [Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0).