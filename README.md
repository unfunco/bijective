# Bijective

[![Build Status](https://secure.travis-ci.org/honestempire/bijective.png?branch=master)](http://travis-ci.org/honestempire/bijective)
[![Code Climate](https://codeclimate.com/github/honestempire/bijective.png)](https://codeclimate.com/github/honestempire/bijective)

Bijective is a class that can compute pairings between alphanumeric strings, and
integers. Every integer can be mapped to an alphanumeric string, and every
alphanumeric string can be mapped back to an integer with no unpaired permutations.

## Installation

The recommended way to install Bijective is to use
[Composer](http://getcomposer.org/).

```bash
composer init --require=honest/bijective:1.0.* -n
composer install
```

## Usage example

If you have installed Bijective using Composer, you can start using the class
anywhere in your project provided that the Composer autoloader `vendor/autoload.php`
has been registered.

Here is a little usage example:

```php
use Honest\Bijective\Bijective;

$encoded = Bijective::encode(987656789);
echo $encoded, PHP_EOL; // be0gOn
$decoded = Bijective::decode($encoded);
echo $decoded, PHP_EOL; // 987656789
```
