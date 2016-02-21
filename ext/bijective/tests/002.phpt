--TEST--
Test the bijective_decode function
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

foreach ($bijections as $expected => $string) {
  $decoded = bijective_decode($string);
  var_dump($decoded === $expected);
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
