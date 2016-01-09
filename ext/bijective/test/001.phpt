--TEST--
Test the bijective_encode function
--SKIPIF--
<?php if (!extension_loaded('bijective')) print 'Skipped'; ?>
--FILE--
<?php

$bijections = [
  0        => 'a',
  1        => 'b',
  10       => 'k',
  100      => 'bM',
  1000     => 'qi',
  10000    => 'cLs',
  100000   => 'Aa4',
  1000000  => 'emjc',
  10000000 => 'P7Cu',
];

foreach ($bijections as $number => $expected) {
  $encoded = bijective_encode($number);
  var_dump($encoded === $expected);
}

?>

--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
