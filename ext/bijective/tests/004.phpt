--TEST--
Test the bijective_expression function with unrecognised encoded strings
--SKIPIF--
<?php if (!extension_loaded('bijective')) print 'Skipped'; ?>
--FILE--
<?php

$unrecognisedEncodedStrings = ['!', 'a!', '9@£', 'udf^', '#0123'];

foreach ($unrecognisedEncodedStrings as $unrecognisedEncodedString) {
  $returned = preg_match(bijective_expression(), $unrecognisedEncodedString);
  var_dump(0 === $returned);
}

?>

--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
