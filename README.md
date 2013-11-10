# Bijective

[![Build Status](https://secure.travis-ci.org/daniel-morris/bijective.png?branch=master)](http://travis-ci.org/daniel-morris/bijective)

Bijective is a class that can compute pairings between alphanumeric strings, and
integers. Every integer can be mapped to an alphanumeric string, and every
alphanumeric string can be mapped back to an integer with no unpaired permutations.

## Installation

The recommended way to install Bijective is to use
[Composer](http://getcomposer.org/). Add `"honest/bijective": "1.0.*"` to the
`require` section of your composer.json file and run `composer install` to fetch the
package from [Packagist](https://packagist.org/packages/honest/bijective).

## Usage

If you have installed Bijective using Composer, you can start using the class
anywhere in your project provided that the Composer autoloader has been registered.
Here is a little usage example:


```php
use Honest\Bijective\Bijective;

$encoded = Bijective::encode(987656789);
echo $encoded, PHP_EOL;
$decoded = Bijective::decode($encoded);
echo $decoded, PHP_EOL;
```
