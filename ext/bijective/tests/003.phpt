--TEST--
Test the bijective_expression function with recognised encoded strings
--SKIPIF--
<?php if (!extension_loaded('bijective')) print 'Skipped'; ?>
--FILE--
<?php

$recognisedEncodedStrings = ['a', 'aB', 'aB1', 'ab78', '82727', '2837a9'];

foreach ($recognisedEncodedStrings as $recognisedEncodedString) {
  $returned = preg_match(bijective_expression(), $recognisedEncodedString);
  var_dump(1 === $returned);
}

?>

--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
